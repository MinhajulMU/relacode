<?php

namespace App\Modules\Users\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\Users\Models\Users;
use App\Modules\Role\Models\Role;
use App\Modules\UserRole\Models\UserRole;
use DB;

class UsersController extends Controller
{
    protected $title = "Users";

    public function __construct()
    {
        $this->model = new Users();
    }

    public function index(Request $request)
    {
        $data['search'] = $request->input('search') == null ? '' : $request->input('search');
        $data['per_page'] = $request->input('per_page') == null ? 10 :  $request->input('per_page');
        $data['order_field'] = $request->input('order_field') == null ? 'created_at' : $request->input('order_field');
        $data['order_mode'] = $request->input('order_mode') == null ? 'desc' : $request->input('order_mode');
        $data['headerField'] = [
            [
                "name" => "No",
                "field" => null,
                "sortable" => false,
            ],
            [
                "name" => "Name",
                "field" => "name",
                "sortable" => true,
            ],
            [
                "name" => "Email",
                "field" => "email",
                "sortable" => true,
            ],
            [
                "name" => "Role",
                "field" => null,
                "sortable" => false,
            ],
            [
                "name" => "Aksi",
                "field" => null,
                "sortable" => false,
            ]
        ];
        $data['data'] = $this->model->searchWithKeywords([
            "keyword" => $data['search'],
            "per_page" => $data['per_page'],
            "fieldOrderBy" => $data['order_field'],
            "modeOrderBy" => $data['order_mode'],
        ], null, null, function ($query) {
            $query = $query->leftJoin('user_role', 'user_role.id_user', '=', 'users.id_user');
            $query = $query->leftJoin('role', 'role.id_role', '=', 'user_role.id_role');
            $query = $query->whereNull('user_role.deleted_at');
            $query = $query->addSelect(DB::raw('group_concat(role.role_name SEPARATOR ";;") as role_name'));
            $query = $query->groupBy('users.id_user');
            return $query;
        });
        return Inertia::render('Users::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('users.index') : url()->previous();
        $data['ref_role'] = Role::get(["id_role as value", "role_name as label"]);
        return Inertia::render('Users::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "name"       => "required|string|max:25",
            "email"       => "email|required|string|max:50|unique:users",
            "password"       => "required|string|max:255|min:6",
            'id_role' => 'required'
        ]);
        $role = $request->input('id_role');
        $formData['password'] = bcrypt($request->input('password'));
        $users = $this->model->create($formData);
        foreach ($role as $key => $value) {
        	$userRole = new UserRole;
        	$userRole->id_user = $users->id_user;
        	$userRole->id_role = $value['value'];
        	$userRole->save();
        }
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $users->id_user);
        return redirect()
            ->route("users.index")
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id,null,function($query){
            $query = $query->leftJoin('user_role', 'user_role.id_user', '=', 'users.id_user');
            $query = $query->leftJoin('role', 'role.id_role', '=', 'user_role.id_role');
            $query = $query->whereNull('user_role.deleted_at');
            $query = $query->addSelect(DB::raw('group_concat(role.role_name SEPARATOR ";;") as role_name'));
            $query = $query->groupBy('users.id_user');
            return $query;
        });

        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('users.index') : url()->previous();
        return Inertia::render('Users::Show', $data);
    }

    public function edit($id)
    {
        $data['users'] = $this->model::findOrFail($id);
        $data['ref_role'] = Role::get(["id_role as value", "role_name as label"]);
        $data['user_role'] = UserRole::leftJoin('role','user_role.id_role','=','role.id_role')
        ->where('id_user',$id)->get(["user_role.id_role as value", "role.role_name as label"]);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('users.index') : url()->previous();
        return Inertia::render('Users::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "name"       => "required|string|max:25",
            "email"       => "email|required|string|max:50|unique:users,email,$id,id_user",
            "password"       => "nullable|string|max:255",
            'id_role' => 'required'
        ]);
        $users = $this->model::findOrFail($id);
        $users->update($formData);
        $role = $request->input('id_role');
        UserRole::where('id_user', $users->id_user)->delete();
        foreach ($role as $key => $value) {
        	$userRole = new UserRole;
        	$userRole->id_user = $users->id_user;
        	$userRole->id_role = $value['value'];
        	$userRole->save();
        }
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $users->id_user);
        return redirect()
            ->route("users.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus ' . $this->title . ' ID = ' . $id);
        return redirect()
            ->route("users.index")
            ->with('success', 'Berhasil menghapus data!');
    }
}

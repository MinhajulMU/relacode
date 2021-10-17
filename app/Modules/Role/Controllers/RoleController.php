<?php

namespace App\Modules\Role\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\Role\Models\Role;


class RoleController extends Controller
{
    protected $title = "Role";

    public function __construct()
    {
        $this->model = new Role();
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
                "name" => "Role Name",
                "field" => "role_name",
                "sortable" => true,
            ],
            [
                "name" => "Role Slug",
                "field" => "role_slug",
                "sortable" => true,
            ],
            [
                "name" => "Opsi",
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
        ]);
        return Inertia::render('Role::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('role.index') : url()->previous();

        return Inertia::render('Role::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "role_name"       => "nullable|string|max:50",
            "role_slug"       => "nullable|string|max:50"
        ]);

        $role = $this->model->create($formData);
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $role->id_role);
        return redirect()
            ->route("role.index")
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('role.index') : url()->previous();
        return Inertia::render('Role::Show', $data);
    }

    public function edit($id)
    {
        $data['role'] = $this->model::findOrFail($id);

        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('role.index') : url()->previous();
        return Inertia::render('Role::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "role_name"       => "nullable|string|max:50",
            "role_slug"       => "nullable|string|max:50"
        ]);
        $role = $this->model::findOrFail($id);
        $role->update($formData);
        $raw_data = json_encode($role);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $role->id_role,$raw_data);
        return redirect()
            ->route("role.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus ' . $this->title . ' ID = ' . $id);
        return redirect()
            ->route("role.index")
            ->with('success', 'Berhasil menghapus data!');
    }
}

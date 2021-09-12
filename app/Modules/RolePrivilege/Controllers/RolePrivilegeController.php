<?php

namespace App\Modules\RolePrivilege\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\RolePrivilege\Models\RolePrivilege;
use App\Modules\Module\Models\Module;
use App\Modules\Role\Models\Role;

class RolePrivilegeController extends Controller
{
    protected $title = "RolePrivilege";

    public function __construct()
    {
        $this->model = new RolePrivilege();
    }

    public function index(Request $request)
    {
        $id_role = $request->input('id_role');
        $data['role'] = Role::find($id_role);
        $search = $request->input('search');
        $data['search'] = $search;
        $keywords = [];
        if ($search != null) {
            $keywords['name'] = $search;
        }
        $module = Module::where(function($w) use ($keywords){
            foreach($keywords as $k => $v)
            {
                $w->where($k,'like','%'.$v.'%');
            }
        })->get();
        $modules = [];
        foreach ($module as $item) {
            $slug = $item->id_module;
            $privileges = $item->rolePrivileges($id_role);
            $modules[$slug] = $item->toArray();
            $modules[$slug]['privileges'] = [
                'read' => ($privileges->can_read ?? 0) == 1,
                'create' => ($privileges->can_create ?? 0) == 1,
                'update' => ($privileges->can_update ?? 0) == 1,
                'delete' => ($privileges->can_delete ?? 0) == 1,
                'validate' => ($privileges->can_validate ?? 0) == 1,
            ];
        }
        $data['data'] = $modules;
        return Inertia::render('RolePrivilege::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('role-privilege.index') : url()->previous();
        $data["ref_module"] = Module::get(["id_module as value", "icon as label"]);
        $data["ref_role"] = Role::get(["id_role as value", "role_name as label"]);
        return Inertia::render('RolePrivilege::Create', $data);
    }
    public function store(Request $request)
    {
        if(allowAccess('role-privilege','update') && in_array($request->input('action'),['create','read','update','delete','validate'])){
            $rolePrivilege = RolePrivilege::where('id_module',$request->input('id_module'))->where('id_role', $request->input('id_role'))->first();
            if($rolePrivilege === null){
                $rolePrivilege = RolePrivilege::create([
                    'id_role' => $request->input('id_role'),
                    'id_module' => $request->input('id_module'),
                    'can_'.$request->input('action') => 1
                ]);
            }else{
                $rolePrivilege->update([
                    "can_".$request->input('action') => !$rolePrivilege->{"can_".$request->input('action')}
                ]);
            }
            return response()->json([
                'success' => true
            ]);
        }else{
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('role-privilege.index') : url()->previous();
        return Inertia::render('RolePrivilege::Show', $data);
    }

    public function edit($id)
    {
        $data['rolePrivilege'] = $this->model::findOrFail($id);
        $data["ref_module"] = Module::get(["id_module as value", "icon as label"]);
        $data["ref_role"] = Role::get(["id_role as value", "role_name as label"]);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('role-privilege.index') : url()->previous();
        return Inertia::render('RolePrivilege::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "can_create"       => "nullable|numeric",
            "can_delete"       => "nullable|numeric",
            "can_read"       => "nullable|numeric",
            "can_update"       => "nullable|numeric",
            "can_validate"       => "nullable|numeric",
            "id_module"       => "nullable|string|max:36|exists:module,id_module",
            "id_role"       => "nullable|string|max:36|exists:role,id_role"
        ]);
        $rolePrivilege = $this->model::findOrFail($id);
        $rolePrivilege->update($formData);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $rolePrivilege->id_role_privilege);
        return redirect()
            ->route("role-privilege.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus ' . $this->title . ' ID = ' . $id);
        return redirect()
            ->route("role-privilege.index")
            ->with('success', 'Berhasil menghapus data!');
    }
}

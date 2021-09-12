<?php

namespace App\Modules\Module\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\Module\Models\Module;
use App\Modules\MenuGrup\Models\MenuGrup;

class ModuleController extends Controller
{
    protected $title = "Module";

    public function __construct()
    {
        $this->model = new Module();
    }

    public function index(Request $request)
    {
        $parent_id = $request->input('parent_id');
        if ($parent_id == null) {
            $parent_id = 0;
        }
        $data['parent_id'] = $parent_id;
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
                "name" => "Grup Menu",
                "field" => "id_menu_grup",
                "sortable" => true,
            ],
            [
                "name" => "Urutan",
                "field" => "urutan",
                "sortable" => true,
            ],
            [
                "name" => "Icon",
                "field" => null,
                "sortable" => false,
            ],
            [
                "name" => "Slug",
                "field" => "slug",
                "sortable" => true,
            ],
            [
                "name" => "Is Show",
                "field" => "is_show",
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
        ],null,null,function($query) use ($parent_id){
            $query = $query->where('module.parent_id',$parent_id);
            return $query;
        });
        return Inertia::render('Module::Index', $data);
    }
    public function create(Request $request)
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('module.index') : url()->previous();
        $data["ref_menu_grup"] = MenuGrup::get(["id_menu_grup as value", "nm_menu_grup as label"]);
        $parent_id = $request->get('parent_id');
        if ($parent_id == null) {
            $parent_id = 0;
        }
        $data['parent_id'] = $parent_id;
        return Inertia::render('Module::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "name"       => "required|string|max:50",
            "icon"       => "nullable|string|max:50",
            "slug"       => "required|string|max:50",
            "is_show"       => "required|numeric",
            "id_menu_grup"       => "required|string|max:36|exists:menu_grup,id_menu_grup",
            "urutan"       => "required|numeric",
            "parent_id"       => "required|max:36"
        ]);

        $module = $this->model->create($formData);
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $module->id_module);
        return redirect()
            ->route("module.index",['parent_id' => $formData['parent_id']])
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('module.index') : url()->previous();
        return Inertia::render('Module::Show', $data);
    }

    public function edit(Request $request,$id)
    {
        $data['module'] = $this->model::findOrFail($id);
        $data["ref_menu_grup"] = MenuGrup::get(["id_menu_grup as value", "nm_menu_grup as label"]);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('module.index') : url()->previous();
        $parent_id = $request->get('parent_id');
        if ($parent_id == null) {
            $parent_id = 0;
        }
        $data['parent_id'] = $parent_id;
        return Inertia::render('Module::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "name"       => "required|string|max:50",
            "icon"       => "nullable|string|max:50",
            "slug"       => "required|string|max:50",
            "is_show"       => "required|numeric",
            "id_menu_grup"       => "required|string|max:36|exists:menu_grup,id_menu_grup",
            "urutan"       => "required|numeric",
            "parent_id"       => "required|max:36"
        ]);
        $module = $this->model::findOrFail($id);
        $module->update($formData);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $module->id_module);
        return redirect()
            ->route("module.index",['parent_id' => $formData['parent_id']])
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus ' . $this->title . ' ID = ' . $id);
        return redirect()
            ->route("module.index")
            ->with('success', 'Berhasil menghapus data!');
    }
}

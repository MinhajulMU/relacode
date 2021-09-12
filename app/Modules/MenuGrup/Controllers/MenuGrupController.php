<?php

namespace App\Modules\MenuGrup\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\MenuGrup\Models\MenuGrup;


class MenuGrupController extends Controller
{
    protected $title = "MenuGrup";

    public function __construct()
    {
        $this->model = new MenuGrup();
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
                "name" => "Nama Menu Grup",
                "field" => "nm_menu_grup",
                "sortable" => true,
            ],
            [
                "name" => "Icon",
                "field" => "icon",
                "sortable" => true,
            ],
            [
                "name" => "Urutan",
                "field" => "urutan",
                "sortable" => true,
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
        return Inertia::render('MenuGrup::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('menu-grup.index') : url()->previous();

        return Inertia::render('MenuGrup::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "nm_menu_grup"       => "nullable|string|max:100",
            "icon"       => "nullable|string|max:50",
            "urutan"       => "nullable|numeric"
        ]);

        $menuGrup = $this->model->create($formData);
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $menuGrup->id_menu_grup);
        return redirect()
            ->route("menu-grup.index")
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('menu-grup.index') : url()->previous();
        return Inertia::render('MenuGrup::Show', $data);
    }

    public function edit($id)
    {
        $data['menuGrup'] = $this->model::findOrFail($id);

        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('menu-grup.index') : url()->previous();
        return Inertia::render('MenuGrup::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "nm_menu_grup"       => "nullable|string|max:100",
            "icon"       => "nullable|string|max:50",
            "urutan"       => "nullable|numeric"
        ]);
        $menuGrup = $this->model::findOrFail($id);
        $menuGrup->update($formData);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $menuGrup->id_menu_grup);
        return redirect()
            ->route("menu-grup.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus ' . $this->title . ' ID = ' . $id);
        return redirect()
            ->route("menu-grup.index")
            ->with('success', 'Berhasil menghapus data!');
    }
}

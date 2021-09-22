<?php

namespace App\Modules\Dokumen\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\Dokumen\Models\Dokumen;


class DokumenController extends Controller
{
    protected $title = "Dokumen";

    public function __construct()
    {
        $this->model = new Dokumen();
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
            "name" => "Deskripsi",
            "field" => "deskripsi",
            "sortable" => true,
        ],
        [
            "name" => "File Name",
            "field" => "file_name",
            "sortable" => true,
        ],
        [
            "name" => "File Path",
            "field" => "file_path",
            "sortable" => true,
        ],
        [
            "name" => "File Size",
            "field" => "file_size",
            "sortable" => true,
        ],
        [
            "name" => "File Type",
            "field" => "file_type",
            "sortable" => true,
        ],
        [
            "name" => "Jns Dokumen",
            "field" => "id_jns_dokumen",
            "sortable" => true,
        ],
        [
            "name" => "Model",
            "field" => "id_model",
            "sortable" => true,
        ],
        [
            "name" => "Model",
            "field" => "model",
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
        return Inertia::render('Dokumen::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('dokumen.index') : url()->previous();
        
        return Inertia::render('Dokumen::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "deskripsi"       => "nullable|string|max:100",
            "file_name"       => "nullable|string|max:100",
            "file_path"       => "nullable|string|max:100",
            "file_size"       => "nullable",
            "file_type"       => "nullable|string|max:100",
            "id_jns_dokumen"       => "nullable|string|max:36",
            "id_model"       => "nullable|string|max:36",
            "model"       => "nullable|string|max:100"
        ]);

        $dokumen = $this->model->create($formData);
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $dokumen->id_dokumen);
        return redirect()
            ->route("dokumen.index")
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('dokumen.index') : url()->previous();
        return Inertia::render('Dokumen::Show', $data);
    }

    public function edit($id)
    {
        $data['dokumen'] = $this->model::findOrFail($id);
        
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('dokumen.index') : url()->previous();
        return Inertia::render('Dokumen::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "deskripsi"       => "nullable|string|max:100",
            "file_name"       => "nullable|string|max:100",
            "file_path"       => "nullable|string|max:100",
            "file_size"       => "nullable",
            "file_type"       => "nullable|string|max:100",
            "id_jns_dokumen"       => "nullable|string|max:36",
            "id_model"       => "nullable|string|max:36",
            "model"       => "nullable|string|max:100"
        ]);
        $dokumen = $this->model::findOrFail($id);
        $dokumen->update($formData);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $dokumen->id_dokumen);
        return redirect()
            ->route("dokumen.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus '.$this->title.' ID = '.$id);
        return redirect()
        ->route("dokumen.index")
        ->with('success', 'Berhasil menghapus data!');
    }

}
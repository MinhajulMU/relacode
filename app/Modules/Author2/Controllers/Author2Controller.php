<?php

namespace App\Modules\Author2\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\Author2\Models\Author2;


class Author2Controller extends Controller
{
    protected $title = "Author2";

    public function __construct()
    {
        $this->model = new Author2();
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
            "name" => "Alamat",
            "field" => "alamat",
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
        return Inertia::render('Author2::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('author2.index') : url()->previous();
        
        return Inertia::render('Author2::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "name"       => "nullable|string|max:100",
            "alamat"       => "nullable|string"
        ]);

        $author2 = $this->model->create($formData);
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $author2->id_author2);
        return redirect()
            ->route("author2.index")
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('author2.index') : url()->previous();
        return Inertia::render('Author2::Show', $data);
    }

    public function edit($id)
    {
        $data['author2'] = $this->model::findOrFail($id);
        
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('author2.index') : url()->previous();
        return Inertia::render('Author2::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "name"       => "nullable|string|max:100",
            "alamat"       => "nullable|string"
        ]);
        $author2 = $this->model::findOrFail($id);
        $author2->update($formData);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $author2->id_author2);
        return redirect()
            ->route("author2.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus '.$this->title.' ID = '.$id);
        return redirect()
        ->route("author2.index")
        ->with('success', 'Berhasil menghapus data!');
    }

}
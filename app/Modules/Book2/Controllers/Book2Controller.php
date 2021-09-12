<?php

namespace App\Modules\Book2\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\Book2\Models\Book2;
use App\Modules\Author2\Models\Author2;

class Book2Controller extends Controller
{
    protected $title = "Book2";

    public function __construct()
    {
        $this->model = new Book2();
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
            "name" => "Title",
            "field" => "title",
            "sortable" => true,
        ],
        [
            "name" => "Description",
            "field" => "description",
            "sortable" => true,
        ],
        [
            "name" => "Author2",
            "field" => "id_author2",
            "sortable" => true,
        ],
        [
            "name" => "Allow Pinjam",
            "field" => "allow_pinjam",
            "sortable" => true,
        ],
        [
            "name" => "Tanggal Pinjam",
            "field" => "tanggal_pinjam",
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
        return Inertia::render('Book2::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('book2.index') : url()->previous();
        $data["ref_author2"] = Author2::get(["id_author2 as value","name as label"]);
        return Inertia::render('Book2::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "title"       => "nullable|string|max:100",
            "description"       => "nullable|string",
            "id_author2"       => "nullable|string|max:36|exists:author2,id_author2",
            "allow_pinjam"       => "nullable",
            "tanggal_pinjam"       => "nullable|date"
        ]);

        $book2 = $this->model->create($formData);
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $book2->id_book2);
        return redirect()
            ->route("book2.index")
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('book2.index') : url()->previous();
        return Inertia::render('Book2::Show', $data);
    }

    public function edit($id)
    {
        $data['book2'] = $this->model::findOrFail($id);
        $data["ref_author2"] = Author2::get(["id_author2 as value","name as label"]);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('book2.index') : url()->previous();
        return Inertia::render('Book2::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "title"       => "nullable|string|max:100",
            "description"       => "nullable|string",
            "id_author2"       => "nullable|string|max:36|exists:author2,id_author2",
            "allow_pinjam"       => "nullable",
            "tanggal_pinjam"       => "nullable|date"
        ]);
        $book2 = $this->model::findOrFail($id);
        $book2->update($formData);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $book2->id_book2);
        return redirect()
            ->route("book2.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus '.$this->title.' ID = '.$id);
        return redirect()
        ->route("book2.index")
        ->with('success', 'Berhasil menghapus data!');
    }

}
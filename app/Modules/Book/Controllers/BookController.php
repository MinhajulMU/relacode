<?php

namespace App\Modules\Book\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\Book\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    //
    protected $title = "Book";

    public function __construct()
    {
        $this->model = new Book();
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
                "name" => "Author",
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
                "name" => "Allow Pinjam",
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
        return Inertia::render('Book::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('book.index') : url()->previous();
        $data['ref_author'] = Author::get(['id_author as value','name as label']);
        $data['ref_allow_pinjam'] = [['key' => 0, 'value' => 'Tidak'],['key' => 1,'value' => 'Ya']];
        return Inertia::render('Book::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "title"       => "required",
            "description" => "required",
            'id_author'   => 'required',
            'allow_pinjam' => 'required'
        ]);

        $book = $this->model->create($formData);
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $book->id_book);
        return redirect()
            ->route("book.index")
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('book.index') : url()->previous();
        return Inertia::render('Book::Show', $data);
    }

    public function edit($id)
    {
        $data['book'] = $this->model::findOrFail($id);
        $data['ref_author'] = Author::get(['id_author as value','name as label']);
        $data['ref_allow_pinjam'] = [['key' => 0, 'value' => 'Tidak'],['key' => 1,'value' => 'Ya']];
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('book.index') : url()->previous();
        return Inertia::render('Book::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "title"       => "required",
            "description" => "required",
            'id_author'   => 'required',
            'allow_pinjam' => 'nullable'
        ]);
        $book = $this->model::findOrFail($id);
        $book->update($formData);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $book->id_book);
        return redirect()
            ->route("book.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus '.$this->title.' ID = '.$id);
        return redirect()
        ->route("book.index")
        ->with('success', 'Berhasil menghapus data!');
    }

    public function searchCombo(Request $request){
        $validator = Validator::make($request->all(), [
            "q" => "sometimes",
            "count" => "sometimes|numeric",
            "field" => ['required', 'string'],
            "initial" => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => implode("\n", $validator->errors()->all()),
                "message_type" => "warning"
            ]);
        }

        $formData = $validator->validated();
        $result = $this->model->getCombo($formData['field'], $formData);

        return response()->json([
            "success" => $result !== null,
            "data" => $result
        ]);
    }
}

<?php

namespace App\Modules\Log\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Modules\Log\Models\Log;
use App\Modules\Users\Models\Users;

class LogController extends Controller
{
    protected $title = "Log";

    public function __construct()
    {
        $this->model = new Log();
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
            "name" => "User",
            "field" => "id_user",
            "sortable" => true,
        ],
        [
            "name" => "Aktifitas",
            "field" => "aktifitas",
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
        return Inertia::render('Log::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('log.index') : url()->previous();
        $data["ref_users"] = Users::get(["id_user as value","name as label"]);
        return Inertia::render('Log::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "id_user"       => "required|string|max:36|exists:users,id_user",
            "aktifitas"       => "nullable|string|max:100"
        ]);

        $log = $this->model->create($formData);
        return redirect()
            ->route("log.index")
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('log.index') : url()->previous();
        return Inertia::render('Log::Show', $data);
    }

    public function edit($id)
    {
        $data['log'] = $this->model::findOrFail($id);
        $data["ref_users"] = Users::get(["id_user as value","name as label"]);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('log.index') : url()->previous();
        return Inertia::render('Log::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "id_user"       => "required|string|max:36|exists:users,id_user",
            "aktifitas"       => "nullable|string|max:100"
        ]);
        $log = $this->model::findOrFail($id);
        $log->update($formData);
        return redirect()
            ->route("log.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        return redirect()
        ->route("log.index")
        ->with('success', 'Berhasil menghapus data!');
    }

}
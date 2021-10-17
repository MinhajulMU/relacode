<?php

namespace App\Modules\Config\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\Config\Models\Config;


class ConfigController extends Controller
{
    protected $title = "Config";

    public function __construct()
    {
        $this->model = new Config();
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
                "name" => "Key",
                "field" => "key",
                "sortable" => true,
            ],
            [
                "name" => "Value",
                "field" => "value",
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
        return Inertia::render('Config::Index', $data);
    }
    public function create()
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('config.index') : url()->previous();

        return Inertia::render('Config::Create', $data);
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "key"       => "nullable|string|max:100",
            "value"       => "nullable|string|max:100"
        ]);

        $config = $this->model->create($formData);
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $config->id_config);
        return redirect()
            ->route("config.index")
            ->with('success', 'Berhasil menambahkan data!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('config.index') : url()->previous();
        return Inertia::render('Config::Show', $data);
    }

    public function edit($id)
    {
        $data['config'] = $this->model::findOrFail($id);

        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('config.index') : url()->previous();
        return Inertia::render('Config::Edit', $data);
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "key"       => "nullable|string|max:100",
            "value"       => "nullable|string|max:100"
        ]);
        $config = $this->model::findOrFail($id);
        $config->update($formData);
        $raw_data = json_encode($config);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $config->id_config,$raw_data);
        return redirect()
            ->route("config.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus ' . $this->title . ' ID = ' . $id);
        return redirect()
            ->route("config.index")
            ->with('success', 'Berhasil menghapus data!');
    }
}

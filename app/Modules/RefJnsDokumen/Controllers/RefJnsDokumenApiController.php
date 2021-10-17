<?php

namespace App\Modules\RefJnsDokumen\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Modules\RefJnsDokumen\Models\RefJnsDokumen;

class RefJnsDokumenApiController extends Controller
{
    protected $title = "RefJnsDokumen";

    public function __construct()
    {
        $this->model = new RefJnsDokumen();
    }

    public function index(Request $request)
    {
        $data = $this->model->orderBy('created_at', 'desc')->get();
        return response()->json([
            'message' => 'berhasil mendapatkan data',
            'data' => $data
        ], 200);
    }
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "nm_jns_dokumen"       => "nullable|string|max:100"
        ]);

        if ($valid->fails()) {
            return response()->json(['message' => implode(', ', $valid->messages()->all()), 'success' => false, 'data' => []]);
        }
        $data = $this->model->create([
            "nm_jns_dokumen" => $request->input("nm_jns_dokumen")
        ]);
        $log  = Log::aktivitas('Menambah ' . $this->title . ' ID = ' . $data->id_jns_dokumen);
        return response()->json(['message' => 'Berhasil tambah data ' . $this->title, 'success' => true, 'data' => $data]);
    }

    public function show($id)
    {
        $data = $this->model->showWithForeign($id);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            "nm_jns_dokumen"       => "nullable|string|max:100"
        ]);
        if ($valid->fails()) {
            return response()->json(['message' => implode(', ', $valid->messages()->all()), 'success' => false, 'data' => []]);
        }
        $data = $this->model::findOrFail($id);
        $raw_data = json_encode($data);
        $data->nm_jns_dokumen = $request->input("nm_jns_dokumen");
        $data->save();
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $data->id_jns_dokumen, $raw_data);
        return response()->json(['message' => 'Berhasil ubah data ' . $this->title, 'success' => true, 'data' => $data]);
    }

    public function destroy($id)
    {
        $data = $this->model::find($id);
        if ($data == null) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found !'
            ]);
        }
        $data->delete();
        $log  = Log::aktivitas('Menghapus ' . $this->title . ' ID = ' . $id);
        return response()->json(['message' => 'Berhasil menghapus data ' . $this->title, 'success' => true, 'data' => []]);
    }
}

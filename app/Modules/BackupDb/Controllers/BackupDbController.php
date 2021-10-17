<?php

namespace App\Modules\BackupDb\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Log;
use App\Modules\BackupDb\Models\BackupDb;
use DB;

class BackupDbController extends Controller
{
    protected $title = "BackupDB";

    public function __construct()
    {
        $this->model = new BackupDb();
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
                "name" => "Tanggal",
                "field" => "date",
                "sortable" => true,
            ],

            [
                "name" => "File Name",
                "field" => "file_name",
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
        ]);
        return Inertia::render('BackupDb::Index', $data);
    }
    public function create()
    {
        $filename = "backup-" . date('Y-m-d') . ".sql";
        $file_path = "backup/";
        \Spatie\DbDumper\Databases\MySql::create()
            ->setDbName(config('cnf_app.db_name'))
            ->setUserName(config('cnf_app.db_username'))
            ->setPassword(config('cnf_app.db_password'))
            ->dumpToFile(storage_path('app/public/' . $file_path . $filename));

        $backupdb = new BackupDb();
        $backupdb->file_name = $filename;
        $backupdb->file_path = $file_path;
        $backupdb->date = date('Y-m-d');
        $backupdb->save();

        Log::aktivitas('Melakukan Backup DB');
        return redirect()->route("backup-db.index")
            ->with('success', 'Berhasil melakukan backup db!');
    }
    public function store(Request $request)
    {
        $formData = $request->validate([
            "database"       => "required|file",
        ]);
        $file = $request->file('database');
		$file->move(storage_path('app/public/temp'),$file->getClientOriginalName());
        DB::unprepared(file_get_contents(storage_path('app/public/temp/'.$file->getClientOriginalName())));
		Log::aktivitas('Melakukan restore database '.$file->getClientOriginalName());
        return redirect()
            ->route("backup-db.index")
            ->with('success', 'Berhasil melakukan restore database!');
    }

    public function show($id)
    {
        $data['data'] = $this->model->showWithForeign($id);
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('backup-db.index') : url()->previous();
        return Inertia::render('BackupDb::Show', $data);
    }

    public function edit($id)
    {
        $backupdb = BackupDb::find($id);
		return response()->download(storage_path('app/public/'.$backupdb->file_path.$backupdb->file_name));
    }
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            "date"       => "nullable|date",
            "file_name"       => "nullable|string|max:100",
            "file_path"       => "nullable|string|max:100"
        ]);
        $backupDb = $this->model::findOrFail($id);
        $raw_data = json_encode($backupDb);
        $backupDb->update($formData);
        $log  = Log::aktivitas('Mengubah ' . $this->title . ' ID = ' . $backupDb->id_backup_db,$raw_data);
        return redirect()
            ->route("backup-db.index")
            ->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        $book = $this->model::findOrFail($id);
        $book->delete();
        $log  = Log::aktivitas('Menghapus ' . $this->title . ' ID = ' . $id);
        return redirect()
            ->route("backup-db.index")
            ->with('success', 'Berhasil menghapus data!');
    }
    public function restore(Request $request)
    {
        $data['routes']['backUrl'] =  url()->previous() == URL::to('/') || url()->previous() == URL::current() ? URL::route('backup-db.index') : url()->previous();
        return Inertia::render('BackupDb::Restore', $data);
    }
}

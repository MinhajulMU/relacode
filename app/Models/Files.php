<?php 
namespace App\Models;

use PDOException;
use ReflectionClass;
use Illuminate\Support\Str;
use App\Modules\Dokumen\Models\Dokumen;
use Illuminate\Support\Facades\Request;

trait Files
{
    public function getDokumen($model, $id_model)
    {
        $dok = Dokumen::leftJoin('ref_jns_dokumen as rd', 'rd.id_jns_dokumen', 'dokumen.id_jns_dokumen')
		->where('model', $model)->where('id_model', $id_model)->orderBy('dokumen.created_at','desc')->first();
        return $dok;
    }

    public function getDokumens($model, $id_model)
    {
        $dok = Dokumen::leftJoin('ref_jns_dokumen as rd', 'rd.id_jns_dokumen', 'dokumen.id_jns_dokumen')
		->where('model', $model)->where('id_model', $id_model)->get();
        return $dok;
    }

	public function deleteDokumen($model, $id_model, $id_jns_dokumen)
	{
		Dokumen::where('model', $model)->where('id_model', $id_model)->where('id_jns_dokumen', $id_jns_dokumen)->delete();
	}

    public function saveDokumen($file,$data,$is_multiple=false)
	{
        $status = true;
        $model = null;
        $message = "";
        
        try 
        {
            // simpan di dalam filesystem
            $basepath = config('app.upload_path');

            $full_path = $this->get_file_upload_path($basepath);
            $file_path = str_replace($basepath,"",$full_path);

            // proses pemindahan file
            $mimetype = $file->getClientMimeType();
            $size = $file->getSize();
            $filename = (time()+rand())."_".str_replace(' ', '_', $file->getClientOriginalName());
            $data = array_merge($data,array(
                'file_path'	=> $file_path,
                'file_name' => $filename,
                'file_type'	=> $mimetype,
                'file_size' => round($size/1024,2),
            ));
            $file->move($full_path,$filename);

			if($is_multiple)
			{
				$model = Dokumen::create($data);                
			}
			else
			{
				$model = Dokumen::where('model',$data['model'])
					->where('id_model',$data['id_model'])
					->whereNull('deleted_at')
					->first();
				if(is_null($model))
				{
                    $dokumen = new Dokumen();
					$model = $dokumen->create($data);
				}
				else
				{
					$model = $model->update($data);
				}
			}

            $message = "Dokumen sukses disimpan";
        } 
        catch (\Illuminate\Database\QueryException $e) 
        {
            $status = false;
            $message = $e->getMessage();
        } 
        catch (PDOException $e) 
        {
            $status = false;
            $message = $e->getMessage();
		}
		
		return [$status, $message, $model ];
    }

    public function dokumen()
	{
		return $this->hasOne('App\Modules\Dokumen\Models\Dokumen', 'id_model', $this->primaryKey)->where('model', (new ReflectionClass($this))->getName()); 
	}
    
    function get_file_upload_path($basedir)
	{
		$permission = 0755;

		$nowday = date('d');
		$nowmonth = date('m');
		$nowyear = date('Y');
		$baseyear = $basedir.$nowyear.'/';
		// dd($baseyear);
		$isdir = is_dir($baseyear);
		if($isdir == false)
		{
			$old = umask(0); 
			mkdir($baseyear,$permission);
			umask($old);
		}
		$basemonth = $baseyear.$nowmonth.'/';
		$isdir = is_dir($basemonth);
		if($isdir == false)
		{
			$old = umask(0); 
			mkdir($basemonth,$permission);
			umask($old);
		}
		$baseday = $basemonth.$nowday.'/';
		$isdir = is_dir($baseday);
		if($isdir == false)
		{
			$old = umask(0); 
			mkdir($baseday,$permission);
			umask($old);
		}
		return $baseday;
	}
}
<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Siswa;
use Excel;
use DB;
use App\Traits\SessionFlash;

class ImportController extends Controller
{
    use SessionFlash;

    public function import()
	{
		return view('Import.siswa.import');
	}
    public function import_siswa(Request $request)
    {
    	$request->validate([
            'import_file' => 'required'
        ]);
 
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        $siswa = Siswa::join('kelas','kelas.id','=','siswas.kelas_id')
                    ->select('kelas.id','kelas.kelas','siswas.nama')->get();

        dd($siswa); 

        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = [ 'no_absen' => $value->no_absen ,'no_induk' => $value->no_induk , 'nama' => $value->nama , 'kelas_id' => 1];
            }
 
            if(!empty($arr)){
                Siswa::insert($arr);
                $this->NotifFlash("success","zmdi zmdi-check","Berhasil,","mengimport");
                return redirect('import/siswa');
            }
        }
    }
}


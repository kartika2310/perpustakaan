<?php

namespace App\Http\Controllers\Import;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Siswa;

class PageController extends Controller
{
     public function page_siswa(){
    	return view('Import.siswa.import');
    }
}



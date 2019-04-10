<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Siswa;
use App\Kelas;
use App\Pengujung;
use App\Pinjam;


class ApiController extends Controller
{
  function siswa(){
  	return response()->json(\App\Siswa::with('kelas')->get(),200);
  }
  function kelas(){
  	return response()->json(\App\Kelas::all(),200);
  }
  function buku(){
  	return response()->json(\App\Buku::all(),200);
  }
  function pengujung(){
  	return response()->json(\App\Pengujung::with('kelas','siswa')->whereMonth('tgl_kunjung','date'('m'))->get(),200);
  }
  function pinjam(){
  	return response()->json(\App\Pinjam_buku::with('kelas','siswa','buku')->whereMonth('tgl_pinjam','date'('m'))->get(),200);
  }
  function kembali(){
    return response()->json(\App\Pinjam_buku::with('kelas','siswa','buku')->whereMonth('tgl_kembali','date'('m'))->get(),200);
  }
    
}

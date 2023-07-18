<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(request $request)
    {
        if($request->jenis==''){
            $jenistanam='all';
        }else{
            $jenistanam=$request->jenis;
        }
        $halaman='Halaman Utama';
        $link='home';
        return view('home',compact('halaman','link','jenistanam'));
    }
    public function index_umum(request $request)
    {
        if($request->jenis==''){
            $jenistanam='all';
        }else{
            $jenistanam=$request->jenis;
        }
        $halaman='Halaman Utama';
        $link='home';
        return view('home_umum',compact('halaman','link','jenistanam'));
    }
    public function index_lokasi(request $request)
    {
        if($request->jenis==''){
            $jenistanam='all';
        }else{
            $jenistanam=$request->jenis;
        }
        $halaman='Halaman Utama';
        $link='cek_lokasi';
        return view('home_lokasi',compact('halaman','link','jenistanam'));
    }
}

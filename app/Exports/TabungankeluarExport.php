<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TabungankeluarExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
    	if(auth()->user()->IsAdmin == TRUE){
            $tabungan = DB::table('tabungan_keluar')->join('users','tabungan_keluar.user_id','users.id')->orderBy('tanggal_keluar','ASC')->get();
             $total = DB::table('tabungan_keluar') 
                      ->sum('tabungan_keluar.jumlah_uang_keluar');
        }else{
            $tabungan= DB::table('tabungan_keluar')
                      ->join('users','tabungan_keluar.user_id','users.id')
                      ->where('user_id',auth()->user()->id)
                      ->orderBy('tanggal_keluar','ASC')
                      ->get();
            $total = DB::table('tabungan_keluar')
                      ->where('user_id',auth()->user()->id )  
                      ->sum('tabungan_keluar.jumlah_uang_keluar');
        }

        return view('report/tabungan_keluar', compact('tabungan','total'));

        
    }
}

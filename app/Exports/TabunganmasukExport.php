<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TabunganmasukExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
    	if(auth()->user()->IsAdmin == TRUE){
            $tabungan = DB::table('tabungan_masuk')->join('users','tabungan_masuk.user_id','users.id')->orderBy('tanggal_masuk','ASC')->get();
             $total = DB::table('tabungan_masuk') 
                      ->sum('tabungan_masuk.jumlah_uang_masuk');
        }else{
            $tabungan= DB::table('tabungan_masuk')
                      ->join('users','tabungan_masuk.user_id','users.id')
                      ->where('user_id',auth()->user()->id)
                      ->orderBy('tanggal_masuk','ASC')
                      ->get();
            $total = DB::table('tabungan_masuk')
                      ->where('user_id',auth()->user()->id )  
                      ->sum('tabungan_masuk.jumlah_uang_masuk');
        }

        return view('report/tabungan_masuk', compact('tabungan','total'));

        
    }
}

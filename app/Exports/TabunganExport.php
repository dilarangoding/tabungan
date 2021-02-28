<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TabunganExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
    	if(auth()->user()->IsAdmin == TRUE){
            $tabungan = DB::table('tabungan')->join('users','tabungan.user_id','users.id')->get();
             $total = DB::table('tabungan')              
            ->sum('tabungan.total_tabungan');
        }else{
            $tabungan= DB::table('tabungan')
                      ->join('users','tabungan.user_id','users.id')
                      ->where('user_id',auth()->user()->id)
                      ->get();
            $total = DB::table('tabungan')
            ->where('user_id',auth()->user()->id)                 
            ->sum('tabungan.total_tabungan');
        }

       

        return view('report/tabungan', compact('tabungan','total'));

        
    }
}

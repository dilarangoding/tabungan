<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TabunganExport;
use App\Exports\TabunganmasukExport;
use App\Exports\TabungankeluarExport;

use Auth;
use Alert;


use App\Kelas;
use App\User;
use App\Tabunganmasuk;
use App\Tabungan;
use App\Tabungankeluar;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {   
        // admin
        $uang_masuk_admin = DB::table('tabungan_masuk')->sum('tabungan_masuk.jumlah_uang_masuk');
        $uang_keluar_admin = DB::table('tabungan_keluar')->sum('tabungan_keluar.jumlah_uang_keluar');
        $total_saldo_admin = DB::table('tabungan')->sum('tabungan.total_tabungan');

        
        $siswa = DB::table('users')->where('IsAdmin','FALSE')->count();
        $kelas = DB::table('kelas')->count();
        

        // siswa

        $uang_masuk = DB::table('tabungan_masuk')
                      ->where('user_id',auth()->user()->id)  
                      ->sum('tabungan_masuk.jumlah_uang_masuk');
        $uang_keluar = DB::table('tabungan_keluar')
                       ->where('user_id',auth()->user()->id)      
                       ->sum('tabungan_keluar.jumlah_uang_keluar');
                       
        $total_saldo = DB::table('tabungan')
                       ->where('user_id',auth()->user()->id)                 
                       ->sum('tabungan.total_tabungan');
        

        return view('dashboard',\compact('uang_masuk_admin','uang_keluar_admin','kelas','siswa','uang_masuk','uang_keluar','total_saldo','total_saldo_admin'));
    }


    public function kelas()
    {
        $kelas = DB::table('kelas')->get();
        return view('kelas.index',\compact('kelas'));
    }

    public function addKelas(Request $req)
    {
          
            try {
                
                Kelas::updateOrCreate([
                    'nama_kelas'=>$req->nama_kelas
                ]);

                Alert::success('Sukses','Berhasil menambah data');
                return redirect()->back();
                
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getmessage());
            }
    }

    public function deleteKelas($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();

        Alert::success('Sukses','Berhasil menghapus data');
        return redirect()->back();
    }
    
    public function editKelas($id)
    {
        $kelas = Kelas::find($id);
    
        return view('kelas/edit',compact('kelas'));
    }

    public function updateKelas(Request $req,$id)
    {
       
            try {
                $kelas  = Kelas::find($req->id);
               $kelas->update([
                    'nama_kelas'=>$req->nama_kelas
                ]);

                Alert::success('Sukses','Berhasil mengedit data');
                return redirect()->back();
                
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getmessage());
            }
        
    }

    public function siswa()
    {
        $siswa = DB::table('users')
         ->join('kelas','users.kelas_id','kelas.id')       
        ->where('IsAdmin','FALSE')
        ->select('users.*','kelas.nama_kelas')    
        ->get();
        
        return view('siswa/index',compact('siswa'));
    }

    public function addSiswa()
    {
        $kelas = Kelas::orderBy('nama_kelas','ASC')->get();
        
        return view('siswa/tambah',\compact('kelas'));
    }
    public function storeSiswa(Request $req)
    {
    
        $this->validate($req,[

            'name'=>'required',
            'email'=>'required|string|email|max:255|unique:users',
            'kelas_id'=>'required',
            'jk'=>'required',
            'phone'=>'required',
            'alamat'=>'required'
		]);

        

        try {
          User::updateOrCreate([
            'name'=> $req->name,
            'email'=> $req->email,
            'password'=> bcrypt('siswa1'),
            'kelas_id'=>$req->kelas_id,
            'jenis_kelamin'=>$req->jk,
            'phone' =>$req->phone,
            'alamat' => $req->alamat
          ]);
          Alert::success('Sukses','Berhasil manambah data');
          return redirect('siswa');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editSiswa($id)
    {
        $siswa = User::find($id);
        $kelas = Kelas::orderBy('nama_kelas','ASC')->get();

        return view('siswa/edit',\compact('siswa','kelas'));
    }

    public function updateSiswa(Request $req, $id)
    {
        
        $this->validate($req,[
            'name'=>'required',
            'kelas_id'=>'required',
            'jk'=>'required',
            'phone'=>'required',
            'alamat'=>'required'
        ]);

        try {
            $cek  = User::where('email',$req->email)->count();
           
            if($cek > 0){
               Alert::error('error','Email sudah ada');
                return redirect()->back();
            }else{

            
            $siswa = User::find($id);
            $siswa->update([
                'name'=> $req->name,
                'email'=> $req->email,
                'kelas_id'=>$req->kelas_id,
                'jenis_kelamin'=>$req->jk,
                'phone' =>$req->phone,
                'alamat' => $req->alamat
            ]);
            }
              Alert::success('Sukses','Berhasil mengedit data');
             return redirect('siswa');
          
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteSiswa($id)
    {
        $siswa = User::find($id);
        $siswa->delete();
        Alert::success('Sukses','Berhasil menghapus data');
             return redirect()->back();
    }

    public function tabunganMasuk()
    {
            if(Auth::user()->IsAdmin == TRUE){
                  return abort(404);
             }
            $tabungan = DB::table('tabungan_masuk')
                        ->join('users','tabungan_masuk.user_id','users.id') 
                        ->where('user_id',Auth::user()->id)
                        ->select('tabungan_masuk.*','users.name')
                        ->orderBy('tanggal_masuk','ASC')  
                        ->get();

            return view('tabungan/tabungan_masuk',compact('tabungan'));
    }

    public function tabunganKeluar()
    {
        if(Auth::user()->IsAdmin == TRUE){
            return abort(404);
        }
            $tabungan = DB::table('tabungan_keluar')
                        ->join('users','tabungan_keluar.user_id','users.id') 
                        ->where('user_id',Auth::user()->id)
                        ->select('tabungan_keluar.*','users.name')
                        ->orderBy('tanggal_keluar','ASC')  
                        ->get();

            return view('tabungan/tabungan_keluar',compact('tabungan'));
    }




    public function tabunganMasukAdmin()
    {
        $tabungan_masuk = DB::table('tabungan_masuk')
                        ->join('users','tabungan_masuk.user_id','users.id') 
                        ->select('tabungan_masuk.*','users.name')
                        ->orderBy('tanggal_masuk','ASC')  
                        ->get();
                       

        return view('tabungan_masuk/index',compact('tabungan_masuk'));
    }

    public function addTabunganMasuk()
    {
        $siswa = User::where('IsAdmin','FALSE')->get();

        return view('tabungan_masuk/tambah',\compact('siswa'));
    }

    public function storeTabunganMasuk(Request $req)
    {
        
        try {

           $cek = DB::table('tabungan')->where('user_id',$req->user_id)->count();
           
           if($cek > 0){
               Tabunganmasuk::updateOrCreate([
                    'user_id' => $req->user_id,
                    'kode_transaksi' =>$req->kode,
                    'tanggal_masuk' => $req->tanggal,
                    'jumlah_uang_masuk' => $req->jumlah        
               ]);

               $tabungan = DB::table('tabungan')->where('user_id',$req->user_id)->get();

                    foreach($tabungan as $item){
                        $saldo = $item->total_tabungan;
                    }
                DB::table('tabungan')->where('user_id',$req->user_id)->update(['total_tabungan'=>$saldo + $req->jumlah]);

               Alert::success('Sukses','Berhasil manambah data tabungan');
               return redirect('tabungan_masuk_admin');
           }else{
               Tabungan::updateOrCreate([
                   'user_id' => $req->user_id,
                   'total_tabungan' => $req->jumlah,
               ]);

                Tabunganmasuk::updateOrCreate([
                        'user_id' => $req->user_id,
                        'kode_transaksi' =>$req->kode,
                        'tanggal_masuk' => $req->tanggal,
                        'jumlah_uang_masuk' => $req->jumlah        
                ]);

                    Alert::success('Sukses','Berhasil manambah data tabungan');
                     return redirect('tabungan_masuk_admin');
           }
            

              
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function editTabunganMasuk($id)
    {   
        $tabungan = Tabunganmasuk::find($id);
         $siswa = User::where('IsAdmin','FALSE')->get();

         return view('tabungan_masuk/edit',compact('tabungan','siswa'));
    }

    public function updateTabunganMasuk(Request $req, $id)
    {
         
        try {
            $tabungans = Tabunganmasuk::find($id);
            $tabungan = DB::table('tabungan')->where('user_id',$req->user_id)->get();

                    foreach($tabungan as $item){
                        $saldo = $item->total_tabungan;
                    }
                DB::table('tabungan')->where('user_id',$req->user_id)->update(['total_tabungan'=>$saldo-$tabungans->jumlah_uang_masuk+ $req->jumlah]);

            
            
            $tabungans->update([
                'user_id' => $req->user_id,
                'kode_transaksi' =>$req->kode,
                'tanggal_masuk' => $req->tanggal,
                'jumlah_uang_masuk' => $req->jumlah
            ]);
            Alert::success('Sukses','Berhasil mengedit data tabungan');
              return redirect('tabungan_masuk_admin');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function deleteTabunganMasuk($id)
    {
        $tabungans = Tabunganmasuk::find($id);
         $tabungan = DB::table('tabungan')->where('user_id',$tabungans->user_id)->get();

            foreach($tabungan as $item){
                $saldo = $item->total_tabungan;
            }
        DB::table('tabungan')->where('user_id',$tabungans->user_id)->update(['total_tabungan'=>$saldo-$tabungans->jumlah_uang_masuk]);
        $tabungans->delete();
        Alert::success('Sukses','Berhasil menghapus data tabungan');
              return redirect()->back();
    }

    public function tabunganKeluarAdmin()
    {
        
        $tabungan_keluar = DB::table('tabungan_keluar')
                        ->join('users','tabungan_keluar.user_id','users.id') 
                        ->select('tabungan_keluar.*','users.name')
                        ->orderBy('tanggal_keluar','ASC')  
                        ->get();

        return view('tabungan_keluar/index',\compact('tabungan_keluar'));
    }

    public function addTabunganKeluar()
    {
        $siswa = User::where('IsAdmin','FALSE')->get();

        return view('tabungan_keluar/tambah',\compact('siswa'));
    }

    public function storeTabunganKeluar(Request $req)
    {   
        $this->validate($req,[

            'user_id'=>'required',
            'tanggal'=>'required',
            'jumlah'=>'required',
        ]);




        try {
            $cek =  DB::table('tabungan')->where('user_id',$req->user_id)->first();
           
            if($cek === NULL){
                Alert::error('Error','Saldo tidak ada');
                return redirect()->back();
            }
            elseif($req->jumlah > $cek->total_tabungan){
                Alert::error('Error','Sisa  saldo anda kurang dari jumlah penarikan');
                return redirect()->back();
            }else{
                $tabungan = DB::table('tabungan')->where('user_id',$req->user_id)->get();

                foreach($tabungan as $item){
                    $saldo = $item->total_tabungan;
                }

                DB::table('tabungan')->where('user_id',$req->user_id)
                                     ->update(['total_tabungan'=>$saldo-$req->jumlah]);
               
                 Tabungankeluar::updateOrCreate([
                    'user_id' => $req->user_id,
                    'kode_transaksi' =>$req->kode,
                    'tanggal_keluar' => $req->tanggal,
                    'jumlah_uang_keluar' => $req->jumlah
                 ]);
                Alert::success('Sukses','Berhasil menarik saldo tabungan');
                return redirect('tabungan_keluar_admin');
            }


        } catch (\Throwable $th) {
            
        }
    }


    public function deleteTabunganKeluar($id)
    {   

        $tabungan_keluar = Tabungankeluar::find($id);
        $tabungan = Tabungan::where('user_id',$tabungan_keluar->user_id)->get();

        foreach ($tabungan as $item ) {
            $saldo = $item->total_tabungan;
        }
        
        Tabungan::where('user_id',$tabungan_keluar->user_id)
        ->update(['total_tabungan'=>$saldo + $tabungan_keluar->jumlah_uang_keluar]);
        $tabungan_keluar->delete();
        
        Alert::success('Sukses','Berhasil menghapus data tabungan keluar');
        return redirect()->back();
    }

    public function editTabunganKeluar($id)
    {
        $tabungan = Tabungankeluar::find($id);

        $siswa = User::where('IsAdmin','FALSE')->get();
        $saldo = Tabungan::where('user_id',$tabungan->user_id)->first();
        
        return view('tabungan_keluar/edit',compact('tabungan','siswa','saldo'));
    }
    
    public function updateTabunganKeluar(Request $req, $id)
    {
        $tabungans = Tabungan::where('user_id',$req->user_id)->first();


            // jika saldo nya 0 maka
        if($tabungans->total_tabungan ==  0){

            $tabungan = Tabungan::where('user_id',$req->user_id)->get();

            foreach ($tabungan as $item ) {
                $saldo = $item->total_tabungan;
            }

            $tbKeluar = Tabungankeluar::where('id',$id)->first();

            
            // kembalikan saldo seperti awal
                Tabungan::where('user_id',$req->user_id)
                          ->update(['total_tabungan'=>$saldo+$tbKeluar->jumlah_uang_keluar]);
     
            // lakukan update tabungan keluar
                Tabungan::where('user_id',$req->user_id)
                            ->update(['total_tabungan'=>$saldo-$saldo+$tbKeluar->jumlah_uang_keluar- $req->jumlah]);
                
              Tabungankeluar::where('id',$id)->update([
                    'user_id' => $req->user_id,
                    'kode_transaksi' =>$req->kode,
                    'tanggal_keluar' => $req->tanggal,
                    'jumlah_uang_keluar' => $req->jumlah
                 ]);
                Alert::success('Sukses','Berhasil mengedit saldo tabungan');
                return redirect('tabungan_keluar_admin');
        }else{

                $tabungan = Tabungan::where('user_id',$req->user_id)->get();

                foreach ($tabungan as $item ) {
                    $saldo = $item->total_tabungan;
                }

                $tbKeluar = Tabungankeluar::where('id',$id)->first();

                
                // kembalikan saldo seperti awal
                    Tabungan::where('user_id',$req->user_id)
                            ->update(['total_tabungan'=>$saldo+$tbKeluar->jumlah_uang_keluar]);
                 
                // cek saldo apa kurang dari total penarikan
                    $cek = Tabungan::where('user_id',$req->user_id)->first();

               if($req->jumlah > $cek->total_tabungan){
                    $tabungan = Tabungan::where('user_id',$req->user_id)->get();

                    foreach ($tabungan as $item ) {
                        $saldo = $item->total_tabungan;
                    }

                    $tbKeluar = Tabungankeluar::where('id',$id)->first();

                
                // kembalikan saldo seperti awal
                    Tabungan::where('user_id',$req->user_id)
                            ->update(['total_tabungan'=>$saldo - $tbKeluar->jumlah_uang_keluar]);
                    
                     Alert::error('error','Jumlah saldo kurang dari jumlah penarikan');
                     return redirect()->back();       
               }else{
                        $tabungan = Tabungan::where('user_id',$req->user_id)->get();

                        foreach ($tabungan as $item ) {
                            $saldo = $item->total_tabungan;
                        }

                        

                    
                    // kembalikan saldo seperti awal
                        Tabungan::where('user_id',$req->user_id)
                                ->update(['total_tabungan'=>$saldo-$req->jumlah]);
                        
                                
                        Tabungankeluar::where('id',$id)->update([
                            'user_id' => $req->user_id,
                            'kode_transaksi' =>$req->kode,
                            'tanggal_keluar' => $req->tanggal,
                            'jumlah_uang_keluar' => $req->jumlah
                        ]);

                        Alert::success('Sukses','Berhasil mengedit saldo tabungan');
                        return redirect('tabungan_keluar_admin');
                        
                 }     

        }        
    }

    public function getDetailSaldo($id)
    {
        $data = Tabungan::where('user_id',$id)->pluck('total_tabungan');
            
          
        return response()->json(['success' => true, 'name'=>$data]);
    }

    public function tabungan()
    {
        if(Auth::user()->IsAdmin == TRUE){
            $tabungan = Tabungan::join('users','tabungan.user_id','users.id')->get();
            return view('tabungan/tabungan',compact('tabungan'));
        }else{
            $tabungan = Tabungan::join('users','tabungan.user_id','users.id')->where('user_id',Auth::user()->id)->get();
            return view('tabungan/tabungan',compact('tabungan'));
        }
    }

    public function profile()
    {
         $profile = User::where('id',Auth::user()->id)->first();
        
         return view('profile',compact('profile'));
    }

    
    public function updateProfile(Request $req, $id)
    {
        $this->validate($req,[
            'name' =>'required|max:255',
            'phone'=>'required',
            'alamat'=>'required'
        ]);

        try {
            $user = User::find($id);
            $pw = !empty($req->password)? bcrypt($req->password): $user->password;

            $user->update([
                'name'=> $req->name,
                'password'=>$pw,
                'phone'=>$req->phone,
                'alamat'=>$req->alamat
            ]);
            
            Alert::success('sukses','Berhasil mengubah profile');
            return  redirect()->back();

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function reportTabungan()
    {
       return Excel::download(new TabunganExport, 'tabungan.xlsx');
    }

    public function reportTabunganMasuk()
    {
        return Excel::download(new TabunganmasukExport, 'tabungan  masuk.xlsx');
    }
    public function reportTabunganKeluar()
    {
        return Excel::download(new TabungankeluarExport, 'tabungan  keluar.xlsx');
    }







    
}

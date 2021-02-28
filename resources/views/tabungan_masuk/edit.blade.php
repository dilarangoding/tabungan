@extends('layouts.master')
@section('title','Edit uang masuk')
    
@section('content')
    

  <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Edit uang masuk</h1>
           
       </div>

       <div class="row justify-content-center">

            <div class="col-md-6">

               <div class="card">
                  <div class="card-header bg-gradient-primary text-white">
                     Edit uang masuk
                  </div>

                  <div class="card-body">
                     <form action="{{ url('tabungan_masuk/update',$tabungan->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                           <label for="">Kode Transaksi</label>
                           <input type="text" class="form-control" id="kode" value="{{ $tabungan->kode_transaksi }}" name="kode" readonly>
                          
                        </div>
                         <div class="form-group">
                           <label for="email">Nama siswa</label>
                           <select name="user_id" id="user_id" class="form-control" required>
                              <option value="" disabled selected>Pilih siswa</option>
                              @foreach ($siswa as $item)
                                  <option value="{{ $item->id }}" {{ $tabungan->user_id == $item->id?'selected':'' }}>{{ $item->name }}</option>
                              @endforeach
                           </select>
                           <span class="text-danger">
										{{$errors->first('email')}}
									</span>
                        </div>
                        
                        <div class="form-group">
                           <label for="no">Tanggal masuk</label>
                           <input type="text" readonly name="tanggal" required value="{{ $tabungan->tanggal_masuk }}" class="form-control" >
                           <span class="text-danger">
										{{$errors->first('tanggal')}}
									</span>
                        </div>

                        <div class="form-group">
                           <label for="jumlah">Jumlah uang masuk</label>
                           <input type="number" required placeholder="Masukan jumlah uang" value="{{ $tabungan->jumlah_uang_masuk }}" name="jumlah" class="form-control">

                            <span class="text-danger">
										{{$errors->first('jumlah')}}
									</span>
                        </div>

                       
                       
                        <div class="form-group">
                           <button class="btn btn-primary btn-block">Submit</button>
                        </div>
                     </form>
                  </div>
               </div>

            </div>

       </div>
  </div>        


@endsection

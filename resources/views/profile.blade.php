@extends('layouts.master')
@section('title','Profile')
    
@section('content')
    

  <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Profile</h1>
           
       </div>

       <div class="row justify-content-center">

            <div class="col-md-6">

               <div class="card">
                  <div class="card-header bg-gradient-primary text-white">
                     Profile
                  </div>

                  <div class="card-body">
                     <form action="{{ url('update/profile',$profile->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                           <label for="name">Nama</label>
                           <input type="text" class="form-control" name="name" value="{{ $profile->name }}">
                        </div>
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="text" class="form-control" name="email" value="{{ $profile->email }}" readonly>
                        </div>
                        <div class="form-group">
                           <label for="name">password <sup class="text-danger">*Kosongkan jika tidak ingin mengubah password</sup></label>
                           <input type="password" class="form-control" value="" name="password">
                        </div>
                        <div class="form-group">
                           <label for="">No hp</label>
                           <input type="number" name="phone" value="{{ $profile->phone }}" class="form-control">
                        </div>
                         <div class="form-group">
                           <label for="">Alamat</label>
                           <textarea name="alamat" id="" cols="30" class="form-control" rows="2">{{ $profile->alamat }}</textarea>
                        </div>


                        <div class="form-group">
                           <button class="btn btn-primary btn-block">
                              Simpan
                           </button>
                        </div>
                     </form>
                  </div>
                  {{-- <div class="card-body">
                     <form action="{{ url('tabungan_keluar/store') }}" method="post">
                        @csrf
                        <div class="form-group">
                           <label for="">Kode Transaksi</label>
                           <input type="text" class="form-control" id="kode" required value="" name="kode" readonly>
                          
                        </div>

                         <div class="form-group">
                           <label for="email">Nama siswa</label>
                           <select name="user_id" id="user_id" required class="form-control">
                              <option value="" disabled selected>Pilih siswa</option>
                              @foreach ($siswa as $item)
                                  <option value="{{ $item->id }}" >{{ $item->name }}</option>
                              @endforeach
                           </select>
                           <span class="text-danger">
										{{$errors->first('user_id')}}
									</span>
                        </div>
                        
                        <div class="form-group">
                           <label for="saldo">Sisa saldo</label>
                           <input type="text" id="saldo" placeholder="Sisa saldo anda" readonly class="form-control">
                        </div>


                        <div class="form-group">
                           <label for="no">Tanggal keluar</label>
                           <input type="date" name="tanggal" required class="form-control"  placeholder="Masukan no hp">
                           <span class="text-danger">
										{{$errors->first('tanggal')}}
									</span>
                        </div>

                        <div class="form-group">
                           <label for="jumlah">Jumlah uang keluar</label>
                           <input type="number" required placeholder="Masukan jumlah uang"  name="jumlah" class="form-control">

                            <span class="text-danger">
										{{$errors->first('jumlah')}}
									</span>
                        </div>

                       
                       
                        <div class="form-group">
                           <button class="btn btn-primary btn-block">Submit</button>
                        </div>
                     </form>
                  </div> --}}
               </div>

            </div>

       </div>
  </div>        


@endsection



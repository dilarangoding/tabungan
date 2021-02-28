@extends('layouts.master')
@section('title','Tambah Siswa')
    
@section('content')
    

  <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Tambah siswa</h1>
           
       </div>

       <div class="row justify-content-center">

            <div class="col-md-6">

               <div class="card">
                  <div class="card-header bg-gradient-primary text-white">
                     Tambah Siswa
                  </div>

                  <div class="card-body">
                     <form action="{{ url('siswa/store') }}" method="post">
                        @csrf
                        <div class="form-group">
                           <label for="">Nama lengkap</label>
                           <input type="text" class="form-control" name="name" placeholder="Masukan nama lengkap">
                           <span class="text-danger">
										{{$errors->first('name')}}
									</span>
                        </div>
                         <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" class="form-control" name="email" placeholder="Masukan email anda">
                           <span class="text-danger">
										{{$errors->first('email')}}
									</span>
                        </div>
                        

                        <div class="form-group">
                           <label for="kelasl">Kelas</label>
                           <select name="kelas_id" id="kelas" class="form-control">
                              <option value="" disabled selected>Pilih kelas</option>

                           @foreach ($kelas as $item)
                              <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                            @endforeach
                           </select>
                           <span class="text-danger">
										{{$errors->first('kelas_id')}}
									</span>
                        </div>

                        <div class="form-group">
                           <label for="jk">Jenis Kelamin</label>
                           <select name="jk" id="jk" class="form-control">
                              <option value="" selected disabled> Pilih jenis kelamin</option>
                              <option value="Laki-laki">Laki-laki</option>
                              <option value="Perempuan">Perempuan</option>
                           </select>
                           <span class="text-danger">
										{{$errors->first('jk')}}
									</span>
                        </div>

                        <div class="form-group">
                           <label for="no">No hp</label>
                           <input type="number" name="phone" class="form-control" placeholder="Masukan no hp">
                           <span class="text-danger">
										{{$errors->first('phone')}}
									</span>
                        </div>

                        <div class="form-group">
                           <label for="alamat">Alamat</label>
                           <textarea name="alamat" id="alamat" class="form-control" cols="3" rows="2" placeholder="Masukan alamat lengkap "></textarea>
                           <span class="text-danger">
										{{$errors->first('alamat')}}
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
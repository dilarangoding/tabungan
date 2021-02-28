@extends('layouts.master')
@section('title','Tambah uang masuk')
    
@section('content')
    

  <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Tambah uang masuk</h1>
           
       </div>

       <div class="row justify-content-center">

            <div class="col-md-6">

               <div class="card">
                  <div class="card-header bg-gradient-primary text-white">
                     Tambah uang masuk
                  </div>

                  <div class="card-body">
                     <form action="{{ url('tabungan_masuk/store') }}" method="post">
                        @csrf
                        <div class="form-group">
                           <label for="">Kode Transaksi</label>
                           <input type="text" class="form-control" required id="kode" value="" name="kode" readonly>
                          
                        </div>
                         <div class="form-group">
                           <label for="email">Nama siswa</label>
                           <select name="user_id" id="user_id" required class="form-control">
                              <option value="" disabled selected>Pilih siswa</option>
                              @foreach ($siswa as $item)
                                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                           <span class="text-danger">
										{{$errors->first('email')}}
									</span>
                        </div>
                        
                        <div class="form-group">
                           <label for="no">Tanggal masuk</label>
                           <input type="text" name="tanggal" class="form-control" placeholder="Masukan no hp" required readonly value="<?= date('d-m-Y ')?>">
                           <span class="text-danger">
										{{$errors->first('tanggal')}}
									</span>
                        </div>

                        <div class="form-group">
                           <label for="jumlah">Jumlah uang masuk</label>
                           <input type="number" required placeholder="Masukan jumlah uang" name="jumlah" class="form-control">

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

@section('js')
      <script>
        function randomNumber(len) {
            var randomNumber;
            var date = Date.now();
            
            var n = 'TM-';

            for(var count = 0; count < len; count++) {
                randomNumber = Math.floor(Math.random() * 10);
                n += randomNumber.toString();
            }
            return n;
        }
        document.getElementById("kode").value = randomNumber(9);
        onload = function(){randomNumber();}
        

    </script>
@endsection
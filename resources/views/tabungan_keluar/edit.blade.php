@extends('layouts.master')
@section('title','Edit uang keluar')
    
@section('content')
    

  <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Edit uang keluar</h1>
           
       </div>

       <div class="row justify-content-center">

            <div class="col-md-6">

               <div class="card">
                  <div class="card-header bg-gradient-primary text-white">
                     Edit uang keluar
                  </div>

                  <div class="card-body">
                     <form action="{{ url('tabungan_keluar/update',$tabungan->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                           <label for="">Kode Transaksi</label>
                           <input type="text" class="form-control" id="kode" required value="{{ $tabungan->kode_transaksi }}" name="kode" readonly>
                          
                        </div>
                         <div class="form-group">
                           <label for="email">Nama siswa</label>
                           <select name="user_id" id="user_id" required class="form-control">
                              <option value="" disabled selected>Pilih siswa</option>
                              @foreach ($siswa as $item)
                                  <option value="{{ $item->id }}" {{ $tabungan->user_id === $item->id?'selected':'' }}>{{ $item->name }}</option>
                              @endforeach
                           </select>
                           <span class="text-danger">
										{{$errors->first('user_id')}}
									</span>
                        </div>

                        <div class="form-group">
                           <label for="saldo">Sisa saldo</label>
                           <input type="text" id="saldo" placeholder="Sisa saldo anda" readonly class="form-control" value="{{ $saldo->total_tabungan }}">
                        </div>

                        
                        <div class="form-group">
                           <label for="no">Tanggal keluar</label>
                           <input type="text" name="tanggal" readonly required class="form-control" value="{{ $tabungan->tanggal_keluar }}"  placeholder="Masukan no hp">
                           <span class="text-danger">
										{{$errors->first('tanggal')}}
									</span>
                        </div>

                        <div class="form-group">
                           <label for="jumlah">Jumlah uang keluar</label>
                           <input type="number" required placeholder="Masukan jumlah uang" value="{{ $tabungan->jumlah_uang_keluar }}" name="jumlah" class="form-control">

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
      $("#user_id").change(function() {
            var id = $(this).val();
            var url = '{{URL::to('getDetailSaldo')}}/' +id;
           
             $.ajax({
                  url: url,
                  type: 'get',
                  dataType: 'json',
                  success: function(response){
                     var x = new Number(response.name).toLocaleString("jakarta");
                     
                       $('#saldo').val(x);
                  }
               });
           }); 
   </script>
@endsection
@extends('layouts.master')

@section('title','Riwayat Tabungan keluar')
    
@section('content')

    <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Riwayat Tabungan keluar</h1>
           
       </div>
      
       <div class="row ">
            
        
          <div class="col-md-12">

            <div class="card shadow">

                <div class="card-header ">

                    <div class="card-title ">
                        List riwayat tabungan keluar
                        <a href="{{ url('report/tabunganKeluar') }}" class="btn btn-success btn-sm  float-right">Print Excel</a>
                     </div>
                     
                     
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap text-center" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nama </th>
                                    <th>Tanggal keluar</th>
                                    <th>Jumlah uang keluar</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tabungan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_transaksi }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ date('d-m-Y ',strtotime($item->tanggal_keluar))}}</td>
                                        <td>Rp. {{ number_format($item->jumlah_uang_keluar) }}</td>
                                        
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

          </div>

       </div>   



    </div>

    

@endsection

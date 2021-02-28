@extends('layouts.master')

@section('title','Dashboard')

@section('content')



<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>

   @if (Auth()->user()->IsAdmin == TRUE)
        <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Total Saldo</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($total_saldo_admin) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-poll-h fa-2x text-gray-300"></i>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                              Total Saldo Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($uang_masuk_admin) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                              Total Saldo Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($uang_keluar_admin) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                              Jumlah siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa }}</div>
                        </div>
                        <div class="col-auto">
                         
                             <i class="fas fa-user-graduate    fa-2x text-gray-300"></i>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                              Jumlah Kelas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kelas }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard fa-2x text-gray-300"></i>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> 
   @else
        <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Total Saldo Saya</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($total_saldo) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-poll-h fa-2x text-gray-300"></i>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                              Total Saldo Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($uang_masuk) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                              Total Saldo Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($uang_keluar) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @endif
    

</div> 



@endsection
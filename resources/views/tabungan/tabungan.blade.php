@extends('layouts.master')

@section('title',' Tabungan ')
    
@section('content')

    <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800"> Tabungan </h1>
           
       </div>
      
       <div class="row ">
            
        
          <div class="col-md-12">

            <div class="card shadow">

                <div class="card-header  ">

                    <div class="card-title ">
                        List  tabungan 
                        
                        @if (Auth::user()->IsAdmin == TRUE)
                            <a href="{{ url('report/tabungan') }}" class="btn btn-sm btn-success float-right">Print excel</a>
                        @endif
                     </div>
                     
                     
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap text-center" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama </th>
                                    <th>Total saldo</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tabungan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name}}</td>
                                        <td>Rp. {{ number_format($item->total_tabungan) }}</td>
                                        
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

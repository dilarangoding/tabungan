@extends('layouts.master')

@section('title','Tabungan keluar')
    
@section('content')

    <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Tabungan keluar</h1>
           
       </div>
      
       <div class="row ">
            
        
          <div class="col-md-12">

            <div class="card shadow">

                <div class="card-header ">

                    <div class="card-title ">
                        List tabungan keluar
                        <a href="{{ url('/add_tabungan_keluar') }}" class="btn btn-info btn-sm float-right">Tarik Saldo</a>
                         <a href="{{ url('report/tabunganKeluar') }}" class="btn btn-success btn-sm mr-2 float-right">Print Excel</a>
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
                                    <th>Aksi </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tabungan_keluar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_transaksi }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ date('d-m-Y ',strtotime($item->tanggal_keluar))}}</td>
                                        <td>Rp. {{ number_format($item->jumlah_uang_keluar) }}</td>
                                        <td>
                                            <a href="{{ url('tabungan_keluar/edit',$item->id) }}" class="btn btn-warning btn-sm btn-edit" >Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete" keluar-id ="{{ $item->id }}">Hapus</a>
                                        </td>
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
@section('js')
	<script>
	
       

		$('.delete').on('click',function(){
			var id = $(this).attr('keluar-id');
			var url = '{{URL::to('tabungan_keluar/hapus')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin menghapus data tabungan keluar?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Hapus'
			}).then((result) => {
				if (result.value) {
					window.location = url;
				}
			})
		});

	</script>
	@endsection
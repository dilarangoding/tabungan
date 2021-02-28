@extends('layouts.master')

@section('title','Tabungan masuk')
    
@section('content')

    <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Tabungan masuk</h1>
           
       </div>
      
       <div class="row ">
            
        
          <div class="col-md-12">

            <div class="card shadow">

                <div class="card-header ">

                    <div class="card-title ">
                        List tabungan masuk
                        <a href="{{ url('/add_tabungan_masuk') }}" class="btn btn-info btn-sm float-right">Tambah tabungan</a>
                        <a href="{{ url('report/tabunganMasuk') }}" class="btn btn-success btn-sm mr-2 float-right">Print Excel</a>
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
                                    <th>Tanggal Masuk</th>
                                    <th>Jumlah uang masuk</th>
                                    <th>Aksi </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tabungan_masuk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_transaksi }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ date('d-m-Y ',strtotime($item->tanggal_masuk))}}</td>
                                        <td>Rp. {{ number_format($item->jumlah_uang_masuk) }}</td>
                                        <td>
                                            <a href="{{ url('tabungan_masuk/edit',$item->id) }}" class="btn btn-warning btn-sm btn-edit" >Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete" masuk-id ="{{ $item->id }}">Hapus</a>
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
			var id = $(this).attr('masuk-id');
			var url = '{{URL::to('tabungan_masuk/hapus')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin menghapus data tabungan masuk?",
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
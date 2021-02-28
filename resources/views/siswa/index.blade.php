@extends('layouts.master')

@section('title','siswa')
    
@section('content')

    <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">siswa</h1>
           
       </div>
      
       <div class="row ">
            
        
          <div class="col-md-12">

            <div class="card shadow">

                <div class="card-header ">

                    <div class="card-title ">
                        List Siswa
                        <a href="{{ url('/add_siswa') }}" class="btn btn-info btn-sm float-right">Tambah</a>
                     </div>
                     
                     
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap text-center" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kelas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Aksi </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($siswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->nama_kelas }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>
                                            <a href="{{ url('siswa/edit',$item->id) }}" class="btn btn-warning btn-sm btn-edit" >Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete" siswa-id ="{{ $item->id }}">Hapus</a>
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
			var id = $(this).attr('siswa-id');
			var url = '{{URL::to('siswa/hapus')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin menghapus data siswa?",
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
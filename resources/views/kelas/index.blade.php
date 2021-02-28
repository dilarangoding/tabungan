@extends('layouts.master')

@section('title','Kelas')
    
@section('content')

    <div class="container-fluid">

       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Kelas</h1>
           
       </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
           </div>
        @endif
       <div class="row ">
            
          <div class="col-md-4">
                
                <div class="card shadow ">

                    <div class="card-header bg-gradient-primary">
                        <div class="card-title text-white">
                            Tambah Kelas
                        </div>
                    </div>

                    <div class="card-body">

                        <form action="{{ url('add_kelas') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="">Nama Kelas</label>
                                <input type="text" class="form-control" name="nama_kelas" required placeholder="Masukan nama kelas">
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>

                    </div>

                </div>

          </div>

          <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-gradient-primary">

                    <div class="card-title text-white">
                        List Kelas
                     </div>
                     
                     
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap text-center" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Aksi </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($kelas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kelas }}</td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="{{$item->id}}">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete" kelas-id ="{{ $item->id }}">Hapus</a>
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

    {{-- modal --}}
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post" id="formData">
					@csrf
					<div class="modal-body">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="button" class="btn btn-primary btn-update">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection
@section('js')
	<script>
		$(document).ready( function () {
		$('#table').DataTable({
			"info":     false,
			

		});
	} );
		$('.btn-edit').on('click',function(){
            var id = $(this).data('id');
           
			var url = '{{URL::to('kelas/edit')}}/' +id;
			$.ajax({
				url:url,
				method:'GET',
				success:function(data){
					$("#modal-edit").find(".modal-body").html(data)
					$("#modal-edit").modal('show')
				},
				error:function(error){
					console.log(error)
				}
			})
		});

		$('.btn-update').on('click',function(){
			
			var id = $('.form-group').find('#id').val()
			var url = '{{URL::to('kelas/update')}}/' +id;
			var data = $("#formData").serialize();
			
			var urlBaru = "{{url('kelas')}}";

			$.ajax({
				data:data,
				url:url,
				method:"POST",
				success:function(data){
					$('#modal-edit').modal('hide');
					window.location.assign(urlBaru);
				},
				error:function(error){
					
				}
			});
		});

		$('.delete').on('click',function(){
			var id = $(this).attr('kelas-id');
			var url = '{{URL::to('kelas/hapus')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin menghapus data kelas?",
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
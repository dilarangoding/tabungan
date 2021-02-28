<table  style="border: 1px solid black;">
	<tr>
		<th colspan="5" style="text-align: center; font-size: 16px;">LAPORAN REKAP DATA TABUNGAN MASUK</th>
	</tr>
	<tr>

      <th   style="text-align: center; border: 1px solid black;">No</th>
      <th	style="width:30px; text-align: center; border: 1px solid black;">Kode Transaksi</th>
      <th	style="width:30px; text-align: center; border: 1px solid black;">Nama</th>
      <th	style="width:23px; text-align: center; border: 1px solid black;">Tanggal Masuk</th>
		<th   style="width:23px; text-align: center; border: 1px solid black;">Jumlah Uang Masuk</th>
		
   </tr>
   
	@foreach($tabungan as $item)
	<tr>
			
         <td style="text-align: center; border: 1px solid black;">{{$loop->iteration}}</td>
         <td style="text-align: center; border: 1px solid black;">{{$item->kode_transaksi}}</td>
         <td style="text-align: center; border: 1px solid black;">{{$item->name}}</td>
         <td style="text-align: center; border: 1px solid black;">{{date('d-m-Y ',strtotime($item->tanggal_masuk))}}</td>
			<td style="text-align: center; border: 1px solid black;">{{number_format($item->jumlah_uang_masuk)}}</td>
	

	</tr>
   @endforeach
   <tr>
      <th colspan="4" style="text-align: center; background-color:yellow;">Total</th>
      <th style="text-align: center; width:30px; background-color:yellow;">{{ number_format($total )}}</th>
   </tr>
</table>
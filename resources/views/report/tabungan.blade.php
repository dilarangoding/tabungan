<table  style="border: 1px solid black;">
	<tr>
		<th colspan="3" style="text-align: center; font-size: 16px;">LAPORAN REKAP DATA TABUNGAN</th>
	</tr>
	<tr>

		<th style="text-align: center; border: 1px solid black;">No</th>
		<th	style="width:30px; text-align: center; border: 1px solid black;">Nama</th>
		<th style="width:23px; text-align: center; border: 1px solid black;">Total saldo</th>
		
	</tr>
	@foreach($tabungan as $item)
	<tr>
			
			<td style="text-align: center; border: 1px solid black;">{{$loop->iteration}}</td>
			<td style="text-align: center; border: 1px solid black;">{{$item->name}}</td>
			<td style="text-align: center; border: 1px solid black;">{{number_format($item->total_tabungan)}}</td>
	

	</tr>
	@endforeach
	<tr>
		<th colspan="2" style="text-align: center; background-color:yellow;">Total</th>
		<th style="text-align: center; background-color:yellow;">{{ number_format($total) }}</th>
	</tr>
</table>
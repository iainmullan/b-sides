
<table>
	@foreach($tracklists as $tl)

		@foreach($tl->tracks->items as $i => $t)

			<tr>
				<td>{{ $t->track_number }}</td>
				<td>{{ $tl->name }}</td>
				<td>{{ $t->name }}</td>
			</tr>

		@endforeach

	@endforeach

</table>


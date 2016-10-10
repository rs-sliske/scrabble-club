<div class="is-centered-x box">
<h2>Statistics</h2>
<table class="table stats-table">
	@foreach(($stats = $user->toArray())['formatted'] as $key => $value)
		@if($key != 'name')
			<tr class="stat-row">
				<td class="stat-label">{{ $stats['keys'][$key] }}</td>
				<td class="stat-value">{{ $value }}</td>
			</tr>
		@endif
	@endforeach

</table>
</div>
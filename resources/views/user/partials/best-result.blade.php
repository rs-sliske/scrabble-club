<div class="is-centered-x box">
<h2>Best Result</h2>
<table class="table stats-table">
	<tr>
		<td>Score</td>
		<td>{{ $user->bestMatch()->score($user) }}</td>
	</tr>
	<tr>
		<td>Against</td>
		<td><a class="plain" href="{{ route('users.show', [$other = $user->bestMatch()->otherPlayer($user)]) }}">{{ $other->name }}</a></td>
	</tr>
	<tr>
		<td>On</td>
		<td>{{ $user->bestMatch()->created_at }}</td>
	</tr>
</table>
</div>
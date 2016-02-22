<table class="table">
    <thead>
    <th>Name</th>
			<th>Email</th>
			<th>Password</th>
			<th>Start Year</th>
			<th>End Year</th>
			<th>Photo</th>
			<th>Department Id</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->name !!}</td>
			<td>{!! $user->email !!}</td>
			<td>{!! $user->password !!}</td>
			<td>{!! $user->start_year !!}</td>
			<td>{!! $user->end_year !!}</td>
			<td>{!! $user->photo !!}</td>
			<td>{!! $user->department_id !!}</td>
            <td>
                <a href="{!! route('users.edit', [$user->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('users.delete', [$user->id]) !!}" onclick="return confirm('Are you sure wants to delete this User?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

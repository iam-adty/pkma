<table class="table">
    <thead>
    <th>Name</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($departments as $department)
        <tr>
            <td>{!! $department->name !!}</td>
            <td>
                <a href="{!! route('departments.edit', [$department->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('departments.delete', [$department->id]) !!}" onclick="return confirm('Are you sure wants to delete this Department?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

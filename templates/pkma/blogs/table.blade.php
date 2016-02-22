<table class="table">
    <thead>
    <th>Title</th>
			<th>Teaser</th>
			<th>Body</th>
			<th>Image</th>
			<th>User Id</th>
			<th>Status</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($blogs as $blog)
        <tr>
            <td>{!! $blog->title !!}</td>
			<td>{!! $blog->teaser !!}</td>
			<td>{!! $blog->body !!}</td>
			<td>{!! $blog->image !!}</td>
			<td>{!! $blog->user_id !!}</td>
			<td>{!! $blog->status !!}</td>
            <td>
                <a href="{!! route('blogs.edit', [$blog->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('blogs.delete', [$blog->id]) !!}" onclick="return confirm('Are you sure wants to delete this Blog?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

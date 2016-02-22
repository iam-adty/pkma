<table class="table">
    <thead>
    <th>Title</th>
			<th>Teaser</th>
			<th>Body</th>
			<th>Logo</th>
			<th>Image</th>
			<th>User Id</th>
			<th>Status</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($brands as $brand)
        <tr>
            <td>{!! $brand->title !!}</td>
			<td>{!! $brand->teaser !!}</td>
			<td>{!! $brand->body !!}</td>
			<td>{!! $brand->logo !!}</td>
			<td>{!! $brand->image !!}</td>
			<td>{!! $brand->user_id !!}</td>
			<td>{!! $brand->status !!}</td>
            <td>
                <a href="{!! route('brands.edit', [$brand->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('brands.delete', [$brand->id]) !!}" onclick="return confirm('Are you sure wants to delete this Brand?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

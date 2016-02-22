<table class="table">
    <thead>
    <th>Title</th>
			<th>Teaser</th>
			<th>Body</th>
			<th>Image</th>
			<th>Status</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($news as $news)
        <tr>
            <td>{!! $news->title !!}</td>
			<td>{!! $news->teaser !!}</td>
			<td>{!! $news->body !!}</td>
			<td>{!! $news->image !!}</td>
			<td>{!! $news->status !!}</td>
            <td>
                <a href="{!! route('news.edit', [$news->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('news.delete', [$news->id]) !!}" onclick="return confirm('Are you sure wants to delete this News?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

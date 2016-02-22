<table class="table">
    <thead>
    <th>Title</th>
			<th>Description</th>
			<th>Url</th>
			<th>Image</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($sliders as $slider)
        <tr>
            <td>{!! $slider->title !!}</td>
			<td>{!! $slider->description !!}</td>
			<td>{!! $slider->url !!}</td>
			<td>{!! $slider->image !!}</td>
            <td>
                <a href="{!! route('sliders.edit', [$slider->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('sliders.delete', [$slider->id]) !!}" onclick="return confirm('Are you sure wants to delete this Slider?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

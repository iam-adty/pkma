<!-- Title Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('title', 'Title:') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Teaser Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('teaser', 'Teaser:') !!}
	{!! Form::textarea('teaser', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('body', 'Body:') !!}
	{!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('image', 'Image:') !!}
	{!! Form::file('image') !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('status', 'Status:') !!}
	{!! Form::select('status', [ 'draft' => 'draft', 'published' => 'published', 'hold' => 'hold' ], null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>

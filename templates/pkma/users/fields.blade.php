<!-- Name Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('name', 'Name:') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('email', 'Email:') !!}
	{!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('password', 'Password:') !!}
	{!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Year Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('start_year', 'Start Year:') !!}
	{!! Form::number('start_year', null, ['class' => 'form-control']) !!}
</div>

<!-- End Year Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('end_year', 'End Year:') !!}
	{!! Form::number('end_year', null, ['class' => 'form-control']) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('photo', 'Photo:') !!}
	{!! Form::file('photo') !!}
</div>

<!-- Department Id Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('department_id', 'Department Id:') !!}
	{!! Form::number('department_id', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>

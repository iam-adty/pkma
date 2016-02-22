<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{!! $user->password !!}</p>
</div>

<!-- Start Year Field -->
<div class="form-group">
    {!! Form::label('start_year', 'Start Year:') !!}
    <p>{!! $user->start_year !!}</p>
</div>

<!-- End Year Field -->
<div class="form-group">
    {!! Form::label('end_year', 'End Year:') !!}
    <p>{!! $user->end_year !!}</p>
</div>

<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', 'Photo:') !!}
    <p>{!! $user->photo !!}</p>
</div>

<!-- Department Id Field -->
<div class="form-group">
    {!! Form::label('department_id', 'Department Id:') !!}
    <p>{!! $user->department_id !!}</p>
</div>


@extends('layouts.app')
@section('content')
<example-component></example-component>
    {{ Form::open(['route' => ['bookme.store'], 'class' => 'form-group']) }}
    <div class="row">
        <div class="col-md-6">
    {{ Form::text('title', 'New Books', ['class' => 'form-control-lg', 'data-book'=>'@json($book)']) }}
        </div>
        <div class="row">
        <div class="col-md-6">
    {{ Form::text('body', 'lorem epsom..', ['class' => 'form-control-lg']) }}
</div>
</div>
   <div class="row">
    <div class="col-md-6">
        {{ Form::text('tags', 'fiction, science', ['class' => 'form-control-lg']) }}
    </div>
</div>
  <div class="row">
     <div class="col-md-6">
        {{ Form::submit('Send', ['class' => 'btn btn-success']) }}
    </div>
</div>
   <div class="row">
    <div class="col-md-6">
        {{ Form::close() }}
    </div>
</div>
    </div>
@endsection

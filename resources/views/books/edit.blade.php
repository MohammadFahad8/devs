@extends('layouts.app')
@section('content')
    {{ Form::open(['route' => ['bookme.store'], 'class' => 'form-group']) }}
    <div class="row">
        <div class="col-md-6">
    {{ Form::text('title',$book->title, ['class' => 'form-control-lg', 'data-book'=>'@json($book)']) }}
        </div>
        <div class="row">
        <div class="col-md-6">
    {{ Form::text('body', $book->body,  ['class' => 'form-control-lg']) }}
</div>
</div>
   <div class="row">
    <div class="col-md-6">
        {{ Form::text('tags', $book->tags, ['class' => 'form-control-lg']) }}
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

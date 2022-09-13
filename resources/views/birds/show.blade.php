@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($birds->title) ? $birds->title : 'Birds' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('birds.birds.destroy', $birds->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('birds.birds.index') }}" class="btn btn-primary" title="Show All Birds">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('birds.birds.create') }}" class="btn btn-success" title="Create New Birds">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('birds.birds.edit', $birds->id ) }}" class="btn btn-primary" title="Edit Birds">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Birds" onclick="return confirm(&quot;Click Ok to delete Birds.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Title</dt>
            <dd>{{ $birds->title }}</dd>
            <dt>Body</dt>
            <dd>{{ $birds->body }}</dd>

        </dl>

    </div>
</div>

@endsection
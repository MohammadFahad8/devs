@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($zebra->title) ? $zebra->title : 'Zebra' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('zebras.zebra.destroy', $zebra->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('zebras.zebra.index') }}" class="btn btn-primary" title="Show All Zebra">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('zebras.zebra.create') }}" class="btn btn-success" title="Create New Zebra">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('zebras.zebra.edit', $zebra->id ) }}" class="btn btn-primary" title="Edit Zebra">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Zebra" onclick="return confirm(&quot;Click Ok to delete Zebra.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Title</dt>
            <dd>{{ $zebra->title }}</dd>
            <dt>Body</dt>
            <dd>{{ $zebra->body }}</dd>

        </dl>

    </div>
</div>

@endsection
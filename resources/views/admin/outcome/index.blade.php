@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('outcome.create')}}" class="btn btn-primary">Add Outcome</a>
    <button class="btn btn-outline-warning">Today Outcome: {{$todayOutcome}} ks</button>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Amount</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($outcome as $o)
        <tr>
            <td>{{$o->title}}</td>
            <td>{{$o->amount}} ks</td>
            <td>{{$o->description}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

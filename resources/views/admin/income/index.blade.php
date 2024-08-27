@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('income.create')}}" class="btn btn-primary">Add Income</a>
    <button class="btn btn-outline-warning">Today Income: {{$todayIncome}} ks</button>
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
        @foreach ($income as $i)
        <tr>
            <td>{{$i->title}}</td>
            <td>{{$i->amount}} ks</td>
            <td>{{$i->description}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

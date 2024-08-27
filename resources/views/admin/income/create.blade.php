@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('income.index')}}" class="btn btn-primary">All Income</a>
</div>
    <hr>
    <form action="{{route('income.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Enter Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Enter Amount</label>
            <input type="number" name="amount" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Write Description</label>
            <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <input type="submit" value="Add" class="btn btn-primary">
    </form>
@endsection

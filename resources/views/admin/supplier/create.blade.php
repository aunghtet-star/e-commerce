@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('supplier.index')}}" class="btn btn-primary">All Suppliers</a>
</div>
    <hr>
    <form action="{{route('supplier.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Enter Supplier Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <input type="submit" value="Add" class="btn btn-primary">
    </form>
@endsection

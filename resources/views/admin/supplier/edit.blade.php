@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('supplier.index')}}" class="btn btn-primary">All Suppliers</a>
</div>


    <hr>
    <form action="{{route('supplier.update',$cat->slug)}}" method="POST">
        @csrf
        @method('Put');
        <div class="form-group">
            <label for="">Enter Supplier Name</label>
            <input type="text" name="name" value="{{$cat->name}}" class="form-control">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection

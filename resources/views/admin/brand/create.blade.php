@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('brand.index')}}" class="btn btn-primary">All Brands</a>
</div>


    <hr>
    <form action="{{route('brand.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Enter Brand Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <input type="submit" value="Create" class="btn btn-primary">
    </form>
@endsection

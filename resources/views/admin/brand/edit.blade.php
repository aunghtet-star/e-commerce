@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('brand.index')}}" class="btn btn-primary">All Brands</a>
</div>


    <hr>
    <form action="{{route('brand.update',$br->slug)}}" method="POST">
        @csrf
        @method('Put');
        <div class="form-group">
            <label for="">Enter Brand Name</label>
            <input type="text" name="name" value="{{$br->name}}" class="form-control">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection

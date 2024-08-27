@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('category.index')}}" class="btn btn-primary">All Category</a>
</div>


    <hr>
    <form action="{{route('category.update',$cat->slug)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('Put')
        <div class="form-group">
            <label for="">Enter Category Name</label>
            <input type="text" name="name" value="{{$cat->name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Enter Category Name (MM)</label>
            <input type="text" name="mm_name" value="{{$cat->mm_name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Choose Image</label>
            <input type="file" name="image" class="form-control">
            <img src="{{asset('images/'.$cat->image)}}" width="100" class="img-thumbnail">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection

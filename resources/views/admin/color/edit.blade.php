@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('color.index')}}" class="btn btn-primary">All Colors</a>
</div>


    <hr>
    <form action="{{route('color.update',$col->slug)}}" method="POST">
        @csrf
        @method('Put');
        <div class="form-group">
            <label for="">Enter Color</label>
            <input type="text" name="name" value="{{$col->name}}" class="form-control">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection

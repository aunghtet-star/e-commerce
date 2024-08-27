@extends('admin.layout.master')
@section('content')
<div>
    <a href="{{route('color.create')}}" class="btn btn-primary">Create color</a>
</div>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Option</th>
        </tr>
    <thead>
    <tbody>
        @foreach ($color as $cl)
            <tr>
                <td>
                    {{$cl->name}}
                </td>
                <td>
                    <a href="{{route('color.edit',$cl->slug)}}" class="btn btn-primary">Edit</a>
                    <form action="{{route('color.destroy',$cl->slug)}}" class="d-inline" method="POST" onsubmit="return confirm('This color will be deleted permanently!')">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach


    </tbody>

    </table>
    {{$color->links()}}
@endsection

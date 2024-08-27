@extends('admin.layout.master')
@section('content')
<div>
    <a href="{{route('brand.create')}}" class="btn btn-primary">Create Brand</a>
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
        @foreach ($brand as $b)
            <tr>
                <td>
                    {{$b->name}}
                </td>
                <td>
                    <a href="{{route('brand.edit',$b->slug)}}" class="btn btn-primary">Edit</a>
                    <form action="{{route('brand.destroy',$b->slug)}}" class="d-inline" method="POST" onsubmit="return confirm('This brand will be deleted permanently!')">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach


    </tbody>

    </table>
    {{$brand->links()}}
@endsection

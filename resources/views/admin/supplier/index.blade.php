@extends('admin.layout.master')
@section('content')
<div>
    <a href="{{route('supplier.create')}}" class="btn btn-primary">Create Supplier</a>
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
        @foreach ($supplier as $c)
            <tr>
                <td>
                    {{$c->name}}
                </td>
                <td>
                    <a href="{{route('supplier.edit',$c->slug)}}" class="btn btn-primary">Edit</a>
                    <form action="{{route('supplier.destroy',$c->slug)}}" class="d-inline" method="POST" onsubmit="return confirm('This supplier will be removed permanently!')">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach


    </tbody>

    </table>
    {{$supplier->links();}}
@endsection

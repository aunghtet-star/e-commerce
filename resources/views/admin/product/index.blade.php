@extends('admin.layout.master')
@section('content')
<div>
    <a href="{{route('product.create')}}" class="btn btn-primary">Create Product</a>
</div>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Remain Qty</th>
            <th>Add or Remove</th>
            <th>Option</th>
        </tr>
    <thead>
    <tbody>
        @foreach ($products as $p)
            <tr>
                <td><img src="{{asset('/images/'.$p->image)}}" style="width:200px" class="img-thumbnail" alt=""></td>
                <td>{{$p->name}}</td>
                <td>{{$p->category->slug}}</td>
                <td>{{$p->total_quantity}}</td>
                <td>
                    <a href="{{url('admin/product-remove/'.$p->slug)}}" class="btn btn-success">-</a>
                    <a href="{{url('admin/create-product-add/'.$p->slug)}}" class="btn btn-warning">+</a>
                </td>
                <td>
                    <a href="{{route('product.edit',$p->slug)}}" class="btn btn-primary">Edit</a>
                    <form action="{{route('product.destroy',$p->slug)}}" class="d-inline" method="POST" onsubmit="return confirm('This product will be deleted permanently!')">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach


    </tbody>

    </table>
    {{$products->links()}}
@endsection

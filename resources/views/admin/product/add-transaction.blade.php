@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{url('/admin/product-add-transaction')}}" class="btn btn-outline-success">Add Transaction</a>
    <a href="{{url('/admin/product-remove-transaction')}}" class="btn btn-outline-danger">Remove Transaction</a>
</div>
<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Total Quantity</th>
            <th>Description</th>
            <th>Buy Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $t)
            <tr>
                <td>
                    <img src="{{asset('/images/'.$t->product->image)}}" width="100" class="img-thumbnail" alt="">
                </td>
                <td>
                    {{$t->product->name}}
                </td>
                <td>
                    {{$t->total_quantity}}
                </td>
                <td>
                    {{$t->description}}
                </td>
                <td>
                    {{$t->created_at}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

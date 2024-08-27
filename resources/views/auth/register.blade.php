@extends('layout.master')
@section('header-text','Register')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-header bg-warning text-center text-white" >Register</div>
                <div class="card-body">
                    <form method="POST" action="{{url('/register')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Enter Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Enter Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Enter Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Choose Profile Picture</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Enter Phone Number</label>
                            <input type="number" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Enter Address</label>
                            <textarea name="address" id="" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <input type="submit" class="btn btn-warning" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

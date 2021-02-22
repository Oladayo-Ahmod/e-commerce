@extends('master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 col-lg-4 p-1 shadow bg-light">
            <form action="logins" method="POST">
                @csrf
                <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" id="" aria-describedby="emailHelpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" id="" aria-describedby="emailHelpId" placeholder="">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
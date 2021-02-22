@extends('master')
@section('content')
    <div class="container mt-0 mb-5">
        <div class="row">
            <div class="col-md-6 my-4">
                {{-- <a href="detail/{{$product['id']}}"> --}}
                    <div class=" details shadow" style=" border-color:rgb(230, 230, 248);">
                        <img class="card-img-top" src="{{ url('assets/images')}}/{{$details['gallery']}}" alt="trending product">
                    </div>
            </div>

            <div class="col-md-6">
                <div class="card-body">
                    <a href="/">previous page</a>
                    <h2 class="card-title text-secondary">{{$details['name']}}</h2>
                    <h4 class="text-secondary">Price : <span class="badge badge-pill badge-danger">{{$details['price']}}</span> </h4>
                    <h4 class="text-secondary">Product Category : {{$details['category']}}</h4>
                    <p class="card-text">Product Description : {{$details['description']}}</p>
                    <br><br><br>
                    <form action="/add_to_cart" method="POST">
                        @csrf
                        <input type="hidden" name="cart" value="{{$details['id']}}">
                        <button class=" my-3 btn btn-danger">Add to cart</button><br>
                    </form>
                    <button type="button" class="btn btn-success">Buy now</button>
                </div>
            </div>
        </div>
    </div>
@endsection
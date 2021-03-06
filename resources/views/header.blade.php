<?php
    use App\Http\Controllers\ProductController;
    $total_items = 0;
    if (Session::has('user')) {
        $total_items = ProductController::CartNum();   
    }
 ?>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="#">E-commerce</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/orderlist">Orders</a>
            </li>
            <form class="form-inline my-2 my-lg-0" action="/search">
                <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </ul>
        <button class="btn">
                <a href="/cartlist" style="text-decoration:none;">
                        <span class="text-secondary" >Cart</span>
                        <span class="badge badge-pill badge-warning">{{$total_items}}</span>
                </a>
       </button>
        <ul class="nav nav-tabs">
            @if(Session::has('user')) 
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                 role="button" aria-haspopup="true" aria-expanded="false">{{Session::get('user')['name']}}</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/logout">logout</a>
                </div>
            </li>
            @else
            <li class="nav-link"><a href="/logins">login</a></li>
            <li class="nav-link"><a href="/register">register</a></li>
            @endif
        </ul>
    </div>
   
</nav>
    
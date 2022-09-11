<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Cart</title>

    <link rel="canonical" href="{{ route('cart') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/product_image.css') }}" rel="stylesheet">
</head>

<body>

<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="{{route('products')}}" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
                <strong>Products</strong>
            </a>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    <a href="{{route('products')}}"><strong class="text-white mr-2" id="cart-count">Products</strong></a>
                    @auth
                        <a href="{{route('logout')}}"><strong class="text-white">Logout</strong></a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</header>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Cart</h1>
            @if(session()->has('message'))
                <p class="alert alert-secondary">{{ session('message') }}</p>
            @endif
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            @if(count($cart) > 0)
                <table class="table table-white table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Single Price</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $value['title'] }}</td>
                            <td><img width="100" height="100" src="{{ $value['image'] }}" alt=""></td>
                            <td>{{ $value['price'] }}</td>
                            <td>
                                <center>
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="product_id" hidden value="{{ $value['productId'] }}">
                                        <input type="text" name="quantity" hidden value="1">
                                        <button type="submit" class="btn btn-success">+</button>
                                    </form>
                                    {{ $value['quantity'] }}
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="product_id" hidden value="{{ $value['productId'] }}">
                                        <input type="text" name="quantity" hidden value="-1">
                                        <button id="{{$value['productId']}}" class="btn btn-danger">-</button>
                                    </form>
                                </center>
                            </td>
                            <td><input class="form-control" type="text" disabled
                                       value="{{ $value['quantity'] * $value['price'] }}"></td>
                            <td>
                                <center>
                                    <form action="{{ route('cart.delete.product') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="product_id" hidden value="{{ $value['productId'] }}">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
                            @if(!session()->has('coupon'))
                            <form action="{{ route('cart.apply_coupon') }}" method="POST">
                                @csrf
                                <label for="coupon">Code: </label>
                                <input type="text" name="coupon" class="form-control">
                                <button type="submit" class="btn btn-success m-1">Apply Coupon</button>
                            </form>
                            @else
                               Code: {{ session('coupon')['code'] }}
                            <form action="{{ route('cart.remove_coupon') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger m-1">Remove Coupon</button>
                            </form>
                            @endif
                        </td>
                        <td colspan="3">
                            <center><strong>Total Price: {{ $totalPrice }}</strong></center>
                        </td>
                        <td colspan="1">
                            <form action="{{ route('cart.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Cart</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @else
                <p class="alert alert-info">There is no product in cart</p>
            @endif
        </div>
    </div>

</main>

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>Cart</p>
    </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>window.jQuery</script>
<script src="{{ asset('assets/js/poper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/holder.js') }}"></script>


<script>
    $(document).ready(function () {
        console.log('ready')
    });
</script>
</body>
</html>

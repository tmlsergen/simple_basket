<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Products</title>

    <link rel="canonical" href="{{ route('products') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/product_image.css') }}" rel="stylesheet">
</head>

<body>

<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                <strong>Products</strong>
            </a>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    <a href="{{route('cart')}}"><strong class="text-white mr-2" id="cart-count">Cart ({{ count($cart) }})</strong></a>
                    @auth
                        <a href="{{route('logout')}}"><strong class="text-white">Logout</strong></a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
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
            <h1 class="jumbotron-heading">Products</h1>
            @if(session()->has('message'))
                <p class="alert alert-secondary">{{ session('message') }}</p>
            @endif
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="{{ $product->image }}" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">{{ $product->title }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" data-id="{{ $product->id }}" id="addToCart{{$product->id}}" class="btn btn-outline-secondary">Add To Cart</button>
                                </div>
                                <small class="text-muted">${{ $product->price }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{ $products->links() }}
            </div>
        </div>
    </div>

</main>

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>Products</p>
    </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>window.jQuery</script>
<script src="{{ asset('assets/js/poper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/holder.js') }}"></script>


<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        @foreach($products as $product)
            $('#addToCart{{$product->id}}').click(function (e) {
                e.preventDefault()

                $.ajax({
                    method:'POST',
                    url: '{{ route('cart.post') }}',
                    data: {
                        product_id : {{$product->id}}
                    },
                    success: function (resp) {
                        cartKeys = Object.keys(resp.cart)

                        $('#cart-count').text(`Cart (${cartKeys.length})`)

                        toastr.success('Product added to cart: {{$product->title}}')
                    },
                    error: function (resp) {
                        var errors = resp.responseJSON;

                        toastr.error(errors.message)
                    }
                });
            });
        @endforeach
    });
</script>
</body>
</html>

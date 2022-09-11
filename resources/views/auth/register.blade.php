
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shopping Cart Register</title>

    <link rel="canonical" href="{{ route('register') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/register.css') }}" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" method="POST" action="{{ route('register') }}">
    @csrf
    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
    <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>

    <label for="inputEmail" class="sr-only">Name</label>
    <input type="text" id="inputName" name="name" class="form-control" placeholder="Name" required autofocus>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="text" id="inputSurname" name="surname" class="form-control" placeholder="Surname" required autofocus>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control password-format" placeholder="Password" required>

    <label for="inputPasswordConfirmation" class="sr-only">Re-Password</label>
    <input type="password" id="inputPasswordConfirmation" name="password_confirmation" class="form-control password-format" placeholder="Re-Password" required>

    <button class="btn btn-lg btn-primary btn-block mt-5" type="submit">Sign Up</button>
</form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyShop</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Padauk:wght@400;700&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('web_asset/css/argon.min.css')}}">
    <link rel="stylesheet" href="{{asset('web_asset/css/style.css')}}">
    @yield('style')
</head>

<body>
    <!-- header -->
    @if (request()->is('/'))
    @include('layout.homeHeader')
    @else
    @include('layout.header')
    @endif

    @yield('content')

    <div class="bg-dark p-5 text-center text-dark">
        Develop By <a href="https://mmcoder.com" class="text-dark">MM-Coder</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    {{--session flashing--}}
    @if (session()->has('error'))
    <script>
        Toastify({
        text:"{{session('error')}}",
        position:'center'
    }).showToast();
    </script>
    @endif
    @if (session()->has('success'))
    <script>
        Toastify({
        text:"{{session('success')}}",
        position:'center'
    }).showToast();
    </script>

    @endif

    <script src="{{asset('web_asset/js/argon.min.js')}}"></script>
    <script>


        window.updateCart=cart=>{
            const cartCount=document.getElementById('cartCount');
            cartCount.innerText=cart;
        }


        window.auth=@json(auth()->user())

        const showToast=message=>{
            Toastify({
        text:message,
        position:'center'
    }).showToast();
        }
    </script>
    @yield('script')

</body>

</html>

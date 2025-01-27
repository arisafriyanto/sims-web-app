<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMS Web App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('styles')
</head>

<body>
    <div class="wrapper">
        @include('includes._sidebar')

        <div class="main">
            @include('includes._navbar')

            @include('includes._alert')

            <main class="content px-3 py-2">
                @yield('content')
            </main>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://kit.fontawesome.com/a0e02f3834.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.classList.add('fade');
                    alert.classList.remove('show');
                });
            }, 3000);
        });
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('scripts')
</body>

</html>

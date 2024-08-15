<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="assets/favicon.ico" rel="icon" type="image/x-icon" />
    <title id="page-title">Login App</title>

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>

<body>
    <header class="header-bar">
        <div class="d-flex justify-content-between align-items-center">
            <img id="header-logo" src="assets/MD-logo-sm.jpg" alt="md-logo" />
            <h1 class="text-center p-3" id="header-h1">
                @isset($pageTitle)
                    {{ $pageTitle }}
                @else
                    Authentication
                @endisset
            </h1>

            <div style="width: 80px;" class="m-4 p-0">
                @if (auth()->user())
                    <a href="/logout" id="logout-btn" class="btn">
                        Logout
                    </a>
                @endif
            </div>
        </div>
    </header>

    @if (session()->has('success'))
        <div class="container mt-3 container--narrow">
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        </div>
    @elseif (session()->has('failure'))
        <div class="container mt-3 container--narrow">
            <div class="alert alert-danger text-center">
                {{ session('failure') }}
            </div>
        </div>
    @endif

    {{ $slot }}

    <footer>
        <div class="d-flex py-3 justify-content-center align-items-center" id="footer">
            <div class="mx-1">
                <p class="m-0"><strong>Engineered with Love</strong></p>
            </div>

            <div class="mx-1">
                <a href="https://www.mariannedillard.com" target="__blank">
                    <img src="assets/heart-icon.png" alt="red-heart-icon" style="width: 25px" id="heart-icon" />
                </a>
            </div>

            <div class="mx-1">
                <a href="https://www.github.com/dillardm89" target="__blank">
                    <img src="assets/github-icon.png" alt="github-icon" style="width: 25px" id="github-icon" />
                </a>
            </div>
        </div>
    </footer>

    <script>
        const currentRoute = "{{ Route::currentRouteName() }}";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>

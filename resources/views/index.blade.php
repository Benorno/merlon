<!doctype html>
<html lang="@yield('lang')" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <!-- site made by - imbenas.site -->
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300;700&family=Noto+Color+Emoji&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="{{ asset('storage/css/app.css') }}" rel="stylesheet">
    <title>@yield('siteTitle')</title>
</head>

<body>
    <div id="page-loader">
        <div class="loader"></div>
    </div>
    @yield('content')
</body>
<script>
    document.onreadystatechange = function() {
        if (document.readyState === "complete") {
            // Page has loaded, hide the loader
            document.getElementById("page-loader").style.display = "none";
        }
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
</html>

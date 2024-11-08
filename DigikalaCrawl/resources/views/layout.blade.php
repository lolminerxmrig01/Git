<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Sticky Footer Navbar Template · Bootstrap v5.0</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet"
          type="text/css"/>

    <link rel="stylesheet" type="text/css" href="{{ url('/css/styles.css') }}"/>

    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">


    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100" data-new-gr-c-s-check-loaded="14.1045.0" data-gr-ext-installed="" style="">

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand d-flex" href="#">
                <img src="https://www.digikala.com/static/files/bc60cf05.svg" class="center-block"></a>
        </div>
    </nav>
</header>

@yield('content')


<footer class="footer mt-auto py-3 bg-dark">
    <div class="container">
        <span class="text-muted">Copyright &copy; Digikala 2022</span>
    </div>
</footer>


<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


</body>
<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <meta name    = "viewport" content                                                                           = "width=device-width, initial-scale=1.0">
    @stack('before-style')
    <link href = "{{asset('')}}frontend/output.css" rel                                                       = "stylesheet">
    <link href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel = "stylesheet" />
    <!-- CSS -->
    <link rel = "stylesheet" href = "https://unpkg.com/flickity@2/dist/flickity.min.css">
    @stack('after-style')
    <title>@yield('title')</title>
</head>
<body class = "font-poppins text-[#070625]">

    @yield('content')
    @stack('before-script')

    @stack('after-script')
</body>
</html>

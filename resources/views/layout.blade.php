<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <h1>Könyvtári kezelő felület</h1>
        </div>
    </header>
    
    <nav>
        <div class="container">
            <ul>
                <li><a href="#">Kezdőoldal</a></li>
                <li><a href="books">Könyvek listázása</a></li>
                <li><a href="members">Könyvtári tagok listázása</a></li>
                <li><a href="loans">Kölcsönzések</a></li>
                <li><a href="book">Könyvek</a></li>
                <li><a href="author">Szerzők</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Library Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

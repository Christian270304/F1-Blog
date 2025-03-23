<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f8f9fa;
            color: #333;
        }
        h1 {
            font-size: 100px;
            color: #FF1E1E;
            margin-bottom: 20px;
        }
        p {
            font-size: 20px;
            margin-bottom: 30px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
            font-size: 18px;
            border: 1px solid #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        a:hover {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body>
    <h1>403</h1>
    <p>No tienes permiso para acceder a esta página.</p>
    <a href="{{ route('myArticles') }}">Volver a mis artículos</a>
</body>
</html>
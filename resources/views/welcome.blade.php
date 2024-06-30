<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            animation: slideIn 1s ease-out;
            transform-style: preserve-3d; /* Ensures 3D transformations */
            perspective: 1000px; /* Depth of the 3D perspective */
        }
        @keyframes slideIn {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .details {
            margin-top: 20px;
            transform: translateZ(30px); /* Move details section forward */
        }
        .details p {
            margin-bottom: 10px;
            font-weight: bold;
            text-indent: 10px; /* Adds indentation to the text */
        }
        .details a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Welcome !!</h1>
        <div class="text-center mb-3">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        </div>
        <div class="details">
            <p>Group Name - Banao - PHP Laravel(1) - 20/06</p>
            <p>Date - 30/june/2024</p>
            <p>Task 2</p>
            <p>By Mohit Arora</p>
        </div>
    </div>
</body>
</html>

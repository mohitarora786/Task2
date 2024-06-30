<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6; /* light gray */
            color: #1a202c; /* dark gray */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #ffffff; /* white */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px; /* Increased width for better display */
            width: 100%;
        }
        .container h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .container p {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .container form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .container form button {
            padding: 0.75rem 1rem;
            background-color: #f3f4f6; /* light gray */
            color: #4b5563; /* gray */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .container form button:hover {
            background-color: #e2e8f0; /* darker gray */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Dashboard</h1>
        <h2>Hello, {{ Auth::user()->name }}</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>

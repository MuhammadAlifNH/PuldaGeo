@php
use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PuldaGeo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .header .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .header .user-info button {
            background: none;
            border: 2px solid white;
            color: white;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .header .user-info button:hover {
            background-color: white;
            color: #4CAF50;
        }
        .content {
            padding: 20px;
        }
        .dashboard-btn {
            text-decoration: none;
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }
        .dashboard-btn:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">PuldaGeo</div>
        <div class="user-info">
            <span>Hi, {{ Auth::user()->username }}</span>
            <form action="{{ route('auth.logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>
    <div class="content">
        @yield('content')
        @yield('scripts')
    </div>
</body>
</html>

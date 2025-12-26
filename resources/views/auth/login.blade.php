{{-- File: resources/views/auth/login.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <title>Login - RS HEWAN</title>
    {{-- Kita bisa pakai style.css yang sama dari home --}}
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        /* Style sederhana untuk login form */
        .login-container {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #f9f9f9;
        }
        .login-container h2 {
            text-align: center;
        }
        .login-container div {
            margin-bottom: 15px;
        }
        .login-container label {
            display: block;
            margin-bottom: 5px;
        }
        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .error-message {
            color: red;
            background: #ffebee;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>LOGIN</h2>

        {{-- Menampilkan pesan error jika login gagal --}}
        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form ini akan dikirim ke rute 'login.post' yang akan kita buat --}}
        <form action="{{ route('login.post') }}" method="POST">
            @csrf  {{-- Token keamanan wajib Laravel --}}
            
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
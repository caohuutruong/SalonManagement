<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Management - Login & Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            transition: all 0.3s ease; /* Thêm transition cho container */
        }
        h1 {
            font-size: 2.5rem;
            color: #4a5568;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 30px;
            display: none; /* Ẩn tất cả các form ban đầu */
        }
        form.active {
            display: block; /* Hiện form đang hoạt động */
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4a5568;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2d3748;
        }
        .toggle-link {
            cursor: pointer;
            color: #4a5568;
            text-decoration: underline;
        }
        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Salon Management</h1>

        <!-- Form Đăng Nhập -->
       <form id="loginForm" class="active" action="{{ route('login') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        @error('error')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Login</button>
         </form> 

        <!-- Form Đăng Ký -->
        <form id="registerForm" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="phone" placeholder="Phone number">
            <input type="file" name="avatar">
            <button type="submit">Register</button>
        </form>

        <div class="toggle-link" onclick="toggleForms()">Don't have an account? Register</div>
        <div class="toggle-link" onclick="toggleForms()" style="display: none;">Already have an account? Login</div>
    </div>

    <script>
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const toggleLinks = document.querySelectorAll('.toggle-link');

            if (loginForm.classList.contains('active')) {
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
                toggleLinks[0].style.display = 'none'; // Ẩn link đăng ký
                toggleLinks[1].style.display = 'block'; // Hiện link đăng nhập
            } else {
                registerForm.classList.remove('active');
                loginForm.classList.add('active');
                toggleLinks[0].style.display = 'block'; // Hiện link đăng ký
                toggleLinks[1].style.display = 'none'; // Ẩn link đăng nhập
            }
        }
    </script>
</body>
</html>

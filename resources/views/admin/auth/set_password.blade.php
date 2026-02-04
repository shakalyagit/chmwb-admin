<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set New Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 60px auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .logo {
            display: block;
            margin: 0 auto 30px auto;
            max-width: 150px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #aaa;
        }
        .text-danger{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="http://127.0.0.1:8000/assets/img/icons/spot-illustrations/logo.jpg" alt="Company Logo" class="logo">
        <h2>Set New Password</h2>
        <form action="{{ route('set_password_action') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <label>New Password</label>
            <input type="password" id="password" name="password" required>
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <label>Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <button type="submit">Submit</button>
        </form>
        <div class="footer">
            &copy; <?php echo date('Y'); ?> Graphite India Limited
        </div>
    </div>
</body>

</html>
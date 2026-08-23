<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "secured");

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = "Please enter username and password.";
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM reg WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: landing.php");
                exit();
            } else {
                $error = "Invalid Username or Password.";
            }
        } else {
            $error = "Invalid Username or Password.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #7e22ce;
            color: white;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            width: min(100%, 420px);
            background-color: #a855f7;
            padding: 30px 35px;
            border: 2px solid #d8b4fe;
            border-radius: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        h1 {
            margin: 0 0 25px;
            color: white;
            text-align: center;
            font-size: 28px;
        }

        form {
            text-align: left;
        }

        .form-container label {
            display: block;
            color: white;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-container input {
            width: 100%;
            height: 40px;
            padding: 0 13px;
            margin: 0 0 18px;
            border: 1px solid #e9d5ff;
            border-radius: 20px;
            background-color: white;
            color: black;
            font: inherit;
            outline: none;
        }

        .form-container input:focus {
            border: 2px solid #581c87;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
        }

        .button {
            width: 100%;
            padding: 12px 25px;
            margin-top: 5px;
            border: none;
            background-color: #581c87;
            color: white;
            border-radius: 20px;
            font: inherit;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .button:hover {
            background-color: #3b0764;
            transform: translateY(-1px);
        }

        .form-container p {
            margin: 18px 0 0;
            color: white;
            text-align: center;
            font-size: 14px;
        }

        .form-container a {
            color: #3b0764;
            font-weight: bold;
            text-decoration: none;
        }

        .form-container a:hover {
            text-decoration: underline;
        }

        .error {
            background-color: #581c87;
            color: white;
            padding: 10px;
            margin-bottom: 18px;
            border-radius: 15px;
            text-align: center;
            font-size: 14px;
        }

        @media (max-width: 420px) {
            body {
                padding: 12px;
            }

            .form-container {
                padding: 25px 20px;
                border-radius: 25px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="form-container">

    <h1>Login</h1>

    <?php if (!empty($error)): ?>
        <div class="error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="login.php" method="post">

        <label for="username">Username:</label>
        <input
            type="text"
            name="username"
            id="username"
            required
        >

        <label for="password">Password:</label>
        <input
            type="password"
            name="password"
            id="password"
            required
        >

        <button class="button" type="submit">
            Login
        </button>

        <p>
            Don't have an account?
            <a href="index.html">Register here</a>
        </p>

    </form>

</div>

</body>
</html>
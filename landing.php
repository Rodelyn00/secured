<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to My Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        .welcome-container {
            width: min(100%, 500px);
            padding: 40px 35px;
            background-color: #a855f7;
            border: 2px solid #d8b4fe;
            border-radius: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            margin: 0 0 20px;
            color: white;
            font-size: 30px;
        }

        h2 {
            margin: 0 0 15px;
            color: white;
            font-size: 22px;
        }

        p {
            margin: 8px 0;
            color: white;
            font-size: 17px;
            line-height: 1.6;
        }

        .logout-button {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 30px;
            border-radius: 20px;
            background-color: #581c87;
            color: white;
            font-weight: bold;
            text-decoration: none;
            transition: 0.2s;
        }

        .logout-button:hover {
            background-color: #3b0764;
            transform: translateY(-1px);
        }

        @media (max-width: 420px) {
            body {
                padding: 12px;
            }

            .welcome-container {
                padding: 30px 20px;
                border-radius: 25px;
            }

            h1 {
                font-size: 25px;
            }

            h2 {
                font-size: 20px;
            }

            p {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="welcome-container">

        <h1>Welcome to my website</h1>

        <h2>My name is Rodelyn D. Lebanan</h2>

        <p>
            3rd Year BSIT Student
        </p>

        <p>
            Western Institute of Technology
        </p>

        <a class="logout-button" href="logout.php">Logout</a>

    </div>

</body>
</html>
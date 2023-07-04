<?php

session_start();

require_once '../config/database.php';
require_once '../helpers/utils.php';


if (isset($_SESSION['user_id']) && isset($_SESSION['is_admin'])) {
    header("Location: /admin/dashboard.php");
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user from the database
    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            mysqli_close($conn);

            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_username'] = $row['username'];
            $_SESSION['is_admin'] = 'true';
            header("Location: /admin/dashboard.php");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Snippet - GoSNippets</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap");

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #eee;
            height: 100vh;
            font-family: "Poppins", sans-serif;
            background: linear-gradient(to top,
                    #fff 10%,
                    rgba(93, 42, 141, 0.4) 90%) no-repeat;
        }

        .wrapper {
            max-width: 500px;
            border-radius: 10px;
            margin: 50px auto;
            padding: 30px 40px;
            box-shadow: 20px 20px 80px rgb(206, 206, 206);
        }

        .h2 {
            font-family: "Kaushan Script", cursive;
            font-size: 3.5rem;
            font-weight: bold;
            color: #400485;
            font-style: italic;
        }

        .h4 {
            font-family: "Poppins", sans-serif;
        }

        .input-field {
            border-radius: 5px;
            padding: 5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 1px solid #400485;
            color: #400485;
        }

        .input-field:hover {
            color: #7b4ca0;
            border: 1px solid #7b4ca0;
        }

        input {
            border: none;
            outline: none;
            box-shadow: none;
            width: 100%;
            padding: 0px 2px;
            font-family: "Poppins", sans-serif;
        }

        .fa-eye-slash.btn {
            border: none;
            outline: none;
            box-shadow: none;
        }

        a {
            text-decoration: none;
            color: #400485;
            font-weight: 700;
        }

        a:hover {
            text-decoration: none;
            color: #7b4ca0;
        }

        .option {
            position: relative;
            padding-left: 30px;
            cursor: pointer;
        }

        .option label.text-muted {
            display: block;
            cursor: pointer;
        }

        .option input {
            display: none;
        }

        .checkmark {
            position: absolute;
            top: 3px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 50%;
            cursor: pointer;
        }

        .option input:checked~.checkmark:after {
            display: block;
        }

        .option .checkmark:after {
            content: "";
            width: 13px;
            height: 13px;
            display: block;
            background: #400485;
            position: absolute;
            top: 48%;
            left: 53%;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 300ms ease-in-out 0s;
        }

        .option input[type="radio"]:checked~.checkmark {
            background: #fff;
            transition: 300ms ease-in-out 0s;
            border: 1px solid #400485;
        }

        .option input[type="radio"]:checked~.checkmark:after {
            transform: translate(-50%, -50%) scale(1);
        }

        .btn.btn-block {
            border-radius: 20px;
            background-color: #400485;
            color: #fff;
        }

        .btn.btn-block:hover {
            background-color: #55268be0;
        }

        @media (max-width: 575px) {
            .wrapper {
                margin: 10px;
            }
        }

        @media (max-width: 424px) {
            .wrapper {
                padding: 30px 10px;
                margin: 5px;
            }

            .option {
                position: relative;
                padding-left: 22px;
            }

            .option label.text-muted {
                font-size: 0.95rem;
            }

            .checkmark {
                position: absolute;
                top: 2px;
            }

            .option .checkmark:after {
                top: 50%;
            }

            #forgot {
                font-size: 0.95rem;
            }
        }
    </style>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
</head>

<body oncontextmenu="return false" class="snippet-body">
    <div class="wrapper bg-white">
        <div class="h2 text-center">Warung Hunter</div>
        <div class="h4 text-muted text-center pt-2">Admin Site</div>
        <form class="pt-3" method="POST" action="login.php">
            <div class="form-group py-2">
                <div class="input-field">
                    <span class="far fa-user p-2"></span>
                    <input type="text" name="username" placeholder="Enter your Username" required class="" />
                </div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field">
                    <span class="fas fa-lock p-2"></span>
                    <input type="text" name="password" placeholder="Enter your Password" required class="" />
                    <button class="btn bg-white text-muted">
                        <span class="far fa-eye-slash"></span>
                    </button>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="remember">
                    <label class="option text-muted">
                        Remember me <input type="radio" name="radio" />
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <button class="btn btn-block text-center my-3">Log in</button>
        </form>
    </div>
    <script type="text/javascript"></script>
</body>

</html>
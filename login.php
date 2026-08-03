<?php

session_start();

include "config.php";


$message = "";


if(isset($_POST['login'])){


    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    if(empty($username) || empty($password)){

        $message = "Completați toate câmpurile!";

    }
    else{


        $stmt = $conn->prepare(
            "SELECT * FROM users WHERE username=?"
        );


        $stmt->bind_param(
            "s",
            $username
        );


        $stmt->execute();


        $result = $stmt->get_result();


        if($result->num_rows == 1){


            $user = $result->fetch_assoc();


            if(password_verify($password, $user['password'])){


                $_SESSION['user'] = $user['username'];


                header("Location: dashboard.php");

                exit();


            }
            else{

                $message = "Parolă greșită!";

            }


        }
        else{

            $message = "Utilizator inexistent!";

        }


        $stmt->close();

    }

}

?>


<!DOCTYPE html>

<html lang="ro">

<head>

<meta charset="UTF-8">

<title>Login Administrator</title>

<link rel="stylesheet" href="style.css">

</head>


<body>


<h2>Autentificare Administrator</h2>


<p>
<?php echo $message; ?>
</p>


<form method="POST">


<label>Username:</label>

<input 
type="text" 
name="username"
placeholder="Username">


<label>Parola:</label>

<input 
type="password"
name="password"
placeholder="Parola">


<button type="submit" name="login">
Login
</button>


</form>


<br>


<a href="index.php">
Înapoi la înscriere
</a>


</body>

</html>
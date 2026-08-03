<?php

include "config.php";

$message = "";


if(isset($_POST['submit'])){


    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);


    if(empty($first_name) || empty($last_name) || empty($email)){

        $message = "Toate câmpurile sunt obligatorii!";

    }

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $message = "Adresa de email nu este validă!";

    }

    else{


        $stmt = $conn->prepare(
            "INSERT INTO participants(first_name,last_name,email) VALUES(?,?,?)"
        );


        $stmt->bind_param(
            "sss",
            $first_name,
            $last_name,
            $email
        );


        if($stmt->execute()){

            $message = "Înscriere realizată cu succes!";

        }
        else{

            $message = "A apărut o eroare!";

        }


        $stmt->close();

    }

}

?>


<!DOCTYPE html>
<html lang="ro">

<head>

<meta charset="UTF-8">

<title>Înscriere eveniment</title>

<link rel="stylesheet" href="style.css">

</head>


<body>


<h2>Înscriere la eveniment</h2>


<p>
<?php echo $message; ?>
</p>


<form method="POST">


<label>Nume:</label>

<input 
type="text" 
name="first_name"
placeholder="Introduceți numele">


<label>Prenume:</label>

<input 
type="text" 
name="last_name"
placeholder="Introduceți prenumele">


<label>Email:</label>

<input 
type="email" 
name="email"
placeholder="Introduceți emailul">


<button type="submit" name="submit">
Înscriere
</button>


</form>


<br>


<a href="login.php">
Login administrator
</a>


</body>

</html>
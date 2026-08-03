<?php

include "auth.php";
include "config.php";


if(!isset($_GET['id'])){

    header("Location: dashboard.php");

    exit();

}


$id = $_GET['id'];



// Luăm datele persoanei

$stmt = $conn->prepare(
    "SELECT * FROM participants WHERE id=?"
);


$stmt->bind_param(
    "i",
    $id
);


$stmt->execute();


$result = $stmt->get_result();


$participant = $result->fetch_assoc();



if(!$participant){

    echo "Persoana nu există!";

    exit();

}




// Salvăm modificările

if(isset($_POST['save'])){


    $first_name = trim($_POST['first_name']);

    $last_name = trim($_POST['last_name']);

    $email = trim($_POST['email']);



    if(empty($first_name) || empty($last_name) || empty($email)){


        echo "Toate câmpurile sunt obligatorii!";


    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){


        echo "Email invalid!";


    }
    else{


        $update = $conn->prepare(
            "UPDATE participants 
             SET first_name=?, last_name=?, email=? 
             WHERE id=?"
        );



        $update->bind_param(
            "sssi",
            $first_name,
            $last_name,
            $email,
            $id
        );



        $update->execute();



        header("Location: dashboard.php");

        exit();


    }


}


?>


<!DOCTYPE html>

<html lang="ro">

<head>

<meta charset="UTF-8">

<title>Editare participant</title>

<link rel="stylesheet" href="style.css">

</head>


<body>


<h2>Editare participant</h2>



<form method="POST">


<label>Nume:</label>

<input 
type="text" 
name="first_name"
value="<?php echo $participant['first_name']; ?>">



<label>Prenume:</label>

<input 
type="text" 
name="last_name"
value="<?php echo $participant['last_name']; ?>">



<label>Email:</label>

<input 
type="email"
name="email"
value="<?php echo $participant['email']; ?>">



<button type="submit" name="save">

Salvează modificările

</button>



</form>



<br>


<a href="dashboard.php">

Înapoi la listă

</a>



</body>

</html>
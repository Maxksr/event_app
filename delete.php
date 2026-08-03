<?php

include "auth.php";
include "config.php";


if(isset($_GET['id'])){


    $id = $_GET['id'];



    $stmt = $conn->prepare(
        "DELETE FROM participants WHERE id=?"
    );


    $stmt->bind_param(
        "i",
        $id
    );


    $stmt->execute();


    $stmt->close();


}


header("Location: dashboard.php");

exit();

?>
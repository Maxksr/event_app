<?php

include "auth.php";
include "config.php";


$result = $conn->query(
    "SELECT * FROM participants"
);

?>


<!DOCTYPE html>

<html lang="ro">

<head>

<meta charset="UTF-8">

<title>Lista participanților</title>

<link rel="stylesheet" href="style.css">

</head>


<body>


<h2>Lista participanților la eveniment</h2>


<p>
Bine ai venit, 
<?php echo $_SESSION['user']; ?>
</p>


<a href="logout.php">
Logout
</a>


<br><br>


<table>


<tr>

<th>Nume</th>

<th>Prenume</th>

<th>Email</th>

<th>Acțiuni</th>

</tr>



<?php while($row = $result->fetch_assoc()){ ?>


<tr>


<td>
<?php echo $row['first_name']; ?>
</td>


<td>
<?php echo $row['last_name']; ?>
</td>


<td>
<?php echo $row['email']; ?>
</td>


<td>


<a href="edit.php?id=<?php echo $row['id']; ?>">
Editează
</a>


<a 
href="delete.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Sigur dorești ștergerea?');">

Șterge

</a>


</td>


</tr>


<?php } ?>


</table>


</body>

</html>
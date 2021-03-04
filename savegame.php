<?php
include "db.php";


if(isset($_POST)):

    /*
    $sql = "INSERT INTO game (player1, player2) VALUES ('".$_POST['p1']."', '".$_POST['p2']."')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    */
    try {
        
        $sql = "INSERT INTO game (player1, player2)
        VALUES ('".$_POST['p1']."', '".$_POST['p2']."')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
else:

endif;
?>
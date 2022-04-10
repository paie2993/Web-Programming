<?php
    $server = $_SERVER['SERVER_NAME'];
    $user = "root";
    $pass = "";

    $connection = mysqli_connect($server, $user, $pass);
    if (!$connection) {
        die("Could not connect to server " . $server . ", " . mysqli_error());
    }

    mysqli_select_db($connection, "WP7");

    $id = trim($_POST['id']);
    if (strlen($id) == 0) {
        echo "<p>ID not accepted</p>";
    } else {

        $id = intval($id);
        $query = "DELETE FROM Recipes WHERE ID = $id";

        $result = NULL;
        try {
            $result = mysqli_query($connection, $query);
        } catch (Exception) {
            echo "<p>Could not delete Recipe with id = $id</p>";
        }

        if ($result) {
            echo "<p>Successfully deleted Recipe with id = $id</p>";
        } else {
            echo "<p>Could not delete Recipe with id = $id</p>";
        }

    }

    mysqli_close($connection);
?>
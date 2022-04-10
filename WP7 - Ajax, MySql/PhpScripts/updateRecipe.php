<?php

    require "utilityFunctions.php";

    $server = $_SERVER['SERVER_NAME'];
    $user = "root";
    $pass = "";

    $connection = mysqli_connect($server, $user, $pass);
    if (!$connection) {
        die("Could not connect to server " . $server . ", " . mysqli_error());
    }

    mysqli_select_db($connection, "WP7");

    // input validation ...
    $id = trim($_POST['id']);
    $author = trim($_POST['author']);
    $name = trim($_POST['name']);
    $type = trim($_POST['type']);
    $description = trim($_POST['description']);
    
    $arr = array('id'=>$id, 'author'=>$author, 'name'=>$name, 'type'=>$type, 'description'=>$description);
    foreach ($arr as $key=>$value) {
        if (isEmpty($value)) {
            echo "<p>Invalid value <b>$value</b> for field <b>$key</b></p>";
            mysqli_close($connection);
            return;
        }
    }
    $id = intval($id);
    // .. ends here

    // database querying ...
    $query = "UPDATE Recipes SET ID=$id, Author=\"$author\", Name=\"$name\", Type=\"$type\", Description=\"$description\"  WHERE ID = $id";

    $result = NULL;
    try {
        $result = mysqli_query($connection, $query);
    } catch (Exception) {
        echo "<p>Could not update Recipe with id = $id</p>";
    }

    if ($result) {
        echo "<p>Successfully updated Recipe with id = $id</p>";
    } else {
        echo "<p>Could not update Recipe with id = $id</p>";
    }
    // ... ends here

    mysqli_close($connection);
?>
<?php

    require "utilityFunctions.php";

    $server = $_SERVER['SERVER_NAME'];
    $user = "root";
    $pass = "";

    $connection = mysqli_connect($server, $user, $pass);
    if (!$connection) {
        die("Could not connect to Database server " . $server . ", " . mysqli_error());
    }

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

    mysqli_select_db($connection, "WP7");

    $query = "INSERT INTO Recipes VALUES ($id, \"$author\", \"$name\", \"$type\", \"$description\")";
    $result = NULL;
    
    try {
        $result = mysqli_query($connection, $query);
    } catch (Exception) {
        echo "<p>Could not add the given Recipe.</p>";
    }

    if ($result == 1) {

        echo "<p>Success! The given recipe has been added to the cookbook:</p>";
        echo "<div style=\"width:50%;height:auto;border:solid red 1px;padding:20px;\">";
        echo "<p><b>id:</b> $id</p>";
        echo "<p><b>author:</b> $author</p>";
        echo "<p><b>name:</b> $name</p>";
        echo "<p><b>type:</b> $type</p>";
        echo "<p><b>description:</b> $description</p>";
        echo "</div>";
    }
    
    mysqli_close($connection);
?>
<?php
    $server = $_SERVER['SERVER_NAME'];
    $user = "root";
    $pass = "";
    $connection = mysqli_connect($server, $user, $pass);
    if (!$connection) {
        die("Could not connect to server " . $server . ", " . mysqli_error());
    }

    
    $id = $_GET['column'];
    // input validation with RegEx
    $pattern = "/^[1-9]{1}[0-9]{0,4}$/i";
    if (!preg_match($pattern, $id)) {
        echo "Cannot accept given id: " . $id;
    } else {

        $id = intval($id);
        
        mysqli_select_db($connection, "WP7");
        $result = mysqli_query($connection, "SELECT * FROM Recipes WHERE ID = $id");


        echo <<<DELIM
        <table border=1>
        <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Name</th>
        <th>Type</th>
        <th>Description</th>
        </tr>
        DELIM;
        while ($row = mysqli_fetch_array($result)) {
            echo <<<DELIM
            <tr>
            <td>$row[ID]</td>
            <td>$row[Author]</td>
            <td>$row[Name]</td>
            <td>$row[Type]</td>
            <td>$row[Description]</td>
            </tr>
            DELIM;
        }
        echo "</table>";
        
    }

    mysqli_close($connection);
?>
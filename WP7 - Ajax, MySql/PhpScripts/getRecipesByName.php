<?php
    $server = $_SERVER['SERVER_NAME'];
    $user = "root";
    $pass = "";
    $connection = mysqli_connect($server, $user, $pass);
    if (!$connection) {
        die("Could not connect to server " . $server . ", " . mysqli_error());
    }

    
    $name = $_GET['column'];
    $name = trim($name);

    // input validation with RegEx
    $pattern = "/^[a-z]{1}[ a-z\-&]{0,49}$/i";
    if (!preg_match($pattern, $name)) {
        echo "Cannot accept given name: " . $name;
    } else { 

        mysqli_select_db($connection, "WP7");
        $result = mysqli_query($connection, "SELECT * FROM Recipes WHERE Name = \"$name\"");


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
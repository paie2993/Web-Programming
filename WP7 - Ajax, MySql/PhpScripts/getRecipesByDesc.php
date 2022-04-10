<?php
    $server = $_SERVER['SERVER_NAME'];
    $user = "root";
    $pass = "";
    $connection = mysqli_connect($server, $user, $pass);
    if (!$connection) {
        die("Could not connect to server " . $server . ", " . mysqli_error());
    }
    
    echo "Hello wold!";

    $description = $_POST['column'];
    $description = trim($description);

    if (strlen($description) > 255 or strlen($description) == 0) {
        echo "Cannot accept the given description (too many or no characters)";
    } else { 

        mysqli_select_db($connection, "WP7");
        $result = mysqli_query($connection, "SELECT * FROM Recipes WHERE Description LIKE %$description%");

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
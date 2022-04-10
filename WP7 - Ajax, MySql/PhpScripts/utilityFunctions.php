<?php

function isEmpty($column) : bool {
    if (strlen($column) == 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

?>


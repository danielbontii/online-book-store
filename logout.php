<?php

session_start();

if (isset($_GET)) {

    session_destroy();
    header('location: index.php?type=success&message=logout successful');

}

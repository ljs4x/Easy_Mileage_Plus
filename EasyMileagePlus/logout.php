<?php
// cookie is destroyed when logged out and will be rerouted back to index.php
    setcookie("loggedInUser", "", time() - (720), "/");
    header("Location: index.php");
?>

<?php
/* This is a PHP code that is destroying the current session and redirecting the user to the index.php
page. The `session_start()` function starts a new or resumes an existing session,
`session_destroy()` function destroys all data registered to a session, `header()` function sends a
raw HTTP header to redirect the user to the index.php page, and `exit` function terminates the
current script. */
session_start();
session_destroy();
header("location:../index.php");
exit;
?>

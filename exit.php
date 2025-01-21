<?php
setcookie('id', '', time() - 1);
setcookie('token', '', time() - 1);

header('Location: index.php');
exit();
?>
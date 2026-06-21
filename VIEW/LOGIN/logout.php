<?php
session_start();
session_destroy();
header("Location: inserir_login.php");
exit();
<?php
session_start();
session_destroy();
header("Location: /PBL-Lab-BA/public/login.php");
exit;
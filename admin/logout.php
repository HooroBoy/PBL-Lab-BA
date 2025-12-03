<?php
session_start();
session_destroy();
header("Location: /project-azenk/public/login.php");
exit;
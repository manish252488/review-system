<?php session_start(); ?>
<?php session_unset();
session_destroy();
$script="<script>window.location='loginadmin.php';</script>";
echo $script;
?>
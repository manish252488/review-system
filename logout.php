<?php session_start(); ?>
<?php session_unset();
session_destroy();
$script="<script>window.location='login.php';</script>";
echo $script;
?>
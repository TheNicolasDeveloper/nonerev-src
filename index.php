<?php
$title = "Greetings - None";
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';

if (isset($_SESSION["user"])) {
    header("Location: /home");
    exit;
}
?>

<?php echo PageBuilder::buildHeader(); ?>

<div class="begin rounded shadow p-4">
    <img class="begin-none-logo" src="/img/nonelogo.png" alt="site logo" width="200">
    <h1>A revival that goes for the win.</h1>
    <a href="/signup" type="button" class="btn btn-success">Sign Up</a>
    <a href="/login" type="button" class="btn btn-success">Login</a>
</div>

<?php echo PageBuilder::buildFooter(); ?>
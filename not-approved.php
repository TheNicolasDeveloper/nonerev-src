<?php
$title = "Not Approved";
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';

$userclass = new User;

$accountAction = $userclass->getAccountAction($_SESSION["user"]["id"]);

$actionToType = [
    1 => "Warning",
    2 => "Ban for 1 Day",
    3 => "Ban for 3 Days",
    4 => "Ban for 7 Days",
    5 => "Ban for 14 Days",
    6 => "Account Deleted"
];

$type = $actionToType[$accountAction["action"]];

if (!isset($_SESSION["user"]) && !isset($_SESSION["user"][""])) {
    header("Location: /");
    exit;
}

if (isset($_GET["logout"])) { // since the user cannot access anything else than this page
    require_once "logout.php";
    exit;
}

$canReactivate = false;

$expires = $accountAction["expiresAt"];

if ($expires < time() && $accountAction["action"] != 6) {
    $canReactivate = true;
}

if (isset($_GET["reactivate"]) && $canReactivate) {
    $userclass->removeModeration($_SESSION["user"]["id"]);
    header("Location: /home");
    exit;
}

?>

<?php echo PageBuilder::buildHeader(); ?>

<div class="container col-md-6 mt-5 p-4 bg-white border border-white rounded">
    <h2><?= $type ?></h2>
    <p>
        Moderator: <?= htmlspecialchars($userclass::getUser($accountAction["moderatedBy"])["username"]) ?> <br>
        Moderator note: <?= $accountAction["reason"] ?> <br>
        <br>
        To appeal, please email <a href="info@r3x.ct8.pl">info@r3x.ct8.pl</a>. <br>
        For a quicker response, please contact us in the <a href="/discord">discord server</a>.
    </p>
    <div class="mt-3 text-center">
        <a href="?logout" class="btn btn-danger mt-2">Logout</a><br>
        <?php if ($accountAction["action"] !== 6) : ?>
            <a href="?reactivate" class="btn btn-primary mt-2 <?= $canReactivate ? "" : "disabled" ?>">Reactivate account</a>
        <?php endif; ?>
    </div>
</div>

<?php echo PageBuilder::buildFooter(); ?>
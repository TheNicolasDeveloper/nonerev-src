<?php
$title = "Home";
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';

if (!isset($_SESSION["user"])) {
    header("Location: /");
    exit;
}
$greetings = array(
    "English" => "Hello",
    "Spanish" => "Hola",
    "French" => "Bonjour",
    "German" => "Hallo",
    "Italian" => "Ciao",
    "CarHonkese" => "*honk*"
);

$randomLanguage = array_rand($greetings);
$randomGreeting = $greetings[$randomLanguage];
?>

<?php echo PageBuilder::buildHeader(); ?>

<div class="container mt-3">
    <div class="bg-white rounded p-3 d-flex align-items-center position-relative">
        <a class="position-absolute w-100 h-100 top-0 left-0" href="/user?id=<?php echo $_SESSION["user"]["id"]; ?>"></a>
        <img class="bg-body-tertiary rounded-circle object-fit-cover" src="/img/pending.png" alt="site logo" width="150" height="150">
        <h2 class="ms-3"><?php echo "$randomGreeting, " . htmlspecialchars($_SESSION["user"]["username"]) . "!"; ?></h2>
    </div>

    <div class="bg-white p-3 mt-5 rounded">
        <h2>My Friends</h2>
        <div id="friends-list">
            <h4>very sad, no fwiends.. :(</h4>
            <!-- Friends will  be showed here with a js -->
        </div>
    </div>

    <div class="bg-white p-3 mt-5 rounded">
        <h2>Recently Played</h2>
        <div>
            <div class="game-search-item p-3 m-0 position-relative" style="max-width: 180px;">
                <?php $game = array("id" => 0, "title" => "test"); ?>
                <div data-testid="game-tile">
                    <a class="game-card-link" href="/game?id=<?= $game["id"] ?>">
                        <span class="d-block thumbnail-2d-container game-card-thumb-container rounded" style="width: fit-content; height: fit-content;">
                            <img class="rounded" src="/img/pending.png" alt="<?= htmlspecialchars($game["title"]) ?>" width="150" height="150">
                        </span>
                        <div class="game-card-name game-name-title" title="<?= htmlspecialchars($game["title"]) ?>"><?= htmlspecialchars($game["title"]) ?></div>
                        <div class="game-card-info" data-testid="game-tile-stats">
                            <span class="info-label icon-votes-gray"></span>
                            <span class="info-label vote-percentage-label">90%</span>
                            <span class="info-label icon-playing-counts-gray"></span>
                            <span class="info-label playing-counts-label">10.9K</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'api/my/friends.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var friendsList = $('#friends-list');
                $.each(data, function(index, friend) {
                    var friendItem = '<div class="friend-item">' +
                        '<a href="/user?id=' + friend.id + '">' + friend.username + '</a>' +
                        '</div>';
                    friendsList.append(friendItem);
                });
            },
            error: function() {
                console.log('Error fetching friend data.');
            }
        });
    });
</script>
<?php echo PageBuilder::buildFooter(); ?>

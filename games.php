<?php
$title = "Games - None";
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';

$gameclass = new Game;

$limit = 20;

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$totalpages = ceil($gameclass::searchTotal("") / $limit);

$offset = ($page - 1) * $limit; // the kewl calculations

$games = $gameclass::search("", $limit, $offset); // see EVERY game (with pages, to not overload the server)
?>

<?php echo PageBuilder::buildHeader(); ?>

<div class="container">
    <h1>Games</h1>
    <div class="games-list d-flex flex-wrap gap-3 rounded">
        <?php foreach ($games as $game) : ?>
            <div class="game-search-item p-3 m-0 position-relative" style="max-width: 180px;">
                <div data-testid="game-tile">
                    <a class="game-card-link" href="/game?id=<?= $game["id"] ?>">
                        <span class="d-block thumbnail-2d-container game-card-thumb-container rounded" style="width: fit-content; height: fit-content;">
                            <img class="rounded bg-secondary" src="<?= $game["icon"] !== "" ? $game["icon"] : "/img/DefaultPlaceIcon.jpg" ?>" alt="<?= "TheGuyWhoIsIdiots Special Hostings!" ?>" width="150" height="150">
                        </span>
                        <div class="game-card-name game-name-title" title="TheGuyWhoIsIdiot's Special hostings!"
                        <div class="game-card-info" data-testid="game-tile-stats">>
                            <span class="info-label"><i class="bi bi-hand-thumbs-up"></i></span>
                            <span class="info-label">--%</span>
                            <span class="info-label"><i class="bi bi-person"></i></span>
                            <span class="info-label">--</span>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <nav aria-label="Page navigation" class="d-flex justify-content-center mt-3">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalpages; $i++) : ?>
                <li class="page-item <?= $i == $page ? "active" : "" ?>">
                    <a class="page-link" href="/search?q=<?= $query ?>&type=<?= $searchType ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php echo PageBuilder::buildFooter(); ?>
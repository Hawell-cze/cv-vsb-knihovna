<nav class="top-menu">
    <div>
        <a href="index.php">Knihovna</a>
        <a href="form.php">Vložit knihu</a>

    </div>
    <?php
    $location = basename($_SERVER['SCRIPT_NAME']);

    if ($location !== "form.php"):
    ?>
        <div class="search-bar">
            <form action="index.php" method="GET">
                <input type="text" id="menu-search" name="search" placeholder="Hledat dle jména, příjmení, ISBN nebo názvu...">
            </form>
        </div>
    <?php
    endif; ?>
</nav>
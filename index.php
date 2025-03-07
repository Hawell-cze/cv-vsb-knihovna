<?php
include_once "map.php";

$repo = new BookRepository();
if (isset($_GET["search"])) {
    $books = $repo->searchBooks($_GET["search"]);
} else {
    $books = $repo->getAllBooks();
}


?>


<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="theme/styles/style.css" />
    <title>Knihovna</title>

</head>

<body>
    <?php include_once "theme/menu.php" ?>
    <div class="container">
        <h1>Knihovna</h1>
        <div class="search-container">
            <form action="index.php" method="GET">
                <input type="text" id="search" name="search" placeholder="Vyhledej knihu podle jména, příjmení, ISBN nebo názvu...">
                <button type="submit">Vyhledat</button>

            </form>
            <?php if (isset($_GET["search"])) { ?>
                <form action="index.php" method="GET">
                    <button type="submit">Reset vyhledávání</button>

                </form>

            <?php  } ?>
        </div>
        <div class="card-grid">


            <?php
            foreach ($books as $book) :
            ?>
                <!-- Karta knihy <?php echo $book->id; ?> -->
                <div class="card">

                    <img src="<?php echo $book->preview; ?>" alt="Náhled knihy">

                    <div class="card-content">
                        <h2><?php echo $book->b_name; ?></h2>
                        <p><strong>Autor:</strong> <?php echo $book->a_name . " " . $book->a_surname; ?></p>
                        <p><strong>ISBN:</strong> <?php echo $book->isbn; ?></p>
                        <p><strong>Popis:</strong>
                            <?php
                            $desc_long = $book->desc;
                            $desc_length = 150;

                            // Získáme oříznutý text
                            $desc_short = mb_substr($desc_long, 0, $desc_length, 'UTF-8');

                            // Pokud byl text skutečně zkrácen, připojíme elipsu
                            if (mb_strlen($desc_long, 'UTF-8') > $desc_length) {
                                $desc_short .= '...';
                            }

                            echo $desc_short;



                            ?></p>
                    </div>
                    <div class="card-actions">
                        <a href="delete.php?id=<?php echo $book->id; ?>" class="btn-delete" onClick="return confirm('Opravdu chcete smazat?')">Smazat</a>
                        <a href="edit.php?id=<?php echo $book->id; ?>" class="btn-edit">Editovat</a>
                        <a href="?search=<?php echo $book->b_name; ?>" class="btn-show">Zobrazit knihu</a>
                    </div>
                    <div class="card-footer">ID: <?php echo $book->id; ?></div>

                </div>
            <?php endforeach; ?>



        </div>
    </div>
</body>

</html>
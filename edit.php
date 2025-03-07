<?php

include "map.php";

$showForm = $_GET["id"] > 0 ? true : false;

if ($showForm == true) {
    $repo = new BookRepository();
    $book = $repo->getBookById($_GET["id"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $isbn = $_POST["isbn"] ?? "";
    $a_name = $_POST["author_name"] ?? "";
    $a_surname = $_POST["author_surname"] ?? "";
    $b_name = $_POST["book_name"] ?? "";
    $desc = $_POST["description"] ?? "";
    $preview = $_POST["preview"] ?? "";

    $repo = new BookRepository();
    $book = new Book($isbn, $a_name, $a_surname, $b_name, $desc, $preview, $_GET["id"]);
    $repo->updateBook($book);
    header("Location: index.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="theme/styles/style.css" />
    <title>Vložit knihu</title>

</head>

<body>
    <?php include_once "theme/menu.php" ?>
    <div class="container">
        <h1>Upravit knihu</h1>
        <form action="edit.php?id=<?php echo $_GET["id"]; ?>" method="POST">
            <div class="form-group">
                <label for="book_name">Název knihy</label>
                <input type="text" id="book_name" name="book_name" value="<?php echo $book->b_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="author_name">Jméno autora</label>
                <input type="text" id="author_name" name="author_name" value="<?php echo $book->a_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="author_surname">Příjmení autora</label>
                <input type="text" id="author_surname" name="author_surname" value="<?php echo $book->a_surname; ?>" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" value="<?php echo $book->isbn; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Popis knihy</label>
                <textarea id="description" name="description" required><?php echo $book->desc; ?></textarea>
            </div>
            <div class="form-group">
                <label for="preview">Odkaz na obrázek (preview)</label>
                <input type="url" id="preview" name="preview" value="<?php echo $book->preview; ?>" required>
            </div>
            <button type="submit" class="btn-submit">Vložit knihu</button>
        </form>
    </div>
</body>

</html>
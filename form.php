<?php

include "map.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $isbn = $_POST["isbn"] ?? "";
    $a_name = $_POST["author_name"] ?? "";
    $a_surname = $_POST["author_surname"] ?? "";
    $b_name = $_POST["book_name"] ?? "";
    $desc = $_POST["description"] ?? "";
    $preview = $_POST["preview"] ?? "";

    $repo = new BookRepository();
    $book = new Book($isbn, $a_name, $a_surname, $b_name, $desc, $preview);
    $repo->createBook($book);
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
        <h1>Vložit knihu</h1>
        <form action="form.php" method="POST">
            <div class="form-group">
                <label for="book_name">Název knihy</label>
                <input type="text" id="book_name" name="book_name" required>
            </div>

            <div class="form-group">
                <label for="author_name">Jméno autora</label>
                <input type="text" id="author_name" name="author_name" required>
            </div>
            <div class="form-group">
                <label for="author_surname">Příjmení autora</label>
                <input type="text" id="author_surname" name="author_surname" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
            <div class="form-group">
                <label for="description">Popis knihy</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="preview">Odkaz na obrázek (preview)</label>
                <input type="url" id="preview" name="preview" required>
            </div>
            <button type="submit" class="btn-submit">Vložit knihu</button>
        </form>
    </div>
</body>

</html>
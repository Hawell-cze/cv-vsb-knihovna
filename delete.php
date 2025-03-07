<?php
include_once "map.php";

if (isset($_GET["id"])) {
    $repo = new BookRepository();
    $book = $repo->deleteBook($_GET["id"]);
}
header("Location: index.php");
exit();

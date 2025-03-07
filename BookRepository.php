<?php


class BookRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllBooks()
    {
        $stmt = $this->pdo->query("SELECT * FROM books");
        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row["isbn"], $row["author_name"], $row["author_surname"], $row["book_name"], $row["description"], $row["preview"], $row["id"]);
        }
        return $books;
    }

    public function createBook(Book $book)
    {
        $stmt = $this->pdo->prepare("INSERT INTO books (isbn, author_name, author_surname, book_name, description, preview) VALUES (?,?,?,?,?,?)");
        return $stmt->execute([$book->isbn, $book->a_name, $book->a_surname, $book->b_name, $book->desc, $book->preview]);
    }
    public function getBookById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id= ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Book($row["isbn"], $row["author_name"], $row["author_surname"], $row["book_name"], $row["description"], $row["preview"], $row["id"]) : null;
    }
    public function deleteBook($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id=?");
        return $stmt->execute([$id]);
    }
    public function updateBook(Book $book)
    {
        $stmt = $this->pdo->prepare("UPDATE books SET isbn=?, author_name =?, author_surname=?,book_name=?,description=?,preview=? WHERE id =?");
        return $stmt->execute([$book->isbn, $book->a_name,  $book->a_surname, $book->b_name, $book->desc, $book->preview, $book->id]);
    }
    public function searchBooks($search)
    {
        $search = trim($search);
        if (empty($search)) {
            return $this->getAllBooks();
        }

        $words = array_filter(explode(' ', $search));

        $columns = ['author_name', 'author_surname', 'book_name', 'isbn'];

        $whereConditions = [];
        $parameters = [];

        foreach ($words as $word) {
            $subConditions = [];
            foreach ($columns as $col) {
                $subConditions[] = "$col LIKE ?";
                $parameters[] = '%' . $word . '%';
            }

            $whereConditions[] = '(' . implode(' OR ', $subConditions) . ')';
        }

        $sql = "SELECT * FROM books WHERE " . implode(' AND ', $whereConditions);

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);

        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book(
                $row["isbn"],
                $row["author_name"],
                $row["author_surname"],
                $row["book_name"],
                $row["description"],
                $row["preview"],
                $row["id"]
            );
        }

        return $books;
    }
}

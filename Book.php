<?php

class Book
{
    public $id;
    public $isbn;
    public $a_name;
    public $a_surname;
    public $b_name;
    public $desc;
    public $preview;

    public function __construct($isbn, $a_name, $a_surname, $b_name, $desc, $preview, $id = -1)
    {
        $this->isbn = $isbn;
        $this->a_name = $a_name;
        $this->a_surname = $a_surname;
        $this->b_name = $b_name;
        $this->desc = $desc;
        $this->preview = $preview;
        $this->id = $id;
    }
}

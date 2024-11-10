<?php

class DB
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=work_of_traker', 'root', '1234');
    }
}

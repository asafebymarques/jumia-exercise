<?php

namespace Jumia\Database;

use PDO;

class SQLiteConnection
{
    /**
     * Hold database instance.
     *
     * @var pdo
     */
    private $pdo;

    public function connect()
    {
        try {
            $this->pdo = new PDO('sqlite:'.$_ENV['PATH_SQL_FILE'], '', '', [PDO::ATTR_PERSISTENT => true]);
            $this->pdo->sqliteCreateFunction('regexp_like', 'preg_match', 2);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return $this->pdo;
    }
}

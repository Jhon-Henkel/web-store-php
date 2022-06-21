<?php
namespace core\classes;

use PDO;

class Database
{
    private $connectDb;

    private function connectDb()
    {
        $this->connectDb = new PDO(
            'mysql:'
            . 'host=' . MYSQL_SERVER . ';'
            . 'dbname=' . MYSQL_DATABASE . ';'
            . 'charset=' . MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        //debug
        $this->connectDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    private function disconnectDb()
    {
        $this->connectDb = null;
    }

    public function select($sql, $params = null)
    {
        $this->connectDb();

        $results = null;
        try {

            $pdo = $this->connectDb->prepare($sql);

            if (!empty($params)) {
                $pdo->execute($params);
            }else {
                $pdo->execute();
            }

            $results = $pdo->fetchall(PDO::FETCH_CLASS);

        }catch (\PDOException $exception) {
            return false;
        }

        $this->disconnectDb();
        return $results;
    }
}
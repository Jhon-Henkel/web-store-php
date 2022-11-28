<?php

namespace Unit\classes;

use core\classes\Database;
use PHPUnit\Framework\TestCase;

class TestDatabase extends TestCase
{
    public function testSelectMethodWithWrongSqlType()
    {
        $database = new Database();
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Base de dados não é do tipo SELECT');
        $database->select('UPDATE tabela SET campo = 1 WHERE campo = 2');
    }

    public function testInsertMethodWithWrongSqlType()
    {
        $database = new Database();
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Base de dados não é do tipo INSERT');
        $database->insert('UPDATE tabela SET campo = 1 WHERE campo = 2');
    }

    public function testUpdateMethodWithWrongSqlType()
    {
        $database = new Database();
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Base de dados não é do tipo UPDATE');
        $database->update('SELECT * FROM tabela');
    }

    public function testDeleteMethodWithWrongSqlType()
    {
        $database = new Database();
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Base de dados não é do tipo DELETE');
        $database->delete('SELECT * FROM tabela');
    }
}
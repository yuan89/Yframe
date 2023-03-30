<?php

namespace Yframe\Core\Database;

use PDO;

abstract class BaseModel
{
    protected $table;
    protected $primaryKey = 'id';
    protected $pdo;
    protected $connection;

    public function __construct($connection)
    {
        //$this->pdo = Database::getConnection();
        $this->connection = $connection;
    }

    public  function query()
    {
        return new QueryBuilder($this->table, $this->connection);
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 更多方法（创建、更新、删除等）...
}

<?php
namespace Yframe\Core\Database;

use PDO;

class QueryBuilder
{
    protected $table;
    protected $columns = ['*'];
    protected $conditions = [];
    protected $orders = [];
    protected $connection;

    public function __construct($table, $connection)
    {
        $this->table = $table;
        $this->connection = $connection;
    }

    public function select(...$columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->conditions[] = [$column, $operator, $value];
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->orders[] = [$column, $direction];
        return $this;
    }

    public function get()
    {
        // 构建查询
        $sql = "SELECT " . implode(', ', $this->columns) . " FROM {$this->table}";

        if (!empty($this->conditions)) {
            $conditions = array_map(function ($condition) {
                return "{$condition[0]} {$condition[1]} ?";
            }, $this->conditions);
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        if (!empty($this->orders)) {
            $orders = array_map(function ($order) {
                return "{$order[0]} {$order[1]}";
            }, $this->orders);
            $sql .= " ORDER BY " . implode(', ', $orders);
        }

        // 执行查询并返回结果
        // 准备查询
        $stmt = $this->connection->prepare($sql);

        // 绑定参数
        if (!empty($this->conditions)) {
            for ($i = 1; $i <= count($this->conditions); $i++) {
                $stmt->bindValue($i, $this->conditions[$i - 1][2]);
            }
        }

        // 执行查询
        $stmt->execute();

        // 获取结果
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        // 在这里，您需要使用您的数据库连接执行查询
        // 并将结果转换为适当的模型实例

        return $results;
    }
}

<?php

namespace App\Core;

trait Model
{
    use Database;

    /**
     * @var int
     */
    protected int $limit = 10;

    /**
     * @var int
     */
    protected int $offset = 0;

    /**
     * @var string
     */
    protected string $order_type = "desc";

    /**
     * @var string
     */
    protected string $order_column = "id";

    /**
     * @var array
     */
    public array $errors = [];

    /**
     * @return array|bool
     */
    public function findAll(): bool|array
    {

        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        return $this->query($query);
    }

    /**
     * @param $data
     * @return bool|array
     */
    public function insert($data): bool|array
    {
        /** remove unwanted data **/
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->allowedColumns)) {
                unset($data[$key]);
            }
        }
        try {
            $keys = array_keys($data);
            $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
            return $this->query($query, $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

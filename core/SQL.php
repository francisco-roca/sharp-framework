<?php

namespace Core;

class SQL {

    private $conn;
    private $sql;
    private $where;
    private $page;
    private $per_page;

    public function __construct($conn, string $sql, array $where = []) {
        $this->sql = $sql;
        $this->where = $where;
        $this->conn = $conn;
        return $this;
    }

    public function paginate(int $page, int $per_page = 10): SQL {
        $this->page = $page - 1;
        $this->per_page = $per_page;
        return $this;
    }

    public function getParams() {
        $params = [];

        foreach($this->where as $where) {
            $type = count($where);
            if($type == 3) {
                $params[$where[0]] = $where[2]; 
            } elseif($type == 2) {
                $params[$where[0]] = $where[1]; 
            } else {
                $params[array_keys($where)[0]] = $where[array_keys($where)[0]];
            }
        }

        return $params;
    }

    public function toSql(): string {
        $whereSql = "";

        foreach($this->where as $key => $where) {
            if(empty($whereSql)) {
                $whereSql .= " WHERE ";
            } else {
                $whereSql .= "AND ";
            }

            $type = count($where);

            if($type == 3) {
                $whereSql .= $where[0].$where[1].":".$where[0] . " ";
            } elseif($type == 2) {
                $whereSql .= $where[0]."=:".$where[0] . " ";
            } else {
                $whereSql .= array_keys($where)[0]."=:".array_keys($where)[0] . " ";
            }
        }

        return $this->sql . $whereSql . " LIMIT " . $this->per_page . " OFFSET " . $this->per_page * $this->page;
    }

    public function get() {
        return $this->conn::get($this->toSql(), $this->getParams());
    }

    public function exec() {
        return $this->conn::exec($this->toSql(), $this->getParams());
    }

    public function first() {
        return $this->conn::first($this->toSql(), $this->getParams());
    }

}

<?php
require_once 'pdo.php';
class SqlBuilder{
    private $dbh;
    private static $table = null;
    private $query = null;
    private $placeholders = null;

    public function __construct(){
        $this->dbh = PDOWrapper::setInstance();
    }

    public function connect($db){
        $this->dbh->connect($db);
    }

    public static function table($name){
        self::$table = $name;
        return new static;
    }

    public function select(string ...$fields){
        if($fields != []) {
            $fields = implode("`,`", $fields);
            $this->query = "SELECT `" . $fields . "` FROM `" . self::$table . "`";
            return $this;
        }else{
            $this->query = "SELECT * FROM `" . self::$table . "`";
            return $this;
        }
    }

    public function where($fields, string $operator, bool $and = true){
        $this->placeholders = $this->placeholders != null ? array_merge($this->placeholders, $fields) : $fields;
        $key = str_replace(":", "", key($fields));
        if($this->query != null) {
            if(strrpos($this->query, "WHERE")) {
                $this->query = $this->query . ($and === true ? " AND " : " OR ") . $key . " " . $operator . " " . key($fields);
                return $this;
            }
            else {
                $this->query = $this->query . " WHERE " . $key . " " . $operator . " " . key($fields);
                return $this;
            }
        }else{
            echo 'Для начала выберете таблицу(ы).';
        }
    }


    public function and($fields = [], string $operator){
    	$this->where($fields, $operator, true);
    }

    public function or($fields = [], string $operator){
    	$this->where($fields, $operator, false);
    }


    public function orderBy(string $field){
        $this->query = $this->query . " ORDER BY " . $field;
        return $this;
    }

    public function insert($fields){
        $this->placeholders = $fields;
        $keys = key($fields);
        next($fields);
        while(current($fields) != null){
            $keys = $keys . ", " . key($fields);
            next($fields);
        }
        $keys = str_replace(":", "", $keys);
        $this->query = "INSERT INTO `" . self::$table . "`(" . $keys . ")";
        return $this->values();
    }

    private function values(){
        $values = key($this->placeholders);
        next($this->placeholders);
        while(current($this->placeholders) != null){
            $values = $values . ", " . key($this->placeholders);
            next($this->placeholders);
        }
        $this->query = $this->query . " VALUES(" . $values . ");";
        return $this;
    }

    public function buildTable($array){
        echo '<table border =2>';
        echo '<tr>';
        foreach($array as $base_key => $base_value) {
            foreach ($base_value as $key => $value){
                echo '<th>',$key,'</th>';
            }
            break;
        }
        echo '</tr>';
        foreach($array as $base_key => $base_value) {
            echo '<tr>';
            foreach ($base_value as $key => $value) {
                echo '<td>', $value, '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        echo '<br />';
    }

    public function update($fields){
        $this->placeholders = $this->placeholders != null ? array_merge($this->placeholders, $fields) : $fields;
        $key = str_replace(":", "", key($fields));
        if($this->query != null || strrpos($this->query, "UPDATE")) {
            $this->query = $this->query . "," . $key . "=" . key($fields);
            return $this;
        }
        else {
            $this->query = $this->query . "UPDATE " . self::$table . " SET " .  $key . "=" . key($fields);
            return $this;
        }
    }

    public function SQL($query){
        $this->query = $query;
        return $this;
    }

    public function delete(){
        $this->query = "DELETE FROM `" . self::$table . "`";
        return $this;
    }

    public function get(){
        return $this->dbh->SQL($this->query, $this->placeholders);
    }

    public function dGet(){
        return $this->dbh->SQL($this->query, $this->placeholders, true);
    }

    public function send(){
        $this->dbh->SSQL($this->query, $this->placeholders);
    }

    public function dSend(){
        $this->dbh->SSQL($this->query, $this->placeholders, true);
    }

    public function getQuery(){
        return $this->query;
    }


}
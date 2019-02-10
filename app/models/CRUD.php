<?php
interface CRUD{
    public static function create($fields);
    public function read();
    public static function update($field, $where);
    public function delete();
}
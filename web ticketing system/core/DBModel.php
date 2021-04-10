<?php


namespace app\core;


abstract class DBModel extends Model
{
    abstract public function tableName();
    abstract public function attributes(): array;

    public function create(){
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $values = array_map(fn($attr) => ":$attr", $attributes);

        $db = $this->dbConnection->conn();

        $sqlString = "INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $values) . ")";

        foreach ($attributes as $attribute) {
            $sqlString = str_replace(":$attribute", is_numeric($this->{$attribute}) ? $this->{$attribute} : '"' . $this->{$attribute} . '"', $sqlString);
        }

        $db->query($sqlString) or die();

        return true;
    }

    public function all() {
        $tableName = $this->tableName();

        $db = $this->dbConnection->conn();

        $sqlString = "SELECT * FROM $tableName;";

        $dataResult = $db->query($sqlString) or die();
        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function one($where) {
        $tableName = $this->tableName();

        $db = $this->dbConnection->conn();

        $sqlString = "SELECT * FROM $tableName WHERE $where";

        $dataResult = $db->query($sqlString) or die();

        $result = $dataResult->fetch_assoc();

        return $result;
    }

    public function delete($where)
    {
        $tableName = $this->tableName();

        $db = $this->dbConnection->conn();

        $dbData = $db->query("DELETE FROM $tableName WHERE $where;") or die($db->error);

        return true;
    }
}
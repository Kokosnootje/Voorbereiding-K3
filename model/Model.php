<?php

require_once('../lib/Database.php');

/**
 * Class Model
 * Basic usage, extend this file to any database-table/ model
 */
class Model
{
    static $DB;
    static $table;

    function __construct($table) {

        $this->setTable($table);
        $this->setDB(new Database());
    }

    function setTable($table) {
        static::$table = $table;
        return;
    }
    function setDB($DB) {
        static::$DB = $DB;
        return;
    }

    static protected function getTable() {
        return static::$table;
    }

    static protected function getDB() {
        return static::$DB;
    }

    public function className() {
        return get_class($this);
    }

    public function save() {
        if (empty($this->id)) {
            $this->saveNew();
        } else {
            $id = $this->id;
            $this->saveExisting($id);
        }
    }

    public function saveExisting($id) {
        $where = " WHERE id = ".$id;
        $updateQry = "id = '".$id."'";
        $modelColumns = $this->getColumns();
        foreach ($modelColumns AS $c) {
            if ($c != 'id') {
                $updateQry .= ", ".$c." = '".$this->$c."'";
            }
        }

        $this->getDB()->query("UPDATE ".$this->getTable()." SET ".$updateQry.$where);

        return true;
    }

    public function saveNew() {
        $modelColumns = $this->getColumns();
        $cols = [];
        $values = [];
        foreach ($modelColumns AS $c) {
            if ($c != 'id') {
                $cols[] = $c;
                $values[] = $this->$c;
            }
        }

        $qry = "INSERT INTO ".$this->getTable()." (".implode(',', $cols).") VALUES (".implode(',', $values).");";
        static::$DB->query($qry);
        return $this->getDB()->lastInsertedID();
    }

    public static function all() {
        $model = static::childClass();
        $db = new Database();
        $allData = $db->query('SELECT id FROM '.static::$table)->fetch_all();
        $retData = [];
        foreach ($allData AS $obj)
            $retData[] = $model::find($obj[0]);

        return $retData;
    }

    public static function find($id) {
        $obj = static::childClass();
        $model = new $obj(static::getTable());

        $keys = $model->getColumns();
        $cols = [];
        foreach ($keys AS $k)
            $cols[] = $k;

        $theUser = static::$DB->query('SELECT * FROM '.static::$table.' WHERE id = '.$id)->fetch_row();

        foreach ($cols AS $key => $value)
            $model->$value = $theUser[$key];

        return $model;
    }

    public static function whereOne($key, $operator, $value) {
        $obj = static::where($key, $operator, $value);
        if (!empty($obj))
            return $obj[0];

        return null;
    }

    public static function where($key, $operator, $value) {
        $model = static::childClass();
        $where = " WHERE $key $operator '$value'";

        $qry = "SELECT id FROM ".static::$table.$where;
        $allData = static::$DB->query($qry)->fetch_all();

        $retData = [];
        foreach ($allData AS $obj)
            $retData[] = $model::find($obj[0]);

        return $retData;
    }

    public static function getAllColumnInformation() {
        $db = new Database();
        $cols = $db->query("SHOW columns FROM ".static::$table.";")->fetch_all();
        $retData = [];
        foreach ($cols AS $c)
            $retData[] = $c;

        return $retData;
    }

    public static function getColumns() {
        $db = new Database();
        $cols = $db->query("SHOW columns FROM ".static::$table.";")->fetch_all();
        $retData = [];
        foreach ($cols AS $c)
            $retData[] = $c[0];

        return $retData;
    }

    public static function childClass() {
        return get_called_class();
    }

    public function hasOne($model, $primary_key, $foreign_key) {
        return $model::whereOne($foreign_key,'=', $this->$primary_key);
    }

    public function BelongsTo($model, $primary_key, $foreign_key) {
        return $model::whereOne($this->$primary_key, '=', $foreign_key);
    }

    public function hasMany($model, $primary_key, $foreign_key) {
        return $model::where($foreign_key,'=', $this->$primary_key);
    }
}
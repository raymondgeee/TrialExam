<?php
class TrialClass
{
    private $sqlQuery;
    private $DBServer;
    private $DBUser;
    private $DBPass; 
    private $DBName; 
    protected $db; 

    private $tableName; 
    private $fields; 
    private $values; 

    public function __construct()
    {
        
        $this->DBServer = "localhost";
        $this->DBUser = "root";
        $this->DBPass = "";
        $this->DBName = "trialproject";
        $this->dbConnect();
    }

    private function reset()
    {
        $this->tableName = ""; 
        $this->fields = []; 
        $this->values = []; 
    }

    private function dbConnect()
    {
        $this->db = new mysqli($this->DBServer, $this->DBUser, $this->DBPass, $this->DBName);
        if ($this->db->connect_error)
        {
            trigger_error('Database connection failed: '  . $this->db->connect_error, E_USER_ERROR);
        }
    }

    public function setTableName($table)
    {
        $this->tableName = $table;
        return $this;
    }

    public function setFieldsValues($field, $value = "")
    {
        $this->fields = [];
        $this->values = [];
        if(is_array($field))
        {
            foreach ($field as $key => $values) 
            {
                $this->fields[] = $key;
                $this->values[] = $this->db->real_escape_string($values);
            }
        }
        else
        {
            $this->fields[] = $field;
            $this->values[] = $this->db->real_escape_string($value);
        }

        return $this;
        $this->sqlQuery = "";
    }

    public function insert()
    {
        $sqlDataQuery = $this->sqlQuery;
        
        if($sqlDataQuery != "")
        {
            $sql = "INSERT INTO ".$this->tableName." (".implode(", ",$this->fields).") VALUES ({$sqlDataQuery})";
            $queryInsert = $this->db->query($sql);
            if(!$queryInsert)
            {
                return $this->db->error;
            }
        }
        else
        {
            $sql = "INSERT INTO ".$this->tableName." (".implode(", ",$this->fields).") VALUES ('".implode("', '",$this->values)."')";
            $queryInsertAgain = $this->db->query($sql);
            if(!$queryInsertAgain)
            {
                return $this->db->error;
            }
        }

        $this->sqlQuery = "";
        $this->fields = [];
        $this->values = [];
    }

    public function update($whereQuery)
    {
        $x = 0;
        $valuesArray = [];
        foreach ($this->fields AS $key) 
        {
            $valuesArray[] = $key."='".$this->values[$x]."'";
            $x++;
        }

        $sql = "UPDATE ".$this->tableName." SET ".implode(", ", $valuesArray)." WHERE ".$whereQuery;
        $queryUpdate = $this->db->query($sql);
        if(!$queryUpdate)
        {
            return $this->db->error." ".$sql;
        }
        else
        {
            return $this->db->affected_rows;
        }

        $this->sqlQuery = "";
        $this->fields = [];
        $this->values = [];
    }

    public function delete($whereQuery)
    {
        $sql = "DELETE FROM ".$this->tableName." WHERE ".$whereQuery;
        $queryDelete = $this->db->query($sql);
        if(!$queryDelete)
        {
            return $this->db->error;
        }
        else
        {
            return $this->db->affected_rows;
        }
    }

    public function getRecords()
    {
        $results = [];
        $sql = $this->sqlQuery;
        $queryRecords = $this->db->query($sql);
        if($queryRecords AND $queryRecords->num_rows > 0)
        {
            while($resultRecords = $queryRecords->fetch_assoc())
            {
                $results[] = $resultRecords;
            }
        }

        $this->sqlQuery = "";
        return $results;
    }

    public function setSQLQuery($sqlData)
    {
        $this->sqlQuery = $sqlData;
        return $this;
    }
}
?>
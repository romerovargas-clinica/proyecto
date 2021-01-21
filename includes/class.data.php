<?php

class DataBase
{

    var $connection;

    public function __construct()
    {
        if (DB_PASS == NULL)
            $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_NAME);
        else
            $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME); // or die(mysqli_error($this->connection));
        if (!$this->connection)
            throw new Exception("0000:No ha sido posible conectar con la Base de Datos [on class DataBase->construct database.php from PHPcore]:");
        $acentos = mysqli_query($this->connection, "SET NAMES 'utf8'");
        return true;
    }

    public function send($sql, $type = 'ARRAY')
    {
        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        if (is_null($result))
            throw new Exception("0002:Error de sintaxis al ejecutar consult SQL [on class DataBase->send database.php from PHPcore]:$sql");
        $return = array();
        //var_dump($return);
        //var_dump($sql);

        if ($type == 'ARRAY')
            while (($return[] = mysqli_fetch_array($result))) {
            }
        else {
            while (($return[] = mysqli_fetch_assoc($result))) {
            }
        }
        if (count($return) > 1)
            unset($return[count($return) - 1]);
        else
            $return = FALSE;
        return $return;
    }

    public function select($table, $where, $type = 'ARRAY')
    {
        $sql = "SELECT * FROM " . $table . " WHERE " . $where;
        //echo $sql;
        $result = mysqli_query($this->connection, $sql);
        if (!$result)
            throw new Exception("0003:Error de sintaxis al ejecutar consulta SELECT SQL [on class DataBase->select database.php from PHPcore]:$sql");
        $return = array();
        if ($type == 'ARRAY')
            while (($return[] = mysqli_fetch_array($result))) {
            }
        else
            while (($return[] = mysqli_fetch_assoc($result))) {
            }
        if (count($return) > 1)
            unset($return[count($return) - 1]);
        else
            $return = FALSE;
        return $return;
        //Example
        // select('myTable',"type = 'main'")
    }

    public function insert($table, $data)
    { // well done
        $fields = $this->getFields($table);
        //if (count($fields) == count($data)) { // Comentado para que permita distinto número de campos
        $fields = implode(",", $fields);
        $sdata = array();
        //foreach ($data as $value) {
        //$sdata[] = $this->secure($value); //Checking SQL injection                
        //}
        $fields = array();
        foreach ($data as $key => $value) {
            $sdata[] = $this->secure($value); //Checking SQL injection
            $fields[] = $key;
        }
        $fields = implode(", ", $fields);
        $sdata = implode(", ", $sdata);
        $sql = "INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $sdata . ")";
        if (mysqli_query($this->connection, $sql)) {
            //echo $sql."<br/>";
            return true;
        } else {
            throw new Exception("0004:Error de sintaxis al ejecutar consulta INSERT SQL[on class DataBase->insert database.php from PHPcore]:$sql");
            return false;
        }
        //} else
        //return false;
        //Example
        // insert('myTable', $anarray)
    }

    public function update($table, $update, $where, $SQLInyection = 'YES')
    {
        $fields = array_keys($update);
        $sdata = array();
        foreach ($update as $key => $value) {
            if ($SQLInyection == 'YES')
                $sdata[] = str_replace("'", "`", $this->secure($key)) . " = " . $this->secure($value); //Checking SQL injection
            else
                $sdata[] = str_replace("'", "`", $this->secure($key)) . " = " . $value;
            //Checking SQL injection
        }
        $sdata = implode(",", $sdata);
        $sql = "UPDATE " . $table . " SET " . $sdata . " WHERE " . $where;
        //echo $sql;
        if (mysqli_query($this->connection, $sql))
            return true;
        else
            throw new Exception("0005:Error de sintaxis al ejecutar consulta UPDATE SQL [on class DataBase->update database.php from PHPcore]:$sql");
        //Example
        // update('myTable', $anarray, "type = 'main'")
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM " . $table . " WHERE " . $where;
        //echo $sql;
        if (mysqli_query($this->connection, $sql))
            return true;
        else
            throw new Exception("0006:Error de sintaxis al ejecutar consulta DELETE SQL [on class DataBase->delete database.php from PHPcore]:$sql");
        //Example
        // delete('myTable',"type = 'main'")
    }

    public function getFields($table, $type = NULL)
    { //well done
        $return = array();
        $result = @mysqli_query($this->connection, "SHOW COLUMNS FROM " . $table);
        if (!$result)
            throw new Exception("0007:Cannot execute SHOW COLUMS query, syntax error [on class DataBase->getFields database.php from PHPcore]: SHOW COLUMNS FROM " . $table);
        if (@mysqli_num_rows($result) > 0) {
            while ($row = @mysqli_fetch_assoc($result)) {
                if ($type != NULL)
                    $return[] = $row;
                else
                    $return[] = $row['Field'];
            }
        }
        return $return;
    }

    public function getNumberRows($table)
    { //well done
        $temp = @mysqli_query($this->connection, "SELECT SQL_CALC_FOUND_ROWS * FROM $table LIMIT 1");
        if (!$temp)
            throw new Exception("0008:Cannot execute query, syntax error [on class DataBase->getNumberRows database.php from PHPcore]");
        $result = @mysqli_query($this->connection, "SELECT FOUND_ROWS()");
        if (!$result)
            throw new Exception("0009:Cannot execute query, syntax error [on class DataBase->getNumberRows database.php from PHPcore]");
        $total = @mysqli_fetch_row($result);
        return $total[0];
    }

    public function secure($valor)
    { //well done        
        if (!is_numeric($valor)) {
            $valor = "'" . mysqli_real_escape_string($this->connection, $valor) . "'";
        }
        return $valor;
    }

    public function table_to_array($table)
    { //well done{
        $columns = array();
        $array = array();
        $result_all = @mysqli_query($this->connection, "SELECT * FROM $table");
        $columns = $this->getFields($table);
        while ($data = mysqli_fetch_assoc($result_all)) {
            foreach ($columns as $column_name)
                $array[][$column_name] = $data[$column_name];
        }
        return $array;
    }

    public function show($table)
    { //well done
        $content = $this->table_to_array($table);
        print_r($content);
    }

    public function close()
    {
        @mysqli_close($this->connection);
    }
}

<?php

require_once  "connection.php";
class DAO
{
    private $pdo;

    protected function __construct()
    {
    }

    private function sqlExecute($sql, $params = null, $read = false)
    {
        try {

            $this->pdo = new Connection();
            $this->pdo = $this->pdo->get_db();
            $query = $this->pdo->prepare($sql);

            if (empty($params))
                $params = array();
            if ($read) {
                $query->execute($params);
                return $query;
            }
            if ($res = $query->execute($params)) {
                $res_id = $this->pdo->lastInsertId();
                if ($res_id == 0)
                    return $res;
                return $res_id;
            }
            return $res;
        } catch (PDOException $e) {
            #return $e;
            return $e;
        }
    }
    protected function create($table, $params)
    {

        $sql = "INSERT INTO " . $table . " VALUES(";
        for ($i = 1; $i < sizeof($params); $i++) {
            $sql .= "?,";
        }
        $sql .= "?)";

        return $this->sqlExecute($sql, $params);
    }
    protected function read($table, $data, $params = null, $where = null)
    {


        $sql = "SELECT " . $data . " FROM " . $table;
        if (!empty($where))
            $sql .= " WHERE " . $where;
        if ($dbo = $this->sqlExecute($sql, $params, true))
            return $dbo->fetchAll(PDO::FETCH_ASSOC);
        return false;
    }
    protected function update($table, $params)
    {

        $sql = "UPDATE " . $table . " SET ";

        $i = 1;
        $tam = sizeof($params);
        $params2 = array();

        foreach ($params as $key => $value) {
            array_push($params2, $value);
            if ($i < $tam) {
                $sql .= $key . " = ? ";
                if ($i < $tam - 1)
                    $sql .= ", ";
            } else {
                $where = $key;
                $id = $value;
                break;
            }
            $i++;
        }
        $sql .= " WHERE " . $where . " = ?";
        return $this->sqlExecute($sql, $params2);
    }
    protected function delete($table, $where, $id)
    {
        $sql = "DELETE FROM " . $table . " WHERE " . $where . " = ?";
        return $this->sqlExecute($sql, array($id));
    }
}

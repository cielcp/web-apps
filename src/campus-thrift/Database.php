<?php
/**
 * Database Class
 *
 * Contains connection information to query PostgresSQL.
 */


class Database {
    private $dbConnector;

    /**
     * Constructor
     *
     * Connects to PostgresSQL
     */
    public function __construct() {

        $host = Config::$db["host"];
        $user = Config::$db["user"];
        $database = Config::$db["database"];
        $password = Config::$db["pass"];
        $port = Config::$db["port"];

        $this->dbConnector = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
    }

    /**
     * Query
     *
     * Makes a query to posgres and returns an array of the results.
     * The query must include placeholders for each of the additional
     * parameters provided.
     */
    public function query($query, ...$params) {
        $res = pg_query_params($this->dbConnector, $query, $params);

        if ($res === false) {
            echo pg_last_error($this->dbConnector);
            return false;
        }

        return pg_fetch_all($res);
    }

    public function prepare($sql){
        return $stmt = pg_prepare($this->dbConnector, $sql);

    }

    public function prepareAndExecute($name, $sql, $params) {
        $stmt = pg_prepare($this->dbConnector, $name, $sql);
        $result = pg_execute($this->dbConnector, $name, $params);
        if ($result) {
            return pg_fetch_all($result); // Fetch and return all rows as an associative array
        } else {
            return false; // Or handle the error appropriately
        }
    }
}
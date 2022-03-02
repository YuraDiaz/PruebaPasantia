<?php

require_once __DIR__ . "/../../config/config.php";
class Connection
{

    private $conf;

    public function __construct()
    {
        try {
            // Se traen los datos para la conexion
            $this->conf = new Config();
            $this->conf = $this->conf->getDatabase();
            // Crear nueva conexión PDO
        } catch (PDOException $e) {
            error_log($e, 3, __DIR__ . "/error.log");
            return false;
        }
    }

    public function get_db()
    {
        // Se inicializa un nuevo objeto de tipo PDO
        $driver = new PDO(
            $this->conf['type'] . ":dbname=" . $this->conf['database'] .
                ";host=" . $this->conf['host'] .
                ";port:" . $this->conf['port'] .
                ";",
            $this->conf['user'],
            $this->conf['password'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        // Habilitar excepciones
        $driver->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $driver;
    }
}

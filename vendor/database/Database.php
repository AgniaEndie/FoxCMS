<?php

namespace database;

use mysqli;

class Database
{
    private $config,$host,$user,$pass,$base,$mysql,$result;

    public function __construct()
    {
        $this->config = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/Config.ini");
        $this->host = $this->config['host'];
        $this->user = $this->config['user'];
        $this->pass = $this->config['pass'];
        $this->base = $this->config['base'];
        $this->mysql = new  mysqli($this->host,$this->user,$this->pass,$this->base);
    }


    public function query(String $query){
        if(isset($query)){
            $this->result =  $this->mysql->query($query);
            return $this->result;
        }else{
            throw new \mysqli_sql_exception('Query is Null! @query');
        }
    }

}
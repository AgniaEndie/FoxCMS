<?php

namespace auth;

use database\Database;
use tpl\TemplateLoader;

class AuthProvider
{
    private $mysql,$username,$password,$email,$userId,$auth_token,$status,$result,$adress,$query,$id,$row,$tpl,$passwordHash,$userstatus;




    public function __construct()
    {
        $this->mysql = new Database();
        $this->tpl =  new TemplateLoader();
    }


    public function Auth($login,$passwordfromscript){
        if(isset($login)){
            $this->query = "SELECT * FROM `users` where `username` = '$login'";
            if (!empty($this->mysql)) {
                $result = $this->mysql->query($this->query);
            }
            while($this->row = $result->fetch_row()){
                $this->userId = $this->row[0];
                $this->username = $this->row[1];
                $this->password = $this->row[3];
                $this->email = $this->row[2];
                $this->userstatus = $this->row[5];
            }
            if(password_verify($passwordfromscript,$this->password)){
                $_SESSION['user'] = [
                    "id"=> $this->userId,
                    "username" => $this->username,
                    "email" => $this->email,
                    "status"=>$this->userstatus,
                ];

                return $this->tpl->sendSimpleTemplate("AuthMessage");
                ?>

                <?php
            }
        }else{
            throw  new \mysqli_sql_exception("MysqliERROR");
        }
    }


    public function Registry($username,$email,$password,$adress){
        if(isset($username)){
            $this->username = $username;
            $this->password = $password;
            $this->adress = $adress;
            $this->email = $email;
            $this->passwordHash = password_hash($this->password,CRYPT_SHA256);

            $this->query = "INSERT INTO `users` (`username`,`email`,`password`,`status`,`adress`) VALUES('$this->username','$this->email','$this->passwordHash',0,'$this->adress')";
            $this->result = $this->mysql->query($this->query);

            if(isset($this->result)){
                $search = [
                    "%Text%"
                ];
                $result = [
                    "Вы успешно зарегистрировались"
                ];
                $this->tpl->sendSimpleTemplate("SimpleTemplate",$search,$result);
            }else{
                $search = [
                    "%Text%"
                ];
                $result = [
                    "Произошла ошибка"
                ];
                $this->tpl->sendSimpleTemplate("SimpleTemplateDanger",$search,$result);
            }

        }else{
            throw new \Exception("MysqliError");
        }
    }

    public function apiAuth($username,$password){

    }

}
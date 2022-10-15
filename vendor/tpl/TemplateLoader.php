<?php

namespace tpl;

class TemplateLoader
{
    private $tpl,$filepath,$search,$replace,$mysql,$type;

    public function __construct()
    {
        $this->type = array(
          "simple"=>"SimpleTemplate",
          "simple_danger"=>"SimpleTemplateDanger",
            "item"=>"ItemSimple",
            "about_item"=>"AboutItem",
            "cartItem"=>"ItemCart",
            "item_cart_nullable"=>"ItemCartNullable",
            "admin_disabled"=>"AdminDisabled",
            "dashboard"=>"Dashboard",
            "tablerow"=>"TableRow",
            "orders"=>"Orders",
            "tovar_table_row"=>"TovarTableRow",
            "tovar_table_edit"=>"TovarTableEdit",
            "tovar_table_create"=>"TovarTableCreate",
            "user_table_row"=>"UserTableRow",
            "user_table_edit"=>"UserTableEdit",
        );
    }

    public function sendSimpleTemplate($type,$search=null,$replace=null,$mysql = null){
        if(in_array($type,$this->type)){
            $this->filepath = $_SERVER['DOCUMENT_ROOT']."/templates/".$type.".tpl";
            $this->tpl = file_get_contents($this->filepath);
            $this->tpl = str_replace($search,$replace,$this->tpl);
            return $this->tpl;
        }else{
            return var_dump($this->type);
        }
    }

    public function sendAdminTemplate($type,$search=null,$replace=null,$mysql = null){
        if(in_array($type,$this->type)){
            $this->filepath = $_SERVER['DOCUMENT_ROOT']."/templates/admin/".$type.".tpl";
            $this->tpl = file_get_contents($this->filepath);
            $this->tpl = str_replace($search,$replace,$this->tpl);
            return $this->tpl;
        }else{
            return var_dump($this->type);
        }
    }
}
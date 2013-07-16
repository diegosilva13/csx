<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class validation{
    function insert_data($dados = NULL){
        foreach ($dados as $key => $value) {
            if($dados[$key] == "")
                $dados[$key] = FALSE;
        }
        return $dados;
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ccm_crud extends CI_Model{
    public function insert_DB($dados = NULL,$tabela = NULL){
        if($dados!=NULL){
            if($this->db->insert($tabela,$dados))
                return true;
            else
                return false;
        }
    }
    public function listar($tabela = NULL){
        if($tabela != NULL){
           return $this->db->get($tabela);
        }
    }
    public function get_all($tabela = NULL){
        return $this->db->get($tabela)->result();
    }
    public function get_where($tabela = NULL, $dados = NULL){
            $this->db->select('*');
            $this->db->from($tabela);
            $this->db->where('id',$dados['id']);
            $query = $this->db->get();
            return $query->result();
    }
     public function get_user($tabela = NULL, $dados = NULL){
         $this->db->where(array('usuario'=>$dados['usuario'],'senha'=>$dados['senha']));
         $res = $this->db->get($tabela);
         $data = array();
         if($res->num_rows == 1){
             $data['valido'] = true;
             $data['dados'] = $res->result();
         }else{
            $data['valido'] = FALSE;
         }
         return $data;
     }
    public function update($tabela = NULL,$dados=NULL,$id=NULL){
        if($dados!=NULL && $tabela != NULL && $id!=NULL){
            $this->db->where('id',$id);
           return $this->db->update($tabela,$dados);
        }
    }
}
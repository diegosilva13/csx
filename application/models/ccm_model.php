<?php
class ccm_model extends CI_Model{
         public function Query($query){
            return $this->db->Query($query);
    }
        public function Busca_DB($tabela,$campo,$id){
            $query = "SELECT * FROM $tabela WHERE $campo = '$id'";
            return $this->Query($query);
        }
        public function Busca_senha($tabela,$id){
            $query = "SELECT senha FROM $tabela WHERE  id = '$id'";
            return $this->db->Query($query)->result();
        }
     public function getInsertID(){
            $id = pg_insert_id();
            return $id;
        }
    public function Insert_DB($tabela,$dados){
	$array_campos = array_keys($dados);
           $array_valores = array_values($dados);
           $num_campos = count($array_campos);
           $num_valores = count($array_valores);
           if($num_campos == $num_valores){
               $sql = "INSERT INTO ".$tabela."(";
               foreach ($array_campos as $key => $num_campos){
                   $sql.="$array_campos[$key],";
               }
               $sql=substr_replace($sql,")",-1,1);
               $sql.="VALUES(";
               foreach ($array_valores as $key => $num_valores) {
                   $sql.="'".$array_valores[$key]."',";
                   } 
                   $sql = substr_replace($sql,")",-1,1);
           }
           else{
              echo "Erro! Não mero de Campos diferente de valores"; 
           }
           $result = $this->Query($sql);
           return $result;
        }
        public function Update_DB($tabela,$dados,$campo,$id){
           $array_campos = array_keys($dados);
           $array_valores = array_values($dados);
           $num_campos = count($array_campos);
           $num_valores = count($array_valores);         
           if($num_valores == $num_campos){
             $sql = "UPDATE ".$tabela." SET ";
             for($index=0;$index<$num_campos;$index++){
                 $sql.=" $array_campos[$index]='$array_valores[$index]',";
               }
               $sql = substr_replace($sql,"",-1,1);
               $sql.="WHERE $campo='$id'";
           }else{
               echo "Erro!Número de campos diferente de valores!";
           }
           return $this->Query($sql);
        }
        public function Delete_DB($tabela,$campo,$id){
            $query = "DELETE FROM $tabela WHERE $campo = '$id'";
            return $this->Query($query);
        }
        public function Delete_user($tabela = NULL,$campo = NULL,$id = NULL){
            $permissao = $this->Busca_DB('usuario','id', $id);
            foreach ($permissao->result() as $value){}
            if($value->permissao == 'super')
                return false;
            $query = $this->db->query("DELETE FROM $tabela WHERE $campo = '$id'");
            if($query)
                return true;
            
            return false;
        }
        public function cancelaCadastro($id_user = NULL, $id_torneio = NULL){
            $query = $this->db->query("DELETE FROM cadastro_torneio WHERE id_user = '$id_user' AND id_torneio = '$id_torneio'");
            if($query)
                return true;
            return false;
        }
        public function contaRegistro($tabela = NULL){
            if($tabela)
                return $this->db->count_all_results($tabela);
            else
                return false;
        }
        public function contaRegistroNoticia($tabela = NULL){
            if($tabela){
                $this->db->where('publica','t');
                $this->db->where('publicar','t');
                return $this->db->count_all_results($tabela);
            }
            else
                return false;
        }
        public function contaRegistroTorneio($tabela = NULL){
            if($tabela){
                if($this->session->userdata('permissao') == 'guest'){
                    $this->db->where('publicar','t');
                     return $this->db->count_all_results($tabela);
                }
            }
           return $this->db->count_all_results($tabela);
        }
        public function contCadastro($id_torneio,$id_user){
                    $this->db->where(array('id_torneio'=>$id_torneio,'id_user'=>$id_user));
                    return $this->db->count_all_results('cadastro_torneio');
            }
         public function contaRegistroBusca($tabela = NULL , $busca = NULL){
            if($tabela){
                $this->db->or_like('event',$busca);
                $this->db->or_like('site',$busca);
                $this->db->or_like('date',$busca);
                $this->db->or_like('round',$busca);
                $this->db->or_like('white',$busca);
                $this->db->or_like('black',$busca);
                $this->db->or_like('result',$busca);
                $this->db->or_like('eco',$busca);
                $this->db->or_like('plycount',$busca);
                $this->db->or_like('eventdate',$busca);
                $this->db->or_like('notation',$busca);
                return $this->db->count_all_results($tabela);
            }
            else
                return false;
        }
        public function retornaLista($maximo = NULL, $inicio,$tabela){
            $this->db->select("*");
            $this->db->from($tabela);
            if($maximo)
                $this->db->limit($maximo, $inicio);
            $query = $this->db->get();
            return $query->result();
        }
        public function retornaListaBusca($maximo,$inicio,$busca){
                $this->db->or_like('event',$busca);
                $this->db->or_like('site',$busca);
                $this->db->or_like('date',$busca);
                $this->db->or_like('round',$busca);
                $this->db->or_like('white',$busca);
                $this->db->or_like('black',$busca);
                $this->db->or_like('result',$busca);
                $this->db->or_like('eco',$busca);
                $this->db->or_like('plycount',$busca);
                $this->db->or_like('eventdate',$busca);
                $this->db->or_like('notation',$busca);
                $this->db->limit($maximo,$inicio);
                $query = $this->db->get('partida')->result();
            return $query;
        }
        public function retorna_noticias_publicas($maximo, $inicio){
            $this->db->where('publicar','t');
            $this->db->where('publica','t');
            $this->db->limit($maximo,$inicio);
            return $this->db->get('noticias')->result();
        }
       public function retorna_torneios_publicados($maximo, $inicio){
             $this->db->where('publicar','t');
            $this->db->limit($maximo,$inicio);
            return $this->db->get('torneio')->result();
       }
        public function retorna_noticias_interna($maximo, $inicio){
            $this->db->where('publicar','t');
            $this->db->where('privada','t');
            $this->db->limit($maximo,$inicio);
            return $this->db->get('noticias')->result();
        }
        public function listaInscritos($id_torneio = NULL){
            $this->db->select('usuario.id,usuario.nome,usuario.email,usuario.telefone');
            $this->db->from('cadastro_torneio');
            $this->db->join('usuario', 'usuario.id = cadastro_torneio.id_user');
            $this->db->join('torneio', 'torneio.id = cadastro_torneio.id_torneio');
            $this->db->where('torneio.id',$id_torneio);
            return $this->db->get()->result();
        }
}
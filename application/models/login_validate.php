<?php

class login_validate extends CI_Model{
     public function valida_login(){
            if(!$this->session->userdata('logged'))
                redirect('auth/login');
            return true;
        }
         public function valida_login_admin(){
             $this->valida_login();
            if($this->session->userdata('permissao') != 'admin' && $this->session->userdata('permissao') != 'super'){
               $this->session->set_flashdata('usuarioOK',  utf8_encode('<p class="msg warning">Você não tem permissão para executar essa ação!</p>'));
                redirect('usuario/listar_usuario');
            }
        }
        public function logar($dados = NULL){
            foreach ($dados as $value) {}
            $session_user = array('id'=>$value->id,'usuario'=>$value->usuario,'email'=>$value->senha,'permissao'=>$value->permissao,'logged'=>true,'senha'=>$value->senha);
            $this->session->set_userdata($session_user);
            if($this->session->userdata('logged') && $this->session->userdata('usuario'))
                return true;
            return false;
        }
         function loggoff(){
            if($this->session->userdata('arquivo'))
                unlink($this->session->userdata('arquivo'));
            if($this->session->userdata('pgn_path'))
                unlink ($this->session->userdata('pgn_path'));
            $this->session->unset_userdata('arquivo');
            $this->session->unset_userdata($session_user);
            $this->session->sess_destroy();
            redirect('site');
        }
    
}
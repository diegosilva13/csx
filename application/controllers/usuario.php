<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuario extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','ckeditor'));
		$this->load->database();
		$this->load->library(array('ccm_css_js','form_validation','pagination','validation','write_html'));
                $this->load->model(array('ccm_model','ccm_crud','login_validate'));
	}
	public function _usuario_output($output = null){
		$scripts = new ccm_css_js();
		$output = array(
		'page'=>$output['pagina'],
                'folder'=>'usuario',
		'title'=>$output['title'],
		'css'=> $scripts->_css_(),
                'folder'=>'usuario',
               'editor' => $scripts->constroi_editor(),
                'query'=>$output['query'],
		'script'=>$scripts->_script_js());
		$this->load->view('admin.php',$output);
	}
        public function index(){
            $this->home();
        }
        public function home(){
            $this->login_validate->valida_login();
            $inicio = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
            $config['total_rows'] = $this->ccm_model->contaRegistroNoticia('noticias');
            $config['base_url'] = base_url().'usuario/home/' ;
            $config['per_page'] = 3;
            $config['full_tag_open'] = "<ul>";
            $config['first_tag_open'] = '<li>';
            $config['first_link'] = 'Primeiro';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_link'] = "Último";
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_link'] = "Próximo";
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_link'] = "Anterior";
            $config['prev_tag_close'] = '</li>';
            $config['full_tag_close'] = "</ul>";
            $config['cur_tag_open'] = '<li class="disabled"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $output = array(
                'pagina'=>'home.php',
                'title'=>'Últimas Noticias',
                'query'=>$this->ccm_model->retorna_noticias_interna(3,$inicio),
                 );
            $this->_usuario_output($output);
        }

        public function listar_usuario(){
            $this->login_validate->valida_login();
            $inicio = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
            $config['total_rows'] = $this->ccm_model->contaRegistro('usuario');
            $config['base_url'] = base_url().'usuario/listar_usuario/' ;
            $config['per_page'] = 10;
            $config['full_tag_open'] = "<ul>";
            $config['first_tag_open'] = '<li>';
            $config['first_link'] = 'Primeiro';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_link'] = "Último";
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_link'] = "Próximo";
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_link'] = "Anterior";
            $config['prev_tag_close'] = '</li>';
            $config['full_tag_close'] = "</ul>";
            $config['cur_tag_open'] = '<li class="disabled"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $output = array(
                'pagina'=>'listar_usuario.php',
                'title'=>'Usuários Cadastradas',
                'query'=>$this->ccm_model->retornaLista(10,$inicio,'usuario'),
                 );
            $this->pagination->initialize($config);
            $this->_usuario_output($output);
	}
        public function ver_usuario(){
            $this->login_validate->valida_login();
            $id['id'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
             if($id['id']){  
                $query = $this->ccm_crud->get_where('usuario',$id);
                if(!$query){
                    redirect(current_url());
                }  else {
                   $output = array('pagina'=>'ver_usuario.php','title'=>'Perfil do usuário','query'=>$query);
                   $this->_usuario_output($output);
                }
             }else{
                 redirect('usuario');
             }
        }
        public function editar_perfil(){
            $this->login_validate->valida_login();
            $id['id'] = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
            if(!$this->compara_id($id['id']) && !(@$_GET['edit'])){
                $this->session->set_flashdata('usuarioOK',utf8_encode('<p class="msg warning">Você não tem permissão para editar esse usuário!</p>'));
                redirect('usuario');
            }
             if($id['id']){  
                $query = $this->ccm_crud->get_where('usuario',$id);
                if(!$query){
                    redirect(current_url());
                }  else {
                   $output = array('pagina'=>'perfil_usuario.php','title'=>'Atualizar perfil','query'=>$query);
                   $this->_usuario_output($output);
                }
             }else{
             if(!$this->compara_id($_GET['edit'])){
                 $this->session->set_flashdata('perfilOK', utf8_encode('<p class="msg error">Você mudou o EDIT da url malandro!</p>'));
                 redirect('usuario/editar_perfil/'.$this->session->userdata('id'));
             }
              $this->form_validation->set_rules('nome','NOME','required');
              $this->form_validation->set_rules('telefone','TELEFONE','required|numeric');
              $this->form_validation->set_rules('email','e-MAIL','required|valid_email');
              $this->form_validation->set_rules('sexo','SEXO','required');
              $this->form_validation->set_rules('sobre','Fale um pouco sobre você','required');
              if($this->form_validation->run()==TRUE){
                $dados = elements(array('nome','endereco','email','telefone','idade','sexo','sobre'), $this->input->post());
                $dados = $this->validation->insert_data($dados);
                if($this->ccm_model->Update_DB('usuario',$dados,'id',$_GET['edit'])){
                    $session_user = array('email'=>$dados['email']);
                    $this->session->set_userdata('email');
                    $this->session->set_flashdata('perfilOK', utf8_encode('<p class="msg done">PERFIL ATUALIZADO COM SUCESSO!</p>'));
                    redirect('usuario/editar_perfil/'.$_GET['edit']);
                }
             }else{
                $id['id'] = $_GET['edit'];
                $output = array('pagina'=>'perfil_usuario.php','title'=>'Editar Perfil','query'=>$this->ccm_crud->get_where('usuario',$id));
                $this->_usuario_output($output);
             }
           }
	}
        public function modificar_senha(){
            $this->login_validate->valida_login();
            $this->form_validation->set_rules('senha0','Antiga','required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('senha1','Nova Senha','required|min_length[6]|max_length[32]');
            $this->form_validation->set_message('matches','O campo <b>%s</b> esta diferente de <b>%s</b>!');
            $this->form_validation->set_rules('senha2','Repita sua Nova Senha','required|matches[senha1]');
            if($this->form_validation->run()){
                $dados = elements(array('senha0','senha1','senha2'),$this->input->post());
                $senha = array();
                $senha['senha'] = md5($dados['senha1']);
                $senha_antiga = $this->ccm_model->Busca_senha('usuario',$this->session->userdata('id'));
                foreach ($senha_antiga as $value) {}
                if($value->senha == md5($dados['senha0'])){
                    if($this->ccm_model->Update_DB('usuario',$senha,'id',$this->session->userdata('id'))){
                        $this->session->set_flashdata('msg',utf8_encode('<p class="msg done">Senha atualizada com sucesso!</p>'));
                        redirect('usuario/modificar_senha');
                    }
                }else{
                    $this->session->set_flashdata('msg',utf8_encode('<p class="msg warning">Senha Antiga não confere!</p>'));
                }
            }
            $output = array('pagina'=>'modificar_senha.php','title'=>'Modificar Minha senha','query'=>'');
            $this->_usuario_output($output);
        }
        protected function compara_id($id = NULL){
            if($id == $this->session->userdata('id')){
                return TRUE;
            }
            return false;
        }
}

	
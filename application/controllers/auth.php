<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url','file'));
                $this->load->library(array('form_validation','session'));
		$this->load->database();
                $this->load->model(array('ccm_crud','ccm_model','login_validate'));
		$this->load->library(array('ccm_css_js','form_validation'));
	}
	public function _auth_output($output = null){
		$scripts = new ccm_css_js();
		$output = array(
		'title'=>$output['title'],
		'css'=> $scripts->_css_(),
		'script'=>$scripts->_script_js());
		$this->load->view('auth/index.php',$output);
	}
	public function index()
	{
		$output = array(
		'title'=>'Login',
		);
                if($this->login_validate->valida_login())
                    redirect('usuario');
		$this->_auth_output($output);
	}
        public function login(){
            $this->form_validation->set_rules('usuario','Usuário','required|min_length[6]');
            $this->form_validation->set_rules('senha','Senha','required|min_length[6]');
            if($this->form_validation->run() == TRUE){
                $dados = elements(array('usuario','senha'), $this->input->post());
                $dados['senha'] = md5($dados['senha']);
                $result = $this->ccm_crud->get_user('usuario',$dados);
                if($result['valido']){
                    $this->login_validate->logar($result['dados']);
                    redirect('usuario/home');
                }else{
                    $this->session->set_flashdata('erro',  utf8_encode('<p class="msg warning">Usuário ou senha incorretos!</p>'));
                    $this->index();
                }
            }
            $output = array(
                'title'=>'Login',
		);
            $this->_auth_output($output);
        }
        public function loggoff(){
            $this->login_validate->loggoff();
        }
}
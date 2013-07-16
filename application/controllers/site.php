<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class site extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form'));
		$this->load->database();
		$this->load->library(array('ccm_css_js','form_validation','pagination','validation'));
                $this->load->model(array('ccm_model','ccm_crud','login_validate'));
	}
	public function _site_output($output = null){
		$scripts = new ccm_css_js();
		$output = array(
		'page'=>$output['pagina'],
                'folder'=>'site',
		'title'=>$output['title'],
		'css'=> $scripts->_css_(),
                'folder'=>'site',
                'query'=>$output['query'],
		'script'=>$scripts->_script_js());
		$this->load->view('site.php',$output);
	}
        public function index(){
            /*
            $output = array('pagina'=>'home.php','title'=>'home','query'=>'');
            $this->_site_output($output);
             * 
             */
            $this->noticias_publicas();
        }
        public function noticias_publicas(){
            $inicio = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
            $config['total_rows'] = $this->ccm_model->contaRegistroNoticia('noticias');
            $config['base_url'] = base_url().'site/noticias_publicas/' ;
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
                'pagina'=>'noticias_publicas.php',
                'title'=>'Últimas Noticias',
                'query'=>$this->ccm_model->retorna_noticias_publicas(3,$inicio),
                 );
            $this->_site_output($output);   
        }
        public function cadastro(){
             $this->form_validation->set_rules('nome','Nome','required');
            $this->form_validation->set_message('is_unique','O <b>%s</b> utilizado já está cadastrado no Banco de dados!');
            $this->form_validation->set_rules('email','e-MAIL','required|valid_email|is_unique[usuario.email]');
            $this->form_validation->set_message('is_unique','O <b>%s</b> utilizado já está cadastrado no Banco de dados!');
            $this->form_validation->set_rules('usuario','Usuário','required|min_length[6]|max_length[32]|is_unique[usuario.usuario]');
            $this->form_validation->set_message('matches','O campo <b>%s</b> esta diferente de <b>%s</b>!');
            $this->form_validation->set_rules('usuario2','Repita seu usuário','required|trim|matches[usuario]');
            $this->form_validation->set_rules('senha','Senha','required|min_length[6]|max_length[32]');
            $this->form_validation->set_message('matches','O campo <b>%s</b> esta diferente de <b>%s</b>!');
            $this->form_validation->set_rules('senha2','Repita sua Senha','required|matches[senha]');
            if($this->form_validation->run()){
                $dados = elements(array('nome','email','usuario','senha'), $this->input->post());
                $dados['permissao'] = 'guest';
                $dados['senha'] = md5($dados['senha']);
                if($this->ccm_model->Insert_DB('usuario',$dados)){
                    $this->session->set_userdata('erro',utf8_encode('<p class="msg done">Faça Login para continuar!</p>'));
                    redirect('auth');
                }else{
                    $this->session->set_flashdata('erro',  utf8_encode('<p class="msg warning">Não foi possível efetuar seu cadastro!</p>'));
                    $this->cadastro();
                }
            }
            $output = array('pagina'=>'cadastrar_usuario.php','title'=>'Novo Usuário','query'=>'');
            $this->_site_output($output);
        }
        public function torneios_publicados(){
            $inicio = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
            $config['total_rows'] = $this->ccm_model->contaRegistroNoticia('noticias');
            $config['base_url'] = base_url().'site/noticias_publicas/' ;
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
                'pagina'=>'torneios_publicados.php',
                'title'=>'Últimos torneios',
                'query'=>$this->ccm_model->retorna_torneios_publicados(3,$inicio),
                 );
            $this->_site_output($output);
    }
}
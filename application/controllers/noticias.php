<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class noticias extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url','file','ckeditor'));
                $this->load->library(array('form_validation','session'));
		$this->load->database();
                $this->load->model(array('ccm_model','ccm_crud','login_validate'));
		$this->load->library(array('ccm_css_js','form_validation','validation','file_pgn','pagination'));
	}
	public function _noticias_output($output = null){
            $this->login_validate->valida_login();
		$scripts = new ccm_css_js(); 
		$output = array(
		'page'=>$output['pagina'],
                'folder'=>'noticias',
		'title'=>$output['title'],
		'css'=> $scripts->_css_(),
                'folder'=>'noticias',
                'editor' => $scripts->constroi_editor(),   
                'query'=>$output['query'],
		'script'=>$scripts->_script_js());
		$this->load->view('admin.php',$output);
	}
        public function index(){
            $this->login_validate->valida_login();
            $this->listar_noticias();
        }
        public function listar_noticias(){
            $inicio = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
            $config['total_rows'] = $this->ccm_model->contaRegistro('noticias');
            $config['base_url'] = base_url().'noticias/listar_noticias/' ;
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
                'pagina'=>'listar_noticias.php',
                'title'=>'Noticias Cadastradas',
                'query'=>$this->ccm_model->retornaLista(10,$inicio,'noticias'),
                 );
            $this->pagination->initialize($config);
            $this->_noticias_output($output);
        }
}
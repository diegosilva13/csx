<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class torneios  extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url','file'));
                $this->load->library(array('form_validation','session'));
		$this->load->database();
                $this->load->model(array('ccm_crud','ccm_model','login_validate'));
		$this->load->library(array('ccm_css_js','form_validation','validation','file_pgn','pagination'));
	}
	public function _torneios_output($output = NULL){
		$scripts = new ccm_css_js();
                $output = array(
		'page'=>$output['pagina'],
                'query'=>$output['query'],
                'folder'=>'torneio',
		'title'=>$output['title'],
		'css'=> $scripts->_css_(),
		'script'=>$scripts->_script_js());
		$this->load->view('admin.php',$output);
	}
	public function index(){
            $this->login_validate->valida_login();
            $this->listar_torneios();
	}
        public function listar_torneios(){
            $this->login_validate->valida_login();
            $inicio = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
            $config['total_rows'] = $this->ccm_model->contaRegistroTorneio('torneio');
            $config['base_url'] = base_url().'torneios/listar_torneios/' ;
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
                'pagina'=>'torneios_cadastrados.php',
                'title'=>'Todos os torneios',
                'query'=>$this->ccm_model->retorna_torneios_publicados(10,$inicio),
                 );
            if($this->session->userdata('permissao') == 'admin' || $this->session->userdata('permissao') == 'super')
                $output['query'] = $this->ccm_model->retornaLista(10,$inicio,'torneio');
            $this->_torneios_output($output);
        }
        public function dados_torneio(){
            $this->login_validate->valida_login();
            $id['id'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
             if($id['id']){  
                $query = $this->ccm_crud->get_where('torneio',$id);
                if(!$query){
                    redirect(current_url());
                }  else {
                   $output = array('pagina'=>'dados_torneio.php','title'=>'Dados do torneio','query'=>$query);
                   $this->_torneios_output($output);
                }
             }else{
                 redirect('torneio');
             }
        }
        public function cadastro_torneio(){
            $this->login_validate->valida_login();
            $id['id'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
             if($id['id']){
                 $cad = $this->ccm_model->contCadastro($id['id'],$this->session->userdata('id'));
                 if($cad >= 1){
                     $this->session->set_flashdata('torneioOK',  utf8_encode('<p class="msg warning">Você já se inscreveu nesse torneio!</p>'));
                    redirect('torneios/dados_torneio/'.$id['id']);
                 }else{
                    $dados = array();
                    $dados['id_user'] = $this->session->userdata('id');
                    $dados['id_torneio'] = $id['id'];
                    if($this->ccm_model->Insert_DB('cadastro_torneio',$dados)){
                        $this->session->set_flashdata('torneioOK',utf8_encode('<p class="msg done">Inscrição realizada com sucesso!</p>'));
                        redirect('torneios/dados_torneio/'.$id['id']);
                    }
                 }
             }
        }
        public function descadastro_torneio(){
            $this->login_validate->valida_login();
            $id['id'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
             if($id['id']){
                    $dados = array();
                    $dados['id_user'] = $this->session->userdata('id');
                    $dados['id_torneio'] = $id['id'];
                    if($this->ccm_model->cancelaCadastro($dados['id_user'],$dados['id_torneio'])){
                        $this->session->set_flashdata('torneioOK',utf8_encode('<p class="msg done">Inscrição cancelada com sucesso!</p>'));
                        redirect('torneios/dados_torneio/'.$id['id']);
                    }
                 }
             }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class partida  extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url','file'));
                $this->load->library(array('form_validation','session'));
		$this->load->database();
                $this->load->model(array('ccm_crud','ccm_model','login_validate'));
		$this->load->library(array('ccm_css_js','form_validation','validation','file_pgn','pagination'));
	}
	public function _partida_output($output = NULL){
		$scripts = new ccm_css_js();
                $output = array(
		'page'=>$output['pagina'],
                'query'=>$output['query'],
                'folder'=>'partida',
		'title'=>$output['title'],
		'css'=> $scripts->_css_(),
		'script'=>$scripts->_script_js());
		$this->load->view('admin.php',$output);
	}
	public function index(){
            $this->listar_partida();
	}
        public function partida_pgn(){
            $this->login_validate->valida_login();
		$output =array('pagina'=>'partida_pgn.php','title'=>'Visualizador pgn','query'=>'');
		$this->_partida_output($output);
	}
        public function listar_partida(){
            $this->login_validate->valida_login();
            $dados = elements(array('busca'),$this->input->post());
            $inicio = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
            if(!$dados['busca']){
                $config['total_rows'] = $this->ccm_model->contaRegistro('partida');
                $config['base_url'] = base_url().'partida/listar_partida/' ;
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
                    'pagina'=>'listar_partida.php',
                    'title'=>'Partidas Cadastradas',
                    'query'=>$this->ccm_model->retornaLista(10,$inicio,'partida'),
                     );
            $this->session->set_userdata('lista_partida', $this->ccm_crud->get_all('partida'));    
            $this->pagination->initialize($config);
            $this->_partida_output($output);
            }else{
                $config['total_rows'] = $this->ccm_model->contaRegistro('partida',$dados['busca']);
                $config['base_url'] = base_url().'partida/listar_partida/' ;
                $config['per_page'] = 15;
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
                    'pagina'=>'listar_partida.php',
                    'title'=>'Partidas Cadastradas',
                    'query'=>$this->ccm_model->retornaListaBusca(15,$inicio,$dados['busca']),
                     );
            $this->session->set_userdata('lista_partida',$output['query']);
            $this->pagination->initialize($config);
            $this->_partida_output($output);
            }
        }
        public function upload_pgn(){
            $this->login_validate->valida_login();
            if($this->session->userdata('pgn_path')){
                        unlink($this->session->userdata('pgn_path'));
                        $this->session->unset_userdata('pgn_path');
               }
                $config['upload_path'] = 'assets/uploads/file_view_pgn/';
                $config['file_name'] = $this->session->userdata('id');
		$config['allowed_types'] = 'pgn';
		$config['max_size']	= '10000';
                $this->load->library('upload',$config);
                if(!$this->upload->do_upload()){
                    $this->session->set_flashdata('uploadOK','<p class="msg warning">Erro ao fazer upload! 
                        Verifique o formato do arquivo ou o tamanho e tente novamente!</p>');
                    redirect('partida/partida_pgn');
                }else{
                    $var = $this->upload->data();
                    $this->session->set_userdata('pgn_path',$var['full_path']);
                    $file['userfile'] = base_url().$config['upload_path'].$var['file_name'];
                    $this->session->set_userdata('file_path',$file['userfile']);
                    redirect('partida/partida_pgn');
                }
        }
        public function ver_notacao(){
            $this->login_validate->valida_login();
            $id['id'] = $this->uri->segment(3);
            $arquivo = $this->ccm_crud->get_where('partida',$id);
            $local_file = $this->file_pgn->convert_to_file($arquivo, $this->session->userdata('id'));
            if($local_file){
                $this->session->set_userdata('file_path',base_url().$local_file['locale']);
                $this->session->set_userdata('pgn_path',$local_file['path']);
                redirect('partida/partida_pgn');
            }else{
                redirect(current_url());
            }
        }
        public function baixar_partida(){
            $this->login_validate->valida_login();
            $id['id'] = $this->uri->segment(3);
            $arquivo = $this->ccm_crud->get_where('partida',$id);
            $local_file = $this->file_pgn->convert_to_file($arquivo,  $this->session->userdata('id'));
            $this->session->set_userdata('pgn_path',$local_file['path']);
            if($arquivo){
                 redirect(base_url().$local_file['locale']);
            }else{
                redirect(current_url());
            }
        }
        public function baixar_lista(){
             $this->login_validate->valida_login();
             $arquivo =  $this->session->userdata('lista_partida');
             $local_file = $this->file_pgn->convert_to_file($arquivo,  $this->session->userdata('id'));
             $this->session->set_userdata('pgn_path',$local_file['path']);
             if($arquivo){
                 redirect(base_url().$local_file['locale']);
            }else{
                redirect(current_url());
            }
         }
}
	
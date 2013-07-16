<?php
class admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','ckeditor','file'));
		$this->load->database();
		$this->load->library(array('ccm_css_js','form_validation','pagination','validation','write_html','file_pgn','file_docs'));
                $this->load->model(array('ccm_model','ccm_crud','login_validate'));
	}
	public function _admin_output($output = null){
		$scripts = new ccm_css_js();
		$output = array(
		'page'=>$output['pagina'],
                'folder'=>'usuario',
		'title'=>$output['title'],
		'css'=> $scripts->_css_(),
                'folder'=>$output['folder'],
               'editor' => $scripts->constroi_editor(),
                'query'=>$output['query'],
		'script'=>$scripts->_script_js());
		$this->load->view('admin.php',$output);
	}
        public function index(){
            $this->login_validate->valida_login_admin();
            redirect('usuario');
        }
        public function permissao_usuario(){
            $this->login_validate->valida_login_admin();
            $this->valida_super();
            $id['id'] = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
             if($id['id']){  
                $query = $this->ccm_crud->get_where('usuario',$id);
                if(!$query){
                    $this->session->set_flashdata('usuarioOK',  utf8_encode('<p class="msg warning">Usuário não existe!</p>'));
                    redirect('usuario/listar_usuario');
                }  else {
                   $output = array('pagina'=>'editar_permissao.php','folder'=>'usuario','title'=>'Mudar Permissão','query'=>$query);
                   $this->_admin_output($output);
                }
             }else{
                $dados = elements(array('permissao'), $this->input->post());
                if($_GET['edit'] == $this->session->userdata('id')){
                    $this->session->set_flashdata('usuarioOK',  utf8_encode('<p class="msg warning">Você não pode mudar sua permissão!</p>'));
                    redirect('usuario/listar_usuario');
                }
                if($this->ccm_model->Update_DB('usuario',$dados,'id',$_GET['edit'])){
                    $this->session->set_flashdata('usuarioOK',  utf8_encode('<p class="msg done">Permissão modificada!</p>'));
                    redirect('usuario/listar_usuario');
                }
                $id['id'] = $_GET['edit'];
                $output = array('pagina'=>'editar_permissao.php','folder'=>'usuario','title'=>'Editar Perfil','query'=>$this->ccm_crud->get_where('usuario',$id)->result());
                $this->_admin_output($output);
           }
        }
         
        public function excluir_usuario(){
            $this->login_validate->valida_login_admin();
            $this->valida_super();
            $id = $this->uri->segment(3);
            if(!$this->compara_id($id)){
                 $this->session->set_flashdata('usuarioOK',  utf8_encode('<p class="msg warning">Usuário Logado!</p>'));
                 redirect('usuario/listar_usuario');
            }
            if($this->ccm_model->Delete_user('usuario','id',$id)){
                 $this->session->set_flashdata('usuarioOK','<p class="msg done">Registro excluido com sucesso!</p>');
                 redirect('usuario/listar_usuario');
            }else{
               $this->session->set_flashdata('usuarioOK',  utf8_encode('<p class="msg warning">Você não pode excluir um Super Admin!</p>'));
               redirect('usuario/listar_usuario');
            }
        }
        public function cadastrar_usuario(){
            $this->login_validate->valida_login_admin();
            $this->form_validation->set_rules('nome','Nome','required');
            $this->form_validation->set_message('is_unique','O <b>%s</b> utilizado já está cadastrado no Banco de dados!');
            $this->form_validation->set_rules('email','e-MAIL','required|valid_email|is_unique[usuario.email]');
            $this->form_validation->set_message('is_unique','O <b>%s</b> utilizado já está cadastrado no Banco de dados!');
            $this->form_validation->set_rules('usuario','Usuário','required|min_length[6]|max_length[32]|is_unique[usuario.usuario]');
            $this->form_validation->set_message('matches','O campo <b>%s</b> esta diferente de <b>%s</b>!');
            $this->form_validation->set_rules('usuario2','Repita seu usuário','required|matches[usuario]');
            $this->form_validation->set_rules('senha','Senha','required|min_length[6]|max_length[32]');
            $this->form_validation->set_message('matches','O campo <b>%s</b> esta diferente de <b>%s</b>!');
            $this->form_validation->set_rules('senha2','Repita sua Senha','required|matches[senha]');
            if($this->form_validation->run()){
                $dados = elements(array('nome','email','usuario','senha'), $this->input->post());
                $dados['permissao'] = 'guest';
                $dados['senha'] = md5($dados['senha']);
                if($this->ccm_model->Insert_DB('usuario',$dados)){
                    $this->session->set_flashdata('erro',  utf8_encode('<p class="msg done">Usuário cadastrado com sucesso!</p>'));
                    redirect('admin/cadastrar_usuario');
                }else{
                    $this->session->set_flashdata('erro',  utf8_encode('<p class="msg warning">Não foi possível efetuar seu cadastro!</p>'));
                    redirect('admin/cadastrar_usuario');
                }
            }
            $output = array('pagina'=>'cadastrar_usuario.php','title'=>'Novo Usuário','query'=>'','folder'=>'usuario');
            $this->_admin_output($output);
        }
       public function cadastrar_partida(){
            $this->login_validate->valida_login_admin();
              $this->form_validation->set_rules('notation','notacao','required');
              $this->form_validation->set_rules('plycount','notacao','numeric');
            if($this->form_validation->run()==TRUE){
                $dados = elements(array('event','site','date','round','result','eventdate','eco','plycount','white','black','notation'), $this->input->post());
                $dados = $this->validation->insert_data($dados);
                if($this->ccm_model->Insert_DB('partida',$dados)){
                    $this->session->set_flashdata('partidaOK','PARTIDA CADASTRADA COM SUCESSO');
                    redirect('admin/cadastrar_partida');
                }
            }
            $output = array('pagina'=>'cadastrar_partida.php','title'=>'Cadastre uma partida','query'=>'','folder'=>'partida');
		$this->_admin_output($output);    
        }
         public function cadastrar_pgn(){
             $this->login_validate->valida_login_admin();
                $config['upload_path'] = 'assets/uploads/file_pgn/';
		$config['allowed_types'] = 'pgn';
		$config['max_size']	= '10000';
                $this->load->library('upload',$config);
                if(!$this->upload->do_upload()){
                    $this->session->set_flashdata('uploadOK','<p class="msg warning">Erro ao fazer upload! 
                        Verifique o formato do arquivo ou o tamanho e tente novamente!</p>');
                }else{
                    $var = $this->upload->data();
                    $file['userfile'] = base_url().$config['upload_path'].$var['file_name'];
                    $array = $this->file_pgn->array_transform($file['userfile']);    
                    if($array){
                        for($i=0;$i<count($array);$i++){
                            $this->ccm_model->Insert_DB('partida',$array[$i]);
                        }
                        unlink($var['full_path']);
                        $this->session->set_flashdata('uploadOK','<p class="msg done">Arquivo salvo com sucesso!</p>');
                        redirect('admin/cadastrar_pgn');
                    }else{
                        $this->session->set_flashdata('uploadOK','<p class="msg warning">Seu arquivo PGN esta incorreto, verifique-o!</p>');
                         redirect('admin/cadastrar_pgn');
                    }
                }
            $output = array('pagina'=>'cadastrar_partida.php','title'=>'Partidas PGN','query'=>  '','folder'=>'partida');
            $this->_admin_output($output);
        }
         public function editar_partida(){
            $this->login_validate->valida_login_admin();
            $id['id'] = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
            if($id['id']){  
                $query = $this->ccm_crud->get_where('partida',$id);
                if(!$query){
                    redirect(current_url());
                }  else {
                   $output = array('pagina'=>'editar_partida.php','title'=>'Partidas Cadastradas','query'=>$query,'folder'=>'partida');
                   $this->_admin_output($output);
                }
            }else{
              $this->form_validation->set_rules('notation','notacao','required');
              $this->form_validation->set_rules('plycount','plycount','numeric');
            if($this->form_validation->run()==TRUE){
                $dados = elements(array('event','site','date','round','result','eventdate','eco','plycount','white','black','notation'), $this->input->post());
                $dados = $this->validation->insert_data($dados);
                if($this->ccm_model->Update_DB('partida',$dados,'id',$_GET['edit'])){
                    $this->session->set_flashdata('partidaOK','PARTIDA ATUALIZADA COM SUCESSO');
                    redirect('partida/listar_partida');
                }
            }
            $id['id'] = $_GET['edit'];
            $output = array('pagina'=>'editar_partida.php','title'=>'Atualizar Partida','folder'=>'partida','query'=>$query = $this->ccm_crud->get_where('partida',$id)->result());
            $this->_admin_output($output);
            }
        }
        public function excluir_partida(){
            $this->login_validate->valida_login_admin();
            $id = $this->uri->segment(3);
            if($this->ccm_model->Delete_DB('partida','id',$id)){
                 $this->session->set_flashdata('partidaOK','Registro excluido com sucesso!');
                 redirect('partida/listar_partida');
            }else{
               $output = array('pagina'=>'listar_partida.php','title'=>'Partidas Cadastradas','folder'=>'partida','query'=>$this->ccm_crud->listar('partida')->result());
               $this->_admin_output($output);
            }
        }
        public function cadastrar_noticias(){
            $this->login_validate->valida_login_admin();
            $this->form_validation->set_rules('titulo','TÍTULO','required');
             $this->form_validation->set_rules('texto','TEXTO','required');
            if($this->form_validation->run()==TRUE){
                $dados = elements(array('titulo','texto','publicar','publica','privada'), $this->input->post());
                $dados['autor'] = $this->session->userdata('usuario');
                if($dados['publica'] == '')$dados['publica']  = 'f';
                if($dados['publicar'] == '')$dados['publicar']  = 'f';
                if($dados['privada'] == '')$dados['privada']  = 'f';
                $dados = $this->validation->insert_data($dados);
                if($this->ccm_model->Insert_DB('noticias',$dados)){
                    $this->session->set_flashdata('noticiasOK','<p class="msg done">NOTICIA CADASTRADA COM SUCESSO!</p>');
                    redirect('admin/cadastrar_noticias');
                }
            }
            $output = array('pagina'=>'cadastrar_noticia.php','title'=>'Cadastre uma noticias','query'=>'','folder'=>'noticias');
            $this->_admin_output($output);    
        }
        public function editar_noticia(){
            $this->login_validate->valida_login_admin();
            $id['id'] = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
             if($id['id']){  
                $query = $this->ccm_crud->get_where('noticias',$id);
                if(!$query){
                    redirect('noticias');
                }  else {
                   $output = array('pagina'=>'editar_noticia.php','title'=>'Atualizar perfil','query'=>$query,'folder'=>'noticias');
                   $this->_admin_output($output);
                }
             }else{
             $this->form_validation->set_rules('titulo','TÍTULO','required');
             $this->form_validation->set_rules('texto','TEXTO','required');
              if($this->form_validation->run()==TRUE){ 
                $dados = elements(array('titulo','texto','publicar','publica','privada'), $this->input->post());
                $dados['autor'] = $this->session->userdata('usuario');
                if($dados['publica'] == '')$dados['publica']  = 'f';
                if($dados['publicar'] == '')$dados['publicar']  = 'f';
                if($dados['privada'] == '')$dados['privada']  = 'f';
                $dados = $this->validation->insert_data($dados);
                if($this->ccm_model->Update_DB('noticias',$dados,'id',$_GET['edit'])){
                    $this->session->set_flashdata('noticiaOK','<p class="msg done">NOTICIA ATUALIZADA COM SUCESSO!</p>');
                    redirect('admin/editar_noticia/'.$_GET['edit']);
                }
             }else{
                $id['id'] = $_GET['edit'];
                $output = array('pagina'=>'editar_noticia.php','title'=>'Editar Noticia','query'=>$this->ccm_crud->get_where('noticias',$id),'folder'=>'noticias');
                $this->_admin_output($output);
             }
           }
	}
        public function publicar_noticia(){
            $this->login_validate->valida_login_admin();
             $id['id'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
              $dados = elements(array('publicar'), $this->input->post());
              $dados['publicar'] = 't';
                $dados = $this->validation->insert_data($dados);
                if($this->ccm_model->Update_DB('noticias',$dados,'id',$id['id'])){
                    $this->session->set_flashdata('noticiaOK','<p class="msg done">NOTICIA PUBLICADA COM SUCESSO!</p>');
                    redirect('noticias');
                }else{
                    $this->listar_noticias();
                }
        }
        public function despublicar_noticia(){
            $this->login_validate->valida_login_admin();
            $id['id'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
              $dados = elements(array('publicar'), $this->input->post());
              $dados['publicar'] = 'f';
                $dados = $this->validation->insert_data($dados);
                if($this->ccm_model->Update_DB('noticias',$dados,'id',$id['id'])){
                    $this->session->set_flashdata('noticiaOK','<p class="msg done">NOTICIA DESPUBLICADA COM SUCESSO!</p>');
                    redirect('noticias');
                }else{
                    $this->listar_noticias();
                }
        }
        public function excluir_noticia(){
            $this->login_validate->valida_login_admin();
            $id = $this->uri->segment(3);
            if($this->ccm_model->Delete_DB('noticias','id',$id)){
                 $this->session->set_flashdata('noticiaOK','<p class="msg done">Registro excluido com sucesso!</p>');
                 redirect('noticias/listar_noticias');
            }else{
                $this->listar_noticias();
            }
        }
        public function cadastrar_torneio(){
            $this->login_validate->valida_login_admin();
            $this->form_validation->set_rules('nome','NOME','required');
            $this->form_validation->set_rules('descricao','DESCRIÇÃO','required');
            $this->form_validation->set_rules('encerramento_inscricao','Encerramento das incrições','required');
            if($this->form_validation->run()){
                $dados = elements(array('nome','descricao','publicar','encerramento_inscricao'),$this->input->post());
                $dados['autor'] = 'Postado por: '.$this->session->userdata('usuario');
                $dados = $this->validation->insert_data($dados);
                if($this->ccm_model->Insert_DB('torneio',$dados)){
                    $this->session->set_flashdata('torneioOK','<p class="msg done">TORNEIO CADASTRADO COM SUCESSO!</p>');
                    redirect('admin/cadastrar_torneio');
                }
            }
            $output = array('pagina'=>'cadastrar_torneio.php','title'=>'Novo Campeonato','folder'=>'torneio','query'=>'');
            $this->_admin_output($output);
        }
        public function editar_torneio(){
            $this->login_validate->valida_login_admin();
            $id['id'] = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
             if($id['id']){  
                $query = $this->ccm_crud->get_where('torneio',$id);
                if(!$query){
                    redirect('torneio');
                }  else {
                   $output = array('pagina'=>'editar_torneio.php','title'=>'Atualizar campeonato','query'=>$query,'folder'=>'torneio');
                   $this->_admin_output($output);
                }
             }else{
             $this->form_validation->set_rules('nome','NOME','required');
             $this->form_validation->set_rules('descricao','DESCRIÇÃO','required');
             $this->form_validation->set_rules('encerramento_inscricao','Encerramento das incrições','required');
              if($this->form_validation->run()==TRUE){ 
                $dados = elements(array('nome','descricao','publicar','encerramento_inscricao'),$this->input->post());
                $dados['autor'] = 'Atualizado por: '.$this->session->userdata('usuario');
                $dados = $this->validation->insert_data($dados);
                if($this->ccm_model->Update_DB('torneio',$dados,'id',$_GET['edit'])){
                    $this->session->set_flashdata('torneioOK','<p class="msg done">CAMPEONATO ATUALIZADO COM SUCESSO!</p>');
                    redirect('admin/editar_torneio/'.$_GET['edit']);
                }
             }else{
                $id['id'] = $_GET['edit'];
                $output = array('pagina'=>'editar_torneio.php','title'=>'Editar Campeonato','query'=>$this->ccm_crud->get_where('torneio',$id),'folder'=>'torneio');
                $this->_admin_output($output);
             }
           }
        }
        public function publicar_torneio(){
            $this->login_validate->valida_login_admin();
             $id['id'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
              $dados = elements(array('publicar'), $this->input->post());
              $dados['publicar'] = 't';
                if($this->ccm_model->Update_DB('torneio',$dados,'id',$id['id'])){
                    $this->session->set_flashdata('torneioOK','<p class="msg done">TORNEIO PUBLICADO COM SUCESSO!</p>');
                    redirect('torneios');
                }else{
                    redirect('torneios');
                }
        }
        public function despublicar_torneio(){
            $this->login_validate->valida_login_admin();
             $id['id'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
              $dados = elements(array('publicar'), $this->input->post());
              $dados['publicar'] = 'f';
                if($this->ccm_model->Update_DB('torneio',$dados,'id',$id['id'])){
                    $this->session->set_flashdata('torneioOK','<p class="msg done">TORNEIO DESPUBLICADO COM SUCESSO!</p>');
                    redirect('torneios');
                }else{
                    redirect('torneios');
                }
        }
        public function inscritos_torneio(){
            $this->login_validate->valida_login();
            $id['id'] = $this->uri->segment(3);
            $arquivo = $this->ccm_model->listaInscritos($id['id']); 
            $local_file = $this->file_docs->convert_to_file($arquivo, $this->session->userdata('id'));
            $this->session->set_userdata('pgn_path',$local_file['path']);
            if($arquivo){
                 redirect(base_url().$local_file['locale']);
            }else{
                $this->session->set_flashdata('torneioOK',utf8_encode('<p class="msg warning">Esse torneio não possui usuários cadastrados!</p>'));
                redirect('torneios/listar_torneios');
            }
        }
        public function excluir_torneio(){
            $this->login_validate->valida_login_admin();
            $id = $this->uri->segment(3);
            if($this->ccm_model->Delete_DB('torneio','id',$id)){
                 $this->session->set_flashdata('torneioOK',utf8_encode('<p class="msg done">Registro excluído com sucesso!</p>'));
                 redirect('torneios/listar_torneios');
            }else{
               $output = array('pagina'=>'torneios_cadastrados.php','title'=>'Tornios Cadastradas','folder'=>'torneio','query'=>$this->ccm_crud->listar('partida')->result());
               $this->_admin_output($output);
            }
        }
        protected function compara_id($id = NULL){
            if($id && $id != $this->session->userdata('id')){
                return true;
            }else{
                return false;
            }
        }
        protected function valida_super(){
            if($this->session->userdata('permissao') != 'super'){
                $this->session->set_flashdata('usuarioOK',  utf8_encode('<p class="msg warning">Você não tem permissão para executar essa ação!</p>'));
                redirect('usuario/listar_usuario');
            }
        }
 }

<?php
class write_html{
    public function links_header($logged = NULL,$id = NULL,$usuario = NULL,$permissao = NULL){
        $link = array();
        if($logged){
            $link['user'] = anchor('usuario/editar_perfil/'.$id,$usuario.'('.$permissao.')');
            $link['logout'] = anchor('auth/loggoff', 'Log out','id="logout"');
        }else{
            $link['user'] = '---';
            $link['logout'] = anchor('auth', 'Login','id="logout"');
        }
        return $link;
    }
    public function acoes_usuario($id_logged = NULL, $id = NULL , $permissao = NULL){
        if($permissao == 'guest' || $permissao == 'admin'){
            $link = anchor('usuario/ver_usuario/'.$id,'<i class="icon-eye-open"></i>&nbsp;Ver');
            if($id == $id_logged){
                $link.='&nbsp|&nbsp';
                $link.=anchor('usuario/editar_perfil/'.$id,'<i class="icon-edit"></i>&nbsp;Meus dados');
            }
            return $link;
        }
        if($permissao == 'super'){
            $link = anchor('usuario/ver_usuario/'.$id,'<i class="icon-eye-open"></i>&nbsp;Ver');
            if($id == $id_logged){
                $link.='&nbsp|&nbsp';
                $link.=anchor('usuario/editar_perfil/'.$id,'<i class="icon-edit"></i>&nbsp;Meus dados');
            }else{
                $link.='&nbsp|&nbsp';
                $link.=anchor('admin/permissao_usuario/'.$id,'<i class="icon-edit"></i>&nbsp;Mudar permissao de usuario');
                $link.='&nbsp|&nbsp';
                $link.=anchor('admin/excluir_usuario/'.$id,'<i class="icon-trash"></i>&nbsp;Excluir',"onClick=\" return confirm('Certeza que quer excluir o registro '
            + ' $id pemanentemente ?')\"");;
            }
        return $link;
        }
    }
    public function cadastro_usuario($permissao = NULL){
         $cadastro = '';
        if($permissao == 'admin' || $permissao == 'super'){
            $cadastro.=anchor('admin/cadastrar_usuario','<i class="icon-plus"></i>Cadastrar usuario','class="btn btn-small"');
         return $cadastro;  
        }
    }
    public function acoes_partida($id_logged = NULL, $id = NULL , $permissao = NULL){
        if ($permissao == 'guest'){
            $link = anchor('partida/ver_notacao/'.$id,'<i class="icon-eye-open"></i>&nbsp;Ver');
            $link.= '&nbsp;|&nbsp';
            $link.= anchor('partida/baixar_partida/'.$id,'<i class="icon-download-alt"></i>&nbsp;Baixar');
            return $link;
        }  else {
            $link = anchor('partida/ver_notacao/'.$id,'<i class="icon-eye-open"></i>&nbsp;Ver');
            $link.= '&nbsp;|&nbsp';
            $link.= anchor('admin/editar_partida/'.$id,'<i class="icon-edit"></i>&nbsp;Editar'); 
            $link.= '&nbsp;|&nbsp';
            $link.= anchor('partida/baixar_partida/'.$id,'<i class="icon-download-alt"></i>&nbsp;Baixar');
            $link.= '&nbsp;|&nbsp';
            $link.= anchor('admin/excluir_partida/'.$id,'<i class="icon-trash"></i>&nbsp;Excluir',"onClick=\" return confirm('Certeza que quer excluir o registro '
        + ' $id pemanentemente ?')\"");
            return $link;
        }
    }
    public function acoes_noticia($permissao = NULL, $id = NULL, $publicar = NULL){
        if($permissao == 'admin' || $permissao == 'super'){
            $link = anchor('admin/editar_noticia/'.$id,'<i class="icon-edit"></i>&nbsp;Editar');
            $link.='&nbsp;|&nbsp;';
            if($publicar == 't'){
                $link.=anchor('admin/despublicar_noticia/'.$id,'<i class="icon-ok"></i>&nbsp;Despublicar').'&nbsp;|&nbsp';
            }else{
                $link.=anchor('admin/publicar_noticia/'.$id,'<i class="icon-ok"></i>&nbsp;Publicar').'&nbsp;|&nbsp';
            }
            $link.=anchor('admin/excluir_noticia/'.$id,'<i class="icon-trash"></i>&nbsp;Excluir',"onClick=\" return confirm('Certeza que quer excluir o registro '
        + ' $id pemanentemente ?')\"");
            return $link;
        }
    }
    public function acoes_aside($permissao = NULL){
        $link = array();
        if($permissao == 'admin' || $permissao == 'super'){
           $link['jogador'] = '<li>'.anchor('admin/cadastrar_usuario', 'Cadastrar usuário<i class="icon-pencil"></i>').'</li>';
           $link['jogador'].= '<li>'.anchor('usuario/listar_usuario','Gerenciar jogadores<i class="icon-th-list"></i>').'</li>';
           $link['torneio'] ='<li>'.anchor('admin/cadastrar_torneio', 'Cadastrar torneio<i class="icon-pencil"></i>').'</li>';;
           $link['torneio'].= '<li>'.anchor('torneios/listar_torneios','Gerenciar torneios<i class="icon-th-list"></i>').'</li>';
           $link['partida'] = '<li>'.anchor('partida/partida_pgn','Visualizador PGN <i class="icon-eye-open"></i>').'</li>';
           $link['partida'].='<li>'.anchor('admin/cadastrar_partida','Cadastrar partida <i class="icon-edit"></i>').'</li>';
           $link['partida'].= '<li>'.anchor('partida/listar_partida','Gerenciar partidas<i class="icon-th-list"></i>').'</li>';
           $link['noticias'] = '<li>'.anchor('admin/cadastrar_noticias', 'Nova Noticia <i class="icon-pencil"></i>').'</li>';
           $link['noticias'].= '<li>'.anchor('noticias', 'Gerenciar noticias <i class="icon-th-list"></i>').'</li>';
           }else{
            $link['jogador'] = '<li>'.anchor('usuario/listar_usuario','Jogadores Cadastrados<i class="icon-th-list"></i>').'</li>';
            $link['partida'] = '<li>'.anchor('partida/partida_pgn','Visualizador PGN <i class="icon-eye-open"></i>').'</li>';
            $link['torneio'] = '<li>'.anchor('torneios/listar_torneios','Torneios publicados<i class="icon-th-list"></i>').'</li>';
            $link['partida'].= '<li>'.anchor('partida/listar_partida','Ver partidas<i class="icon-th-list"></i>').'</li>';        
        }
        return $link;
    }
    public function acoes_torneio($permissao = NULL, $publicar = NULL, $id = NULL){
        if($permissao == 'admin' || $permissao == 'super'){
            $link = anchor('admin/inscritos_torneio/'.$id,'<i class="icon-eye-open"></i>&nbsp;Ver Participantes');
            $link.='&nbsp;|&nbsp;';
            $link.= anchor('admin/editar_torneio/'.$id,'<i class="icon-edit"></i>&nbsp;Editar');
            $link.='&nbsp;|&nbsp;';
             $link.= anchor('torneios/dados_torneio/'.$id,'<i class="icon-edit"></i>&nbsp;Increver');
            $link.='&nbsp;|&nbsp;';
            if($publicar == 't'){
                $link.=anchor('admin/despublicar_torneio/'.$id,'<i class="icon-ok"></i>&nbsp;Despublicar').'&nbsp;|&nbsp';
            }else{
                $link.=anchor('admin/publicar_torneio/'.$id,'<i class="icon-ok"></i>&nbsp;Publicar').'&nbsp;|&nbsp';
            }
            $link.=anchor('admin/excluir_torneio/'.$id,'<i class="icon-trash"></i>&nbsp;Excluir',"onClick=\" return confirm('Certeza que quer excluir o registro '
        + ' $id pemanentemente ?')\"");
            return $link;
        }else{
             $link = anchor('torneios/dados_torneio/'.$id,'<i class="icon-eye-open"></i>&nbsp;Ver');
             $link.='&nbsp;|&nbsp;';
             $link.= anchor('torneios/dados_torneio/'.$id,'<i class="icon-edit"></i>&nbsp;Increver');
             return $link;
        }
        
    }
    public function acoes_aside_site($is_logged = NULL){
        if($is_logged){
            $link['jogador'] = '<li>'.anchor('admin/cadastrar_usuario', 'Cadastrar usuário<i class="icon-pencil"></i>').'</li>'; 
        }
        
    }
}

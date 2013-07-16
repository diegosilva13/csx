<?php 
class file_docs{
public function convert_to_file($arquivo = NULL,$id){
            $path = FCPATH;
            $name = $id.'.doc';
            $local = array();
            $local['locale'] = 'assets/docs/'.$name;
            $file = fopen($path.$local['locale'], 'w+');
            $local['path'] = $path.$local['locale'];
            if($file){
                if($arquivo){
                    fwrite($file,"USUÁRIOS CADASTRADOS");
                    fwrite($file,"\n\n\n");
                    foreach ($arquivo as $value) {
                        fwrite($file,"ID: ".$value->id);
                        fwrite($file,"\n");
                        fwrite($file,"Nome: ".$value->nome);
                        fwrite($file,"\n");
                        fwrite($file,"E-mail: ".$value->email);
                        fwrite($file,"\n");
                        fwrite($file,"Telefone: ".$value->telefone);
                        fwrite($file,"\n\n");
                    }
                    return $local;
                }
            }else{
                return FALSE;
            }
            
        }
}
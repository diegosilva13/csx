<?php
class file_pgn{
    protected $string_pgn;
    private function read_string_pgn($file_pointer = NULL,$linha = NULL){
        while(true){
            if($linha == NULL)
                break;
            $this->string_pgn.= $linha;
            $linha = fgets($file_pointer);
        }
        return $linha;
    }
    private function read_file_pgn($file_pgn = NULL){
        $file = fopen($file_pgn,'r');
        if($file){
            $linha = fgets($file);
            $this->read_string_pgn($file,$linha);
            fclose($file);
        }else{
            fclose($file);
            echo '<hr/>Erro ao abrir ou ler arquivo!<hr/>';
        }
    }
    public function array_transform($file_pgn = NULL){
        $this->read_file_pgn($file_pgn);
        $size = strlen($string = $this->string_pgn);
        $key = $value = $notation = "";
        $partida = 0;
        $pgn_array = $array = array();
        for($i=0;$i<$size;$i++){
            if($string[$i] == '['){
                $i++;
                while($string[$i] != '"'){
                    $key.= $string[$i];
                    $i++;
                }
                if($string[$i] == '"'){
                   $i++;
                   while($string[$i] != '"'){
                    $value.= $string[$i];
                    $i++;
                    }
                }
                $pgn_array[$key] = $value;
                $key = $value = "";
            }
                if($string[$i] == '1' && $string[$i+1] == '.'){
                    $bool = true;
                    while($bool){
                        $notation.= $string[$i];
                        if($string[$i-1] == '-' && $string[$i] == '0' && ($string[$i-2] == '1')){
                            $pgn_array['notation'] = $notation;
                            $array[$partida++] = $pgn_array;
                            $pgn_array = null;
                            $bool = false;
                        }
                        if($string[$i-1] == '-' && $string[$i] == '1' && ($string[$i-2] == '0')){
                            $pgn_array['notation'] = $notation;
                            $array[$partida++] = $pgn_array;
                            $pgn_array = null;
                            $bool = false;
                        }
                        if($string[$i-1] == '/' && $string[$i] == '2'){
                            $notation.= '-'.$string[$i-2].$string[$i-1].$string[$i];
                            $pgn_array['notation'] = $notation;
                            $array[$partida++] = $pgn_array;
                            $pgn_array = null;
                            $bool = false; 
                        }
                        $i++;
                    }
                }
                $notation = "";
            
            }
            return $array;
        }
        public function convert_to_file($arquivo = NULL,$id){
            $path = FCPATH;
            $name = $id.'.pgn';
            $local = array();
            $local['locale'] = 'assets/pgn/'.$name;
            $file = fopen($path.$local['locale'], 'w+');
            $local['path'] = $path.$local['locale'];
            if($file){
                if($arquivo){
                    foreach ($arquivo as $value) {
                        fwrite($file, '[Event "'.$value->event.'"]'."\n");
                        fwrite($file, '[Site "'.$value->site.'"]'."\n");
                        fwrite($file, '[Date "'.$value->date.'"]'."\n");
                        fwrite($file, '[Round "'.$value->round.'"]'."\n");
                        fwrite($file, '[White "'.$value->white.'"]'."\n");
                        fwrite($file, '[Black "'.$value->black.'"]'."\n");
                        fwrite($file, '[Eco "'.$value->eco.'"]'."\n");
                        fwrite($file, '[PlyCount "'.$value->plycount.'"]'."\n");
                        fwrite($file, '[EventDate "'.$value->eventdate.'"]'."\n");
                        fwrite($file, $value->notation."\n\n\n");
                        
                    }
                    return $local;
                }
            }else{
                return FALSE;
            }
            
        }
}
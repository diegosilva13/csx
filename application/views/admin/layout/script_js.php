<script>  
        new PgnViewer(  
          { boardName: "demo",  
              pgnFile: "<?php  echo ($this->session->userdata('file_path')) ? $this->session->userdata('file_path') : "";?>",
              pgnString:"<?php  echo ($this->session->userdata('string')) ? $this->session->userdata('string') : "";?>" ,
            pieceSet: 'leipzig',   
            pieceSize: 46  
          }  
        );  
</script>

<?php
$this->session->unset_userdata('file_path');
if($this->session->userdata('pgn_path')){
    unlink($this->session->userdata('pgn_path'));
    $this->session->unset_userdata('pgn_path');
}
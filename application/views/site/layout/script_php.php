<?php
$this->session->unset_userdata('file_path');
if($this->session->userdata('file')){
    unlink($this->session->userdata('file'));
    $this->session->unset_userdata('file');
}
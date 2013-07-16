<?php
$this->load->view('admin/layout/head.php');
$this->load->view('admin/layout/header.php');
$this->load->view('admin/layout/aside.php');
$this->load->view('admin/layout/start_content.php');
$this->load->view('admin/page/'.$folder.'/'.$page);
$this->load->view('admin/layout/end_content.php');
$this->load->view('admin/layout/footer.php');
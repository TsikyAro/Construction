<?php

$this->load->view('template/Header');

$this->load->view('template/NavBar_admin');

$this->load->view($page, $data);

$this->load->view('template/Footer');
?>
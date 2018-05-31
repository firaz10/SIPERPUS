<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
   class pengembalian extends CI_Controller {
     public function index(){
       $this->load->view('header');
       $this->load->view('pengembalian');
       $this->load->view('footer');
     }
   }
 ?>

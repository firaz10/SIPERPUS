<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
   class hal_utama extends CI_Controller {
     function __construct()
      {
        parent::__construct();
        $this->load->model('m_login');
      }
     public function index(){
       
       $session = $this->session->userdata('log_in');
       $level = $this->session->userdata('level');
       if ($session == FALSE) {
         $this->load->view('login');
       }
       else {
         redirect(base_url('hal_user'));
       }
     }
     function login()
     {
       $username = $this->input->post('username');
       $password = $this->input->post('password');
       $cek = $this->m_login->cek_user($username, $password);
       if (count($cek)==1) {
         $user_login = array('log_in' => TRUE,
                              'username'=>$username);
        $this->session->set_userdata($user_login);
         $level = $this->session->userdata('level');
          redirect (base_url('hal_user'));
       }
       else {
         $this->session->set_flashdata('notif','Maaf, username atau password yang anda masukan salah atau belum terdaftar');
         redirect (base_url('hal_utama'));
       }
     }
     public function logout()
     {
       $this->session->sess_destroy();
       redirect(base_url('hal_utama'));
     }
   }

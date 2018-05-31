<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
   class kel_anggota extends CI_Controller {
     function __construct()
      {
        parent::__construct();
        $this->load->model('m_anggota');
        $this->load->model('m_pengembalian');
        $this->load->model('m_login');
        $this->load->model('m_peminjaman');
      }
     public function index(){
       $session = $this->session->userdata('log_in');
       if ($session == TRUE) {
       $user_akun  = $this->m_login->ambilUser($this->session->userdata('username'));
       $data['user'] = $user_akun;
       $where = array('status' => '0' );
       $peminjaman = $this->m_peminjaman->hitung($where);
       $kembali = $this->m_pengembalian->hitung();
       $data['pinjam']= count($peminjaman);
       $data['kembali']= count($kembali);
       $this->load->view('header',$data);
       $data['anggota'] = $this->m_anggota->select();
       $this->load->view('kel_anggota', $data);
       $this->load->view('footer');
     }
     else {
       redirect(base_url('hal_utama'));
     }
     }
     function tamUser(){
       $nmfile = "file_".time();
       $config['upload_path'] = './assets/images/';
       $config['allowed_types'] = 'jpg|png|jpeg|bmp';
       $config['max_size'] = '5000';
       $config['file_name'] = $nmfile;
       $this->upload->initialize($config);
       if ($_FILES['foto']['name']) {
         if ($this->upload->do_upload('foto')) {
           $gbr = $this->upload->data();
         }
         else {
           print_r($this->upload->display_errors());
         }
       }
       $data = array(
            'username' =>$this->input->post('username') ,
            'password' =>$this->input->post('passbaru') ,
            'level' =>$this->input->post('level') ,
            'nama' =>$this->input->post('nama') ,
            'alamat' =>$this->input->post('alamat') ,
            'tgl_lahir' =>$this->input->post('tgl_lahir') ,
            'telp' =>$this->input->post('telp') ,
            'foto' =>$gbr['file_name']
       );
       $this->m_anggota->insert($data);
       redirect('kel_anggota', 'refresh');
     }
     function edUser(){
       $id_user = $this->input->post('id_user');
       if ( $this->input->post('foto')!=null) {
         $nmfile = "file_".time();
         $config['upload_path'] = './assets/images/';
         $config['allowed_types'] = 'jpg|png|jpeg|bmp';
         $config['max_size'] = '5000';
         $config['file_name'] = $nmfile;
         $this->upload->initialize($config);
         if ($_FILES['foto']['name']) {
           if ($this->upload->do_upload('foto')) {
             $gbr = $this->upload->data();
           }
           else {
             print_r($this->upload->display_errors());
           }
         }
         $data = array(
           'username' =>$this->input->post('username') ,
           'password' =>$this->input->post('passbaru2') ,
           'level' =>$this->input->post('level') ,
           'nama' =>$this->input->post('nama') ,
           'alamat' =>$this->input->post('alamat') ,
           'tgl_lahir' =>$this->input->post('tgl_lahir') ,
           'telp' =>$this->input->post('telp') ,
           'foto' =>$gbr['file_name']
         );
       }

       $data = array(
         'username' =>$this->input->post('username') ,
         'password' =>$this->input->post('passbaru2') ,
         'level' =>$this->input->post('level') ,
         'nama' =>$this->input->post('nama') ,
         'alamat' =>$this->input->post('alamat') ,
         'tgl_lahir' =>$this->input->post('tgl_lahir') ,
         'telp' =>$this->input->post('telp')
       );
       $where = array ('id_user'=>$id_user);
       $this->m_anggota->update($data, $where);
       redirect('kel_anggota','refresh');
     }
     function hapUser(){
       $id_user = $this->input->get('id');
       $where = array('id_user' => $id_user );
       $this->m_anggota->delete($where);
       redirect('kel_anggota','refresh');
     }
   }
 ?>

<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
   class kel_pengembalian extends CI_Controller {
     function __construct()
      {
        parent::__construct();
        $this->load->model('m_pengembalian');
        $this->load->model('m_peminjaman');
        $this->load->model('m_login');
        $this->load->model('m_buku');
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
       $data['pengembalian'] = $this->m_pengembalian->select();
       $this->load->view('kel_pengembalian', $data);
       $this->load->view('footer');
     }
     else {
       redirect(base_url('hal_utama'));
     }
     }
     function hapPengembalian(){
       $id_pengembalian = $this->input->post('id_pengembalian');
       $where = array('id_pengembalian' => $id_pengembalian );
       $this->m_pengembalian->delete($where);
       $id_buku = $this->input->post('id_buku');
       $where = $id_buku;
       $this->m_buku->hapusdipinjam($where);
       redirect('kel_pengembalian','refresh');
     }
     function proses(){
       $id_pengembalian = $this->input->post('id_pengembalian');
       $where = array ('id_pengembalian'=>$id_pengembalian);
       $this->m_pengembalian->proses($where);
       redirect('kel_pengembalian','refresh');
     }
     function hilang(){
       $id_pengembalian = $this->input->post('id_pengembalian');
       $where = array ('id_pengembalian'=>$id_pengembalian);
       $this->m_pengembalian->hilang($where);
       redirect('kel_pengembalian','refresh');
     }
   }
 ?>

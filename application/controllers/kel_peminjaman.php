<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
   class kel_peminjaman extends CI_Controller {
     function __construct()
      {
        parent::__construct();
        $this->load->model('m_peminjaman');
        $this->load->model('m_pengembalian');
        $this->load->model('m_login');
        $this->load->model('m_buku');
        $this->load->model('m_anggota');
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
       $data['peminjaman'] = $this->m_peminjaman->select();
       $data['anggota'] = $this->m_anggota->select();
       $data['buku'] = $this->m_buku->select();
       $this->load->view('kel_peminjaman', $data);
       $this->load->view('footer');
     }
     else {
       redirect(base_url('hal_utama'));
     }
     }
     function hapPeminjaman(){
       $id_peminjaman = $this->input->post('id_pinjaman');
       $where = array('id_pinjaman' => $id_peminjaman );
       $data = array('status' => '5' );
       $this->m_peminjaman->update($data, $where);
       $id_buku = $this->input->post('id_buku');
       $where = $id_buku;
       $this->m_buku->hapusdipinjam($where);
       redirect('kel_peminjaman','refresh');
     }
     function hapPeminjamanUser(){
       $id_peminjaman = $this->input->post('id_pinjaman');
       $where = array('id_pinjaman' => $id_peminjaman );
       $data = array('status' => '5' );
       $this->m_peminjaman->update($data, $where);
       $id_buku = $this->input->post('id_buku');
       $where = $id_buku;
       $this->m_buku->hapusdipinjam($where);
       redirect('peminjaman','refresh');
     }
     function proses(){
       $id_pinjaman = $this->input->post('id_pinjaman');
       $sekarang = date('Y-m-d');
       $tgl_proses = strtotime($sekarang);
       $tgl_baru = strtotime("+7 days", $tgl_proses);
       $tgl_kembali = date('Y-m-d', $tgl_baru);
       $data = array(
            'id_pinjaman' =>$this->input->post('id_pinjaman') ,
            'tgl_kembali' =>$tgl_kembali ,
            'status_kem' =>'0'
       );
       $where = array ('id_pinjaman'=>$id_pinjaman);
       $this->m_peminjaman->proses($data, $where);
       redirect('kel_peminjaman','refresh');
     }
   }
 ?>

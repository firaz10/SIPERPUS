<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
   class hal_user extends CI_Controller {
     function __construct()
      {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_peminjaman');
        $this->load->model('m_pengembalian');
        $this->load->model('m_anggota');
        $this->load->model('m_buku');
      }
     public function index(){
       $session = $this->session->userdata('log_in');
      if ($session == TRUE) {
       $user_akun  = $this->m_login->ambilUser($this->session->userdata('username'));
       $data['user'] = $user_akun;
       $id_user = $user_akun['id_user'];
       $where = array('status' => '0' );
       $peminjaman = $this->m_peminjaman->hitung($where);
       $kembali = $this->m_pengembalian->hitung();
       $data['pinjam']= count($peminjaman);
       $data['kembali']= count($kembali);
       $this->load->view('header',$data);
       if ($user_akun['level']=='admin') {
         $buku = $this->m_buku->select();
         $data['buku']= count($buku);
         $anggota = $this->m_anggota->select();
         $data['anggota']= count($anggota);
         $pinjam = $this->m_peminjaman->select();
         $data['injam']= count($pinjam);
         $balik = $this->m_pengembalian->select();
         $data['balik']= count($balik);
         $data['statistik'] =$this->m_peminjaman->statistik();
         $this->load->view('hal_admin',$data);
       }
       else {
         $buku = $this->m_buku->select();
         $data['buku']= count($buku);
         $anggota = $this->m_anggota->select();
         $data['anggota']= count($anggota);
         $pinjam = $this->m_peminjaman->select($id_user);
         $data['injam']= count($pinjam);
         $balik = $this->m_pengembalian->select($id_user);
         $data['balik']= count($balik);
         $data['statistik'] =$this->m_peminjaman->statistik();
         $this->load->view('hal_anggota',$data);
       }
       $this->load->view('footer');
      }
      else {
        redirect(base_url('hal_utama'));
      }
     }
   }
 ?>

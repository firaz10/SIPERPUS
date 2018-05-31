<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
   class daftar_buku extends CI_Controller {
     function __construct()
      {
        parent::__construct();
        $this->load->model('m_buku');
        $this->load->model('m_login');
        $this->load->model('m_peminjaman');
        $this->load->model('m_pengembalian');
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
       $id_user = array('id_user'=>$user_akun['id_user'], 'status'=>'0');
       $statuspinjam = $this->m_peminjaman->hitung($id_user);
       $id_user = $user_akun['id_user'];
       $statuskembali = $this->m_pengembalian->hitungstat($id_user);
       $data['statuspinjam'] = count($statuspinjam);
       $data['statuskembali'] =  count($statuskembali);
       $data['buku'] = $this->m_buku->select();
       $data['prose'] = $this->m_buku->terproses();
       $this->load->view('daftar_buku', $data);
       $this->load->view('footer');
     }
     else {
       redirect(base_url('hal_utama'));
     }
     }
     function pinjam(){
       $id_buku = $this->input->post('id_buku');
       $sekarang = date('Y-m-d');
       $tgl_proses = strtotime($sekarang);
       $tgl_baru = strtotime("+7 days", $tgl_proses);
       $tgl_kembali = date('Y-m-d', $tgl_baru);
       $data = array(
            'id_buku' =>$this->input->post('id_buku') ,
            'id_user' =>$this->input->post('id_user') ,
            'tgl_pinjam' =>$sekarang ,
            'tgl_proses' =>'0000-00-00' ,
            'status' =>'0'
       );
       $where = $id_buku;
       $this->m_buku->tambahdipinjam($where);
       $this->m_peminjaman->insert($data);
       redirect('daftar_buku','refresh');
     }
     function hapPinjam(){
       $id_buku = $this->input->get('id');
       $where = array('id_buku' => $id_buku );
       $this->m_buku->delete($where);
       redirect('kel_buku','refresh');
     }
     function search_keyword()
    {
        $keyword    =   $this->input->post('keyword');
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
        $id_user = array('id_user'=>$user_akun['id_user'], 'status'=>'0');
        $statuspinjam = $this->m_peminjaman->hitung($id_user);
        $id_user = $user_akun['id_user'];
        $statuskembali = $this->m_pengembalian->hitungstat($id_user);
        $data['statuspinjam'] = count($statuspinjam);
        $data['statuskembali'] =  count($statuskembali);
        $data['buku']    =   $this->m_buku->search($keyword);
        $data['prose'] = $this->m_buku->terproses();
        $this->load->view('daftar_buku', $data);
        $this->load->view('footer');
    }else {
      redirect(base_url('hal_utama'));
    }
  }}

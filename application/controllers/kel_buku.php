<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
   class kel_buku extends CI_Controller {
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
       $data['buku'] = $this->m_buku->select();
       $this->load->view('kel_buku', $data);
       $this->load->view('footer');
     }
     else {
       redirect(base_url('hal_utama'));
     }
     }
     function tamBuku(){
       $nmfile = "file_".time();
       $config['upload_path'] = './assets/images/buku/';
       $config['allowed_types'] = 'jpg|png|jpeg|bmp';
       $config['max_size'] = '5000';
       $config['file_name'] = $nmfile;
       $this->upload->initialize($config);
       if ($_FILES['sampul']['name']) {
         if ($this->upload->do_upload('sampul')) {
           $gbr = $this->upload->data();
         }
         else {
           print_r($this->upload->display_errors());
         }
       }
       $data = array(
            'judul_buku' =>$this->input->post('judul_buku') ,
            'jenis_buku' =>$this->input->post('jenis_buku') ,
            'penerbit' =>$this->input->post('penerbit') ,
            'tahun' =>$this->input->post('tahun') ,
            'tempat' =>$this->input->post('tempat') ,
            'sampul' =>$gbr['file_name'] ,
            'sinopsis' =>$this->input->post('sinopsis') ,
            'jumlah' =>$this->input->post('jumlah'),
            'pengarang' =>$this->input->post('pengarang')
       );
       $this->m_buku->insert($data);
       redirect('kel_buku', 'refresh');
     }
     function edBuku(){
       $id_buku = $this->input->post('id_buku');
       if ( $this->input->post('sampul')!=null) {
         $nmfile = "file_".time();
         $config['upload_path'] = './assets/images/';
         $config['allowed_types'] = 'jpg|png|jpeg|bmp';
         $config['max_size'] = '5000';
         $config['file_name'] = $nmfile;
         $this->upload->initialize($config);
         if ($_FILES['sampul']['name']) {
           if ($this->upload->do_upload('sampul')) {
             $gbr = $this->upload->data();
           }
           else {
             print_r($this->upload->display_errors());
           }
         }
         $data = array(
              'judul_buku' =>$this->input->post('judul_buku') ,
              'jenis_buku' =>$this->input->post('jenis_buku') ,
              'penerbit' =>$this->input->post('penerbit') ,
              'tahun' =>$this->input->post('tahun') ,
              'tempat' =>$this->input->post('tempat') ,
              'sampul' =>$gbr['file_name'] ,
              'sinopsis' =>$this->input->post('sinopsis') ,
              'jumlah' =>$this->input->post('jumlah'),
              'pengarang' =>$this->input->post('pengarang')
         );
       }

       $data = array(
            'judul_buku' =>$this->input->post('judul_buku') ,
            'jenis_buku' =>$this->input->post('jenis_buku') ,
            'penerbit' =>$this->input->post('penerbit') ,
            'tahun' =>$this->input->post('tahun') ,
            'tempat' =>$this->input->post('tempat') ,
            'sinopsis' =>$this->input->post('sinopsis') ,
            'jumlah' =>$this->input->post('jumlah'),
            'pengarang' =>$this->input->post('pengarang')
       );
       $where = array ('id_buku'=>$id_buku);
       $this->m_buku->update($data, $where);
       redirect('kel_buku','refresh');
     }
     function hapBuku(){
       $id_buku = $this->input->get('id');
       $where = array('id_buku' => $id_buku );
       $this->m_buku->delete($where);
       redirect('kel_buku','refresh');
     }
   }
 ?>

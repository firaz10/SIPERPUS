<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class m_pengembalian extends CI_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->table="pengembalian";
    }
    function select($where = null){
      if ($where !=null) {
        $this->db->where($where);
      }
      $tgl_sekarang = date('Y-m-d');
      $sql = "SELECT * from pengembalian inner join peminjaman inner join anggota inner join buku on (peminjaman.id_user=anggota.id_user AND peminjaman.id_buku=buku.id_buku) GROUP by pengembalian.id_pengembalian";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function hitung(){
      $tgl_sekarang = date('Y-m-d');
      $sql = "SELECT  * from pengembalian WHERE DATEDIFF('".$tgl_sekarang."', tgl_kembali)>7 AND status_kem='0'";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function hitungstat($where){
      $sql = "SELECT * from pengembalian inner join peminjaman inner join anggota inner join buku on (peminjaman.id_user=anggota.id_user AND peminjaman.id_buku=buku.id_buku) WHERE peminjaman.id_user='".$where."' AND status_kem='0'";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function proses($where){
      $this->db->where($where);
      $status = array('status_kem' => '1');
      $this->db->update("$this->table", $status);
    }
    function hilang($where){
      $this->db->where($where);
      $status = array('status_kem' => '5');
      $this->db->update("$this->table", $status);
    }
    function delete($where){
      $this->db->where($where);
      $this->db->delete($this->table);
    }
  }

 ?>

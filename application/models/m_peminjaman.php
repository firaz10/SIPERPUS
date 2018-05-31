<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class m_peminjaman extends CI_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->table="peminjaman";
    }
    function select($where = null){
      if ($where !=null) {
        $this->db->where($where);
      }
      $sql = "SELECT * from peminjaman inner join anggota inner join buku on (peminjaman.id_user=anggota.id_user AND peminjaman.id_buku=buku.id_buku)";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function hitung($where = null){
      if ($where !=null) {
        $this->db->where($where);
      }
      $query=$this->db->get($this->table);
      return $query->result_array();
    }
    function insert($data){
      $this->db->insert($this->table, $data);
    }
    function proses($data, $where){
      $this->db->where($where);
      $tgl_sekarang = date('Y-m-d');
      $status = array('status' => '1','tgl_proses'=>$tgl_sekarang);
      $this->db->update("$this->table", $status);
      $this->db->insert("pengembalian", $data);
    }
    function delete($where){
      $this->db->where($where);
      $this->db->delete($this->table);
    }
    function statistik(){
      $sql = "SELECT judul_buku, count(judul_buku) AS jumlah from peminjaman inner join buku on (peminjaman.id_buku=buku.id_buku) GROUP by judul_buku limit 5";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function update($data, $where){
      $this->db->where($where);
      $this->db->update($this->table, $data);
    }
  }

 ?>

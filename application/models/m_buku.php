<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class m_buku extends CI_Model
  {

    function __construct()
    {
      parent::__construct();
      $this->table="buku";
    }
    function select($where =null){
      if ($where !=null) {
        $this->db->where($where);
      }
      $sql = "SELECT * FROM  buku ";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function select2($where =null){
      if ($where !=null) {
        $this->db->where($where);
      }
      $sql = "SELECT *,COUNT(buku.judul_buku) AS stok FROM peminjaman inner join buku INNER JOIN pengembalian ON (buku.id_buku=peminjaman.id_buku AND peminjaman.id_pinjaman=pengembalian.id_pinjaman) Group by buku.id_buku";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function terproses($where =null){
      if ($where !=null) {
        $this->db->where($where);
      }
      $sql = "SELECT buku.id_buku, COUNT(buku.judul_buku) AS stok FROM peminjaman inner join buku INNER JOIN pengembalian ON (buku.id_buku=peminjaman.id_buku AND peminjaman.id_pinjaman=pengembalian.id_pinjaman) WHERE peminjaman.status = '0' OR pengembalian.status_kem='0' Group by buku.id_buku";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function rinci($id_user){
      $sql = "SELECT *, COUNT(judul_buku) as stok FROM  peminjaman INNER JOIN pengembalian INNER JOIN buku ON (peminjaman.id_pinjaman=pengembalian.id_pinjaman AND peminjaman.id_buku=buku.id_buku) WHERE peminjaman.id_user = '".$id_user."' AND (pengembalian.status_kem='1')";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function pros($id_user){
      $sql = "SELECT * FROM peminjaman inner join buku ON (peminjaman.id_buku=buku.id_buku) WHERE peminjaman.id_user = '".$id_user."' AND peminjaman.status='0' ";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function proskem($id_user){
      $sql = "SELECT * FROM peminjaman inner join pengembalian INNER JOIN buku ON (peminjaman.id_pinjaman=pengembalian.id_pinjaman AND peminjaman.id_buku=buku.id_buku) WHERE peminjaman.id_user = '".$id_user."' AND pengembalian.status_kem='0' ";
      $query=$this->db->query($sql);
      return $query->result_array();
    }
    function insert($data){
      $this->db->insert($this->table, $data);
    }
    function update($data, $where){
      $this->db->where($where);
      $this->db->update($this->table, $data);
    }
    function tambahdipinjam($where){
      $sql = "UPDATE buku SET dipinjam = dipinjam + 1 WHERE id_buku = '".$where."'";
      $query=$this->db->query($sql);
    }
    function hapusdipinjam($where){
      $sql = "UPDATE buku SET dipinjam = dipinjam - 1 WHERE id_buku = '".$where."'";
      $query=$this->db->query($sql);
    }
    function delete($where){
      $this->db->where($where);
      $this->db->delete($this->table);
    }
    function search($keyword)
    {
        $this->db->or_like(array('judul_buku'=>$keyword, 'jenis_buku'=>$keyword, 'pengarang'=>$keyword, 'penerbit'=>$keyword, 'tahun'=>$keyword, 'tempat'=>$keyword));
        $query  =   $this->db->get('buku');
        return $query->result_array();
    }
  }

 ?>

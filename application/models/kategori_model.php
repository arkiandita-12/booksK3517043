<?php

class kategori_model extends CI_Model {

	// method untuk menampilkan data buku
	public function getKategori($id = false){
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
		}
	}

	public function updateCat($idkategori, $kategori){
		// membaca semua data buku dari tabel 'books'
			$this->db->update('kategori',array("kategori"=>$kategori),"idkategori=$idkategori");
	}

	public function showCat($id = false){
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
		}
	}
}
?>
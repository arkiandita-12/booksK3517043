<?php

class User_model extends CI_Model {

	// method untuk menampilkan data buku
	public function getUserProfile($username = false){
		// membaca semua data buku dari tabel 'books'
		if ($username == false){
			$query = $this->db->get('users');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('users', array("username" => $username));
			return $query->row_array();
		}
	}

		public function getRole($idrole = false){
		// membaca semua data buku dari tabel 'books'
		if ($idrole == false){
			$query = $this->db->get('role');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('role', array("role" => $idrole));
			return $query->row_array();
		}
	}

}
?>
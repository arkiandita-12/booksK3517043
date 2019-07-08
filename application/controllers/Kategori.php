<?php
class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	// method hapus data buku berdasarkan id
	public function delete($id){
		$this->book_model->delBook($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk tambah data buku
	/*public function insert(){
		$Kategori = $_POST['Kategori']

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}*/

    public function edit($id){
        $data['view_category'] = $this->kategori_model->showCat($id);

        $data['fullname'] = $_SESSION['fullname'];

        if (empty($data['view_category'])){
            show_404();
        }

        $data['idkategori'] = $data['view_category']['idkategori'];
        $data['kategori'] = $data['view_category']['kategori'];

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editKat', $data);
        $this->load->view('dashboard/footer');
    }

   	public function update(){
   		// baca data dari form insert buku
   		$idkategori = $_POST['idkategori'];
		$kategori = $_POST['kategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->kategori_model->updateCat($idkategori, $kategori);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/addCat');

	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks(){
		
		// baca key dari form cari data
		$key = $_POST['key'];

		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['book'] = $this->book_model->findBook($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/books', $data);
        $this->load->view('dashboard/footer');
	}

}
?>
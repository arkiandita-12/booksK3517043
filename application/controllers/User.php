<?php
class User extends CI_Controller {

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
		$this->user_model->delUser($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/addUser');
	}

	// method untuk tambah data buku
	public function insert(){

		// baca data dari form insert buku
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$password = $_POST['password'];
		$idrole = $_POST['idrole'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->user_model->insertUser($username, $fullname, $idrole, $password);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/addUser');
	}

    public function edit($id){
    	$data['roles'] = $this->user_model->getRole();
        $data['view_user'] = $this->user_model->showUser($id);

        $data['fullname'] = $_SESSION['fullname'];

        if (empty($data['view_user'])){
            show_404();
        }

        $data['username'] = $data['view_user']['username'];
        $data['fullname'] = $data['view_user']['fullname'];
        $data['idrole'] = $data['view_user']['idrole'];
        $data['password'] = $data['view_user']['password'];

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editUser', $data);
        $this->load->view('dashboard/footer');
    }

    public function update(){

		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$idrole = $_POST['idrole'];
		$password = $_POST['password'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->user_model->updateUser($username, $fullname, $idrole, $password);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/addUser');
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
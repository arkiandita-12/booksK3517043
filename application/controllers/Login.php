<?php
class Login extends CI_Controller {

		// halaman index untuk kontroller login -> menampilkan view 'login/index'
        // ketika masuk ke index dia akan ngeload loginnya dari view
        public function index()
        {
            $this->load->view('login/index');
        }

        // method untuk proses submit login
        public function submit(){
        	// baca data username dan password dari form login
        	$username = $_POST['username'];
        	$password = $_POST['password'];

        	// panggil method getUserProfile() dari user_model untuk membaca data profile user
            // login sukses kalau username dan password yang dimasukkan sama dengan username dan password dalam database
        	$data['user'] = $this->user_model->getUserProfile($username);

        	// bandingkan password user dari database dengan yang disubmit via form
        	if ($data['user']['password'] == $password){
        		// jika password sama, maka simpan username dan fullname user ke session
                // disimpan di session supaya muncul di dashboard
                // manfaatnya disimpan di session untuk mengecek apakah user tsb sudah login apa belum. mencegah orang melakukan bypass
        		$_SESSION['username'] = $username;
        		$_SESSION['fullname'] = $data['user']['fullname'];

        		// akan arahkan ke kontroller 'dashboard/index'
        		redirect('dashboard');
        	} else {
        		// jika password tidak sama, arahkan ke kontroler 'login/index' lagi
        		redirect('login/index');
        	}
        }
}
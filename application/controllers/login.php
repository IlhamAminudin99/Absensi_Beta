<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class login extends REST_Controller {

    public function __construct($config = 'rest') {
       parent::__construct($config);
       $this->load->database();
    }

    public function index_post() {
        $username = $this->post('username');
        $password = $this->post('password');

        // Cek database untuk user
        $this->db->where('username', $username);
        $user = $this->db->get('tb_user')->row();

        if(!empty($user)){
            // Verifikasi password
            if ($password == $user->password) {
                // Jika berhasil, buat response sukses
                $this->response(['status' => true, 'message' => 'Login successful.'], REST_Controller::HTTP_OK);
            } else {
                // Jika gagal, buat response gagal
                $this->response(['status' => false, 'message' => 'Wrong password.'], REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            // Jika user tidak ditemukan
            $this->response(['status' => false, 'message' => 'User not found.'], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_get() {
        // Untuk logout, kita hanya perlu menghapus data session
        $this->session->sess_destroy();
        $this->response(['status' => true, 'message' => 'Logout successful.'], REST_Controller::HTTP_OK);
    }
}
?>

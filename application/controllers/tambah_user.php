<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class tambah_user extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data user
    function index_get() {
        $username = $this->get('username');
        if ($username == '') {
            $tambah_user = $this->db->get('tb_user')->result();
        } else {
            $this->db->where('username', $username);
            $tambah_user = $this->db->get('tb_user')->result();
        }
        $this->response($tambah_user, 200);
    }


    //Masukan function selanjutnya disini

    //Mengirim atau menambah data user baru
    function index_post() {
        $data = array(
                    'username'           => $this->post('username'),
                    'password'          => $this->post('password'),
                    'level'    => $this->post('level'),);
        $insert = $this->db->insert('tb_user', $data);
        if ($insert) {
            $this->response(['status' => true, 'message' => 'Berhasil tambah data.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(array(['status' => false, 'message' => 'Anda gagal menambahkan data.'], REST_Controller::HTTP_NOT_FOUND));
    }
}
}
?>

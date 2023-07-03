<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class tambah_mahasiswa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data mahasiswa
    function index_get() {
        $npm = $this->get('npm');
        if ($npm == '') {
            $tambah_mahasiswa = $this->db->get('daftar_mhs')->result();
        } else {
            $this->db->where('npm', $npm);
            $tambah_mahasiswa = $this->db->get('daftar_mhs')->result();
        }
        $this->response($tambah_mahasiswa, 200);
    }


    //Masukan function selanjutnya disini

    //Mengirim atau menambah data mahasiswa baru
    function index_post() {
        $data = array(
                    'npm'           => $this->post('npm'),
                    'nama'          => $this->post('nama'),
                    'jenkel'    => $this->post('jenkel'),
                    'alamat'    => $this->post('alamat'),
                    'telp'    => $this->post('telp'),
                    'email'    => $this->post('email'));
        $insert = $this->db->insert('daftar_mhs', $data);
        if ($insert) {
            $this->response(['status' => true, 'message' => 'Berhasil tambah data.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(array(['status' => false, 'message' => 'Anda gagal menambahkan data.'], REST_Controller::HTTP_NOT_FOUND));
        }
    }
    
    //Masukan function selanjutnya disini

    //Memperbarui data mahasiswa yang telah ada
    function index_put() {
        $npm = $this->put('npm');
        $data = array(
                    'npm'          => $this->put('npm'),
                    'nama'          => $this->put('nama'),
                    'jenkel'          => $this->put('jenkel'),
                    'alamat'          => $this->put('alamat'),
                    'telp'          => $this->put('telp'),
                    'email'    => $this->put('email'));
        $this->db->where('npm', $npm);
        $update = $this->db->update('daftar_mhs', $data);
        if ($update) {
            $this->response(['status' => true, 'message' => 'Berhasil update data.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(array(['status' => false, 'message' => 'Anda gagal update data.'], REST_Controller::HTTP_NOT_FOUND));
        }
    }
    
    //Masukan function selanjutnya disini

        //Menghapus salah satu data mahasiswa
        function index_delete() {
            $npm = $this->delete('npm');
            $this->db->where('npm', $npm);
            $delete = $this->db->delete('daftar_mhs');
            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
}
?>
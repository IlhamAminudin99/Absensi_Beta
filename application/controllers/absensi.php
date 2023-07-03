<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class absensi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function index_post() {
        $input = $this->input->post();
        $this->db->insert('absensi', $input);

        $this->response(['Success Absensi'], REST_Controller::HTTP_OK);
    }
}
?>
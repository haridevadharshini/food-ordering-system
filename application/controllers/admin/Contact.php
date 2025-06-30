<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Contact_model');

		// // Optional: Only allow access if admin is logged in
		// if (!$this->session->userdata('admin_logged_in')) {
		// 	redirect('admin/login');
		// }
	}

	public function index(){
        $data['messages'] = $this->Contact_model->getMessages();
        $this->load->view('admin/partials/header');
        $this->load->view('admin/contact/index', $data);
	
	}

	public function approve($id) {
        $this->Contact_model->approveMessage($id);
        redirect('admin/contact');
    }

    public function delete($id) {
        $this->Contact_model->deleteMessage($id);
        redirect('admin/contact');
    }
}

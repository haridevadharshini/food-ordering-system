<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
{
    $this->load->model('Menu_model');
    $this->load->model('Contact_model'); // ✅ Add this

    $dish = $this->Menu_model->getMenu();
    $data['dishesh'] = $dish;

    // ✅ Get only approved messages
    $data['approved_messages'] = $this->Contact_model->getApprovedMessages();

    $this->load->view('front/partials/header');
    $this->load->view('front/home', $data);  // ✅ Pass messages to view
    $this->load->view('front/partials/footer');
}


	public function sendMail() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name','name', 'trim|required');
    $this->form_validation->set_rules('email','email', 'trim|required');
    $this->form_validation->set_rules('subject','subject', 'trim|required');
    $this->form_validation->set_rules('message','message', 'trim|required');

    if($this->form_validation->run() == true) {
        $name = $this->input->post('name');
        $emailFrom = $this->input->post('email');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        // STEP: Load the model
        $this->load->model('Contact_model');

        // STEP: Save to DB
        $data = array(
            'name' => $name,
            'email' => $emailFrom,
            'subject' => $subject,
            'message' => $message
        );
        $this->Contact_model->save_message($data);

        // STEP: Send email
        $toEmail = "haridevadharshini311@gmail.com";
        $mailHeaders = "From: ". $name . "<". $emailFrom .">\r\n";
        if(mail($toEmail, $subject, $message, $mailHeaders)) {
            $this->session->set_flashdata("msg","Mail sent & saved in database.");
        } else {
            $this->session->set_flashdata("msg","Saved in database, but mail failed.");
        }
        redirect(base_url().'home/index');
    } else {
        redirect(base_url().'home/index');
    }
}
}

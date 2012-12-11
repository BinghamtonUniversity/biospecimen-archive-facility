<?php
class Main extends CI_Controller {
	public function index() 
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('fname','First-name','xss_clean|trim|required|max_length[100]');
		$this->form_validation->set_rules('lname','Last-name','xss_clean|trim|required|max_length[100]');
		$this->form_validation->set_rules('tname','Title','xss_clean|trim|max_length[10]');
		$this->form_validation->set_rules('institution','Institution name','xss_clean|trim|required|max_length[500]');
		$this->form_validation->set_rules('emailid','Email ID','xss_clean|trim|required|max_length[150]|valid_email');
		$this->form_validation->set_rules('phno','Phone number','xss_clean|trim|required|max_length[20]');
		$this->form_validation->set_rules('desc','Brief Description of your research','xss_clean|trim|required');
		$this->form_validation->set_rules('otherDesc','Other Pertinent information','xss_clean|trim');


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('init_app_form');;
		}
		else
		{
			$this->load->view('init_app_success');
		}
	}
}
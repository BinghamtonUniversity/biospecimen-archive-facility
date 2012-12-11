<?php
class Main extends CI_Controller {
	public function index() 
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('init_app_form');;
		}
		else
		{
			$this->load->view('init_app_form_success');
		}
	}
}
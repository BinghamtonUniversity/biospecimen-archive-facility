<?php
class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('email');
	}

	public function index() 
	{
		

		$this->form_validation->set_rules('fname','First-name','xss_clean|trim|required|max_length[100]');
		$this->form_validation->set_rules('lname','Last-name','xss_clean|trim|required|max_length[100]');
		$this->form_validation->set_rules('tname','Title','xss_clean|trim|max_length[10]');
		$this->form_validation->set_rules('institution','Institution name','xss_clean|trim|required|max_length[500]');
		$this->form_validation->set_rules('emailid','Email ID','xss_clean|trim|required|max_length[150]|valid_email');
		$this->form_validation->set_rules('phno','Phone number','xss_clean|trim|required|max_length[20]');
		$this->form_validation->set_rules('desc','Brief Description of your research','xss_clean|trim|required');
		$this->form_validation->set_rules('otherDesc','Other Pertinent information','xss_clean|trim');

		$config['upload_path'] 		= './tmp_holder/';
		$config['allowed_types']	= 'doc|docx|pdf|rtf';
		$config['max_size']			= '10240';
		$config['file_name'] 		= $this->session->userdata('session_id').'_1';
		$config['overwrite'] 		= TRUE;

		$config2['upload_path'] 	= './tmp_holder/';
		$config2['allowed_types'] 	= 'doc|docx|pdf|rtf';
		$config2['max_size']		= '10240';
		$config2['file_name'] 		= $this->session->userdata('session_id').'_2';
		$config2['overwrite'] 		= TRUE;

		$this->load->library('upload',$config);


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('init_app_form');
		}
		else
		{

			if($this->upload->do_upload('cvFile') === FALSE) {
				$this->load->view('init_app_form');
			}
			else {
				$file1Return = $this->upload->data();

				$this->upload->initialize($config2);
				if($this->upload->do_upload('researchFile') === FALSE) {
					$this->load->view('init_app_form');
				}
				else {
					//process data here
					$file2Return = $this->upload->data();

					$this->email->from($this->input->post('emailid'), $this->input->post('tname').' '.$this->input->post('fname').' '.$this->input->post('lname'));
					$this->email->to('adarshakb@gmail.com'); 
					
					$this->email->subject('Biospeciment archive facility');
					$this->email->message('From: '.$this->input->post('tname',TRUE).' '.$this->input->post('fname',TRUE).' '.$this->input->post('lname',TRUE).
										'\nInstitution: '.$this->input->post('institution').
										'\nContact Informtion:'.
										'\nPhone: '.$this->input->post('phno').
										'\nEmail: '.$this->input->post('emailid').
										'\nBreif Description:\n'.$this->input->post('desc').
										'\nOther Information:\n'.$this->input->post('OtherDesc'));	

					$this->email->attach($file1Return['full_path']);
					$this->email->attach($file2Return['full_path']);

					$this->email->send();

					@unlink($this->session->userdata('session_id').'_2');
					$this->load->view('init_app_success');
				}
				@unlink($this->session->userdata('session_id').'_1');
			}
			
		}
	}
}
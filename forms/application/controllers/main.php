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

		$this->load->helper('file');


		$this->load->library('email');
	}

	public function index() 
	{

		$this->form_validation->set_rules('fname','First-name','xss_clean|trim|required|max_length[100]');
		$this->form_validation->set_rules('lname','Last-name','xss_clean|trim|required|max_length[100]');
		$this->form_validation->set_rules('tname','Title','xss_clean|trim|max_length[100]');
		$this->form_validation->set_rules('institution','Institution name','xss_clean|trim|required|max_length[500]');
		$this->form_validation->set_rules('emailid','Email ID','xss_clean|trim|required|max_length[150]|valid_email');
		$this->form_validation->set_rules('phno','Phone number','xss_clean|trim|required|max_length[20]');
		$this->form_validation->set_rules('desc','Brief Description of your research','xss_clean|trim|required');
		$this->form_validation->set_rules('otherDesc','Other Pertinent information','xss_clean|trim');

		$fileName1 = $this->session->userdata('session_id').'_1';
		$fileName2 = $this->session->userdata('session_id').'_2';

		$config['upload_path'] 		= './tmp_holder/';
		$config['allowed_types']	= 'doc|docx|pdf|rtf';
		$config['max_size']			= '10240';
		$config['file_name'] 		= $fileName1;
		$config['overwrite'] 		= TRUE;

		$config2['upload_path'] 	= './tmp_holder/';
		$config2['allowed_types'] 	= 'doc|docx|pdf|rtf';
		$config2['max_size']		= '10240';
		$config2['file_name'] 		= $fileName2;
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
					//mail('adarshakb@gmail.com', 'lalal', 'I am here');

					$this->config->load('email');

					$this->email->initialize($this->config->item('email_conf'));


					$this->email->from($this->config->item('email_from'), $this->input->post('tname').' '.$this->input->post('fname').' '.$this->input->post('lname'));
					$this->email->to($this->config->item('email_to'));
					
					$this->email->subject('Biospecimen Archive Facility Initial Application');
					$this->email->message('Name: '.$this->input->post('tname',TRUE).' '.$this->input->post('fname',TRUE).' '.$this->input->post('lname',TRUE).
										'<br/>Institution: '.$this->input->post('institution').
										'<br/>Contact Informtion:'.
										'<br/>Phone: '.$this->input->post('phno').
										'<br/>Email: '.$this->input->post('emailid').
										'<br/>Brief Description:<br/>'.$this->input->post('desc').
										'<br/>Other Information:<br/>'.$this->input->post('otherDesc'));	

					$this->email->attach($file1Return['full_path']);
					$this->email->attach($file2Return['full_path']);

					if( $this->email->send() == false ) {
						//error
						echo $this->email->print_debugger(); exit;
					}

					$this->email->from('biospecimenarchive@binghamton.edu','Biospecimen Archive Facility - Binghamton University');
					$this->email->to($this->input->post('emailid'));
					$this->email->subject('Biospecimen Archive Facility Initial Application - Binghamton University');
					$this->email->message($this->load->view('responseEmail.html','',TRUE));

					if( $this->email->send() == false ) {
						//error
						echo $this->email->print_debugger(); exit;
					}

					@delete_files($fileName2);
					$this->init_app_success();
				}
				@delete_files($fileName1);
			}
		}
	}

	public function init_app_success() {
		$this->load->view('init_app_success');
	}

	public function final_application() {

		$this->form_validation->set_rules('fname','First-name','xss_clean|trim|required|max_length[100]');
		$this->form_validation->set_rules('lname','Last-name','xss_clean|trim|required|max_length[100]');
		$this->form_validation->set_rules('tname','Title','xss_clean|trim|max_length[100]');
		$this->form_validation->set_rules('institution','Institution name','xss_clean|trim|required|max_length[500]');
		$this->form_validation->set_rules('emailid','Email ID','xss_clean|trim|required|max_length[150]|valid_email');
		$this->form_validation->set_rules('phno','Phone number','xss_clean|trim|required|max_length[20]');
		$this->form_validation->set_rules('address1','Shipping information','xss_clean|trim|required');
		$this->form_validation->set_rules('address2','Shipping information','xss_clean|trim');
		$this->form_validation->set_rules('fundingsource','Funding Source','xss_clean|trim|required');
		$this->form_validation->set_rules('fundingAmountDuration','Funding Amount/Duration','xss_clean|trim|required');
		$this->form_validation->set_rules('otherDesc','Other Pertinent information','xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('final_app_form');
		}
		else
		{
			$this->email->clear();

			$this->config->load('email');
			$this->email->initialize($this->config->item('email_conf'));

			$this->email->from($this->config->item('email_from'), $this->input->post('tname').' '.$this->input->post('fname').' '.$this->input->post('lname'));
			$this->email->to($this->config->item('email_to'));
			
			$this->email->subject('Biospecimen Archive Facility Final Application');
			$this->email->message('Name: '.$this->input->post('tname',TRUE).' '.$this->input->post('fname',TRUE).' '.$this->input->post('lname',TRUE).
								'<br/>Institution: '.$this->input->post('institution').
								'<br/>Contact Informtion:'.
								'<br/>Phone: '.$this->input->post('phno').
								'<br/>Email: '.$this->input->post('emailid').
								'<br/>Funding:<br/> Funding source:'.$this->input->post('fundingsource').'<br/> Funding Amount/Duration:'.$this->input->post('fundingAmountDuration').
								'<br/>Shipping Information:'.$this->input->post('address1').'<br/>'.$this->input->post('address2').
								'<br/>Other Information:<br/>'.$this->input->post('otherDesc'));

			if( $this->email->send() == false ) {
				//error
				echo $this->email->print_debugger(); exit;
			}


			$this->email->from('biospecimenarchive@binghamton.edu','Biospecimen Archive Facility - Binghamton University');
			$this->email->to($this->input->post('emailid'));
			$this->email->subject('Biospecimen Archive Facility Final Application - Binghamton University');
			$this->email->message($this->load->view('responseEmailForFinalApplicationForm.html','',TRUE));

			if( $this->email->send() == false ) {
				//error
				echo $this->email->print_debugger(); exit;
			}
			$this->final_application_success();
		}
	}

	public function final_application_success() {
		$this->load->view('final_app_form_success');
	}
}
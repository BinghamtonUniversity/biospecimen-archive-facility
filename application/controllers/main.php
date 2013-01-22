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
					mail('adarshakb@gmail.com', 'lalal', 'I am here');
					
					
					$this->config->load('email');

					$this->email->initialize($this->config->item('email_conf'));


					$this->email->from($this->config->item('email_from'), $this->input->post('tname').' '.$this->input->post('fname').' '.$this->input->post('lname'));
					$this->email->to($this->config->item('email_to'));
					
					$this->email->subject('Biospeciment archive facility');
					$this->email->message('Name: '.$this->input->post('tname',TRUE).' '.$this->input->post('fname',TRUE).' '.$this->input->post('lname',TRUE).
										'<br/>Institution: '.$this->input->post('institution').
										'<br/>Contact Informtion:'.
										'<br/>Phone: '.$this->input->post('phno').
										'<br/>Email: '.$this->input->post('emailid').
										'<br/>Breif Description:<br/>'.$this->input->post('desc').
										'<br/>Other Information:<br/>'.$this->input->post('OtherDesc'));	

					$this->email->attach($file1Return['full_path']);
					$this->email->attach($file2Return['full_path']);

					if( $this->email->send() == false ) {
						//error
						echo $this->email->print_debugger(); exit;
					}

					$this->email->clear();

					$this->email->from('biospecimenarchive@binghamton.edu','Biospecimen Archive Facility - Binghamton University');
					$this->email->to($this->input->post('emailid'));
					$this->email->subject('Biospecimen Archive Facility - Binghamton University');
					$this->email->message(file_get_contents('./application/views/responseEmail.html'));

					if( $this->email->send() == false ) {
						//error
						echo $this->email->print_debugger(); exit;
					}

					@unlink($this->session->userdata('session_id').'_2');
					$this->load->view('init_app_success');
				}
				@unlink($this->session->userdata('session_id').'_1');
			}
			
		}
	}
}
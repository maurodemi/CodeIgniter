<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		$this->load->view('login');
	}

	public function login() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|required');

		if($this->form_validation->run()==false) {
			$this->index();
		} else {
			$user=$this->model->validate_credentials($this->input->post('email'),$this->input->post('password'));

			if($user) {
				//Creare i dati di sessione
				$data=array(
					'id'=>$user->id,
					'email'=>$user->email,
					'logged-in'=>true
				);
				$this->session->set_userdata($data);
				//Reindirizzare l'utente alla pagina dell'applicazione
				redirect('app');
			} else {
				redirect('welcome');
			}
		}
	}

}

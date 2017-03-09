<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public $user        = [];
	public $permissions = [];
	public $abilities   = [];

	public function __construct()
	{
		parent::__construct();

		$this->load->library(['blade', 'session']);
		$this->load->helper(['url']);

		$this->user        = $this->session->userdata('user');
		$this->permissions = $this->session->userdata('permissions');
		$this->abilities   = $this->session->userdata('abilities');
	}

	public function index()
	{
		$this->blade->render('index');
	}
}

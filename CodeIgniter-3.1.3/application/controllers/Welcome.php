<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(['blade']);
		$this->load->helper(['url']);
	}

	public function index()
	{
		$this->blade->render('index');
	}
}

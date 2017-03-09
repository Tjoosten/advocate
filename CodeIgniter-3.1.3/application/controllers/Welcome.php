<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public $user        = []; /** @var array  */
	public $permissions = []; /** @var array  */
	public $abilities   = []; /** @var array  */

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
		$data['events'] = Manifest::take(4)->get();
		$data['news']   = Articles::take(3)->get();

		$this->blade->render('index', $data);
	}
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class NewsLetter
 */
class NewsLetter extends CI_Controller
{
	public $user        = []; /** @var array $user         The authencated user data.                 */
	public $abilities   = []; /** @var array $abilities    The abilities for tyhe authencated user.   */
	public $permissions = []; /** @var array $permissions  The permissions for the authencated user.  */

	/**
	 * NewsLetter constructor.
	 *
	 * @return null|void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library(['form_validation', 'session', 'blade']);
		$this->load->helper(['url', 'string']);

		$this->user        = $this->session->userdata('user');
		$this->abilities   = $this->session->userdata('abilities');
		$this->permissions = $this->session->userdata('permissions');
	}

	/**
	 * Insert a new user into the newsletter system.
	 *
	 * @see:url('GET|HEAD', 'http://www.activisme.be/newsletter/store')
	 * @return Redirect
	 */
	public function store()
	{
		$this->form_validation->set_rules('name', 'Uw naam:', 'trim|required');
		$this->form_validation->set_rules('email', 'Email adres', 'trim|required');

		if ($this->form_validation->run() === false) { // Form validation >>> Fails
			return redirect($_SERVER['HTTP_REFERER']);
		}

		// No errors found move on with the controller logic.
		$input['email'] = $this->input->post('name');
		$input['name']  = $this->input->post('email');
		$input['token'] = random_string('alnum', 18);

		if (Subscription::create($this->security->xss_clean($input))) { // Data >>> Stored
			$this->session->set_flashdata('class', 'msg msg-success');
			$this->session->set_flashdata('message', 'U bent ingeschreven op onze nieuwsbrief.');
		}

		return redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 * Delete an email address out off the newsletter system.
	 *
	 * @see:url('GET|HEAD', 'http://www.activisme.be/newsletter/delete')
	 * @return redirect
	 */
	public function delete()
	{
		$param['token'] = $this->input->get('token');
		$param['email'] = $this->input->get('email');

		// Escape params.
		$this->security->xss_clean($param);

		// Query
		$db['data'] = Subscription::were('email', $param['email']);

		if ((int) $db['data']->count() === 1) { // db output is one record.
			$data = $db['data']->get()->first();

			if ((string) $param['token'] === $data->token && (string) $param['email'] === $data->email) { // VALID === true
				if (Subscription::find($data->id)->delete()) { // Record >>> deleted.
					$this->session->set_flashdata('class', 'msg msg-success');
					$this->session->set_flashdata('message', 'U bent uitgeschreven op onze nieuwsbrief.');

					$config['protocol']     = $this->config->item('mail_protocol');
					$config['smtp_host']    = $this->config->item('mail_host');
					$config['smtp_user']    = $this->config->item('mail_user');
					$config['smtp_pass']    = $this->config->item('mail_pass');
					$config['smtp_port']    = $this->config->item('mail_port');
					$config['authencation'] = $this->config->item('mail_auth');

					$this->email->initialize($config);
					$this->email->from('noreply@activisme.be');
					$this->email->to($data->email);
					$this->email->subject('Verwijdering uit de nieuwsbrief');
					$this->email->message($this->blade->render('email/delete-newsletter'));
					$this->email->set_mailtype('html');
					$this->email->clear();
				}
			}
		}

		return redirect(base_url());
	}
}

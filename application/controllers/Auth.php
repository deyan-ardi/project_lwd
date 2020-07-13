<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Auth extends CI_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index()
	{

		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('login', 'refresh');
		} else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$this->data['title'] = $this->lang->line('index_heading');

			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			// Hapus User
			$this->LWD_model->hapusDataInactive();

			// //list the users
			$this->data['users'] = $this->ion_auth->users()->result();

			//list the users
			// $this->data['users'] = $this->LWD_model->hapusDataInactive()->result();

			//USAGE NOTE - you can do more complicated queries like this
			//$this->data['users'] = $this->ion_auth->where('field', 'value')->users()->result();

			$id = $_SESSION['user_id'];
			$this->data['komentar'] = $this->LWD_model->getKomentar();
			$this->data['project'] = $this->LWD_model->getProject();
			$this->data['category'] = $this->LWD_model->getCategory();
			$this->data['detail_category'] = $this->LWD_model->getDetailCategory($id);
			foreach ($this->data['users'] as $k => $user) {
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'index', $this->data);
		}
	}

	/**
	 * Log the user in
	 */
	public function login()
	{
		if ($this->ion_auth->logged_in()) {
			// redirect them to the login page
			if ($this->ion_auth->is_admin()) {
				redirect('adminlwd', 'refresh');
			} else {
				redirect('user/directory', 'refresh');
			}
		} else {
			$this->data['title'] = $this->lang->line('login_heading');

			// validate form input
			$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
			$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

			if ($this->form_validation->run() === TRUE) {
				// check to see if the user is logging in
				// check for "remember me"
				$remember = (bool) $this->input->post('remember');

				if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
					//if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					if ($this->ion_auth->is_admin()) {

						redirect('adminlwd', 'refresh');
					} else {
						redirect('user/directory', 'refresh');
					}
				} else {
					// if the login was un-successful
					// redirect them back to the login page
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
				}
			} else {
				// the user is not logging in so display the login page
				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['identity'] = [
					'name' => 'identity',
					'id' => 'identity',
					'type' => 'text',
					'value' => $this->form_validation->set_value('identity'),
				];

				$this->data['password'] = [
					'name' => 'password',
					'id' => 'password',
					'type' => 'password',
				];

				$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
			}
		}
	}
	/**
	 * Log the user out
	 */
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$this->ion_auth->logout();

		// redirect them to the login page
		redirect('/', 'refresh');
	}

	/**
	 * Change password
	 */
	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() === FALSE) {
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = [
				'name' => 'old',
				'id' => 'old',
				'type' => 'password',
			];
			$this->data['new_password'] = [
				'name' => 'new',
				'id' => 'new',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			];
			$this->data['new_password_confirm'] = [
				'name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			];
			$this->data['user_id'] = [
				'name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id,
			];

			// render
			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'change_password', $this->data);
		} else {
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change) {
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			} else {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	/**
	 * Forgot password
	 */
	public function forgot_password()
	{
		$this->data['title'] = $this->lang->line('forgot_password_heading');

		// setting validation rules by checking whether identity is username or email
		if ($this->config->item('identity', 'ion_auth') != 'email') {
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		} else {
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() === FALSE) {
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['identity'] = [
				'name' => 'identity',
				'id' => 'identity',
				'placeholder' => 'emailku@gmail.com'
			];

			if ($this->config->item('identity', 'ion_auth') != 'email') {
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			} else {
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'forgot_password', $this->data);
		} else {
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity)) {

				if ($this->config->item('identity', 'ion_auth') != 'email') {
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				} else {
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten) {
				// if there were no errors
				// $this->session->set_flashdata('message', $this->ion_auth->messages());
				// redirect("login", 'refresh'); //we should display a confirmation page here instead of the login page
				$data['judul'] = 'Login Page - Confirmation Page';
				$data['message'] = $this->ion_auth->messages();
				$this->load->view('user/templates/header', $data);
				$this->load->view('auth/email/confirmation');
				$this->load->view('user/templates/footer_login');
			} else {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL)
	{
		if (!$code) {
			show_404();
		}

		$this->data['title'] = $this->lang->line('reset_password_heading');

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user) {
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE) {
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = [
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['new_password_confirm'] = [
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['user_id'] = [
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				];
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'reset_password', $this->data);
			} else {
				$identity = $user->{$this->config->item('identity', 'ion_auth')};

				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($identity);

					show_error($this->lang->line('error_csrf'));
				} else {
					// finally change the password
					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change) {
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("login", 'refresh');
					} else {
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		} else {
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE)
	{
		$activation = FALSE;

		if ($code !== FALSE) {
			$activation = $this->ion_auth->activate($id, $code);
		} else if ($this->ion_auth->is_admin()) {
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation) {
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		} else {
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Deactivate the user
	 *
	 * @param int|string|null $id The user ID
	 */
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE) {
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'deactivate_user', $this->data);
		} else {
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes') {
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	/**
	 * Create a new user
	 */
	public function create_user()
	{
		$this->data['title'] = $this->lang->line('create_user_heading');

		// if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
		// 	redirect('auth', 'refresh');
		// }

		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
		if ($identity_column !== 'email') {
			$this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
		} else {
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
		}
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
		$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() === TRUE) {
			$email = strtolower($this->input->post('email'));
			$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
			$password = $this->input->post('password');

			$additional_data = [
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone'),
			];
		}
		if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
			// check to see if we are creating the user
			// redirect them back to the admin page
			// redirect("confirmation", 'refresh');
			$data['judul'] = 'Login Page - Confirmation Page';
			$data['message'] = $this->ion_auth->messages();
			$this->load->view('user/templates/header', $data);
			$this->load->view('auth/email/confirmation');
			$this->load->view('user/templates/footer_login');
		} else {
			// display the create user form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = [
				'name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
				'placeholder' => 'Michael',
				'value' => $this->form_validation->set_value('first_name'),
			];
			$this->data['last_name'] = [
				'name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
				'placeholder' => 'John',
				'value' => $this->form_validation->set_value('last_name'),
			];
			$this->data['identity'] = [
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'placeholder' => 'emailku@gmail.com',
				'value' => $this->form_validation->set_value('identity'),
			];
			$this->data['email'] = [
				'name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'placeholder' => 'emailku@gmail.com',
				'value' => $this->form_validation->set_value('email'),
			];
			$this->data['company'] = [
				'name' => 'company',
				'id' => 'company',
				'type' => 'text',
				'placeholder' => 'Contoh: Undiksha',
				'value' => $this->form_validation->set_value('company'),
			];
			$this->data['phone'] = [
				'name' => 'phone',
				'id' => 'phone',
				'type' => 'text',
				'placeholder' => '08xxxxxxxxxxx',
				'value' => $this->form_validation->set_value('phone'),
			];
			$this->data['password'] = [
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'placeholder' => '********',
				'value' => $this->form_validation->set_value('password'),
			];
			$this->data['password_confirm'] = [
				'name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'placeholder' => '********',
				'value' => $this->form_validation->set_value('password_confirm'),
			];

			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'create_user', $this->data);
		}
	}

	/**
	 * Redirect a user checking if is admin
	 */
	public function redirectUser()
	{
		if ($this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}
		redirect('/', 'refresh');
	}

	/**
	 * Edit a user
	 *
	 * @param int|string $id
	 */
	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//USAGE NOTE - you can do more complicated queries like this
		//$groups = $this->ion_auth->where(['field' => 'value'])->groups()->result_array();


		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim');

		if (isset($_POST) && !empty($_POST)) {
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password')) {
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE) {
				$data = [
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
				];

				// update the password if it was posted
				if ($this->input->post('password')) {
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin()) {
					// Update the groups user belongs to
					$this->ion_auth->remove_from_group('', $id);

					$groupData = $this->input->post('groups');
					if (isset($groupData) && !empty($groupData)) {
						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}
					}
				}

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data)) {
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$this->redirectUser();
				} else {
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					$this->redirectUser();
				}
			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = [
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		];
		$this->data['last_name'] = [
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		];
		$this->data['company'] = [
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		];
		$this->data['phone'] = [
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		];
		$this->data['password'] = [
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password'
		];
		$this->data['password_confirm'] = [
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
		];

		$this->_render_page('auth/edit_user', $this->data);
	}

	/**
	 * Create a new group
	 */
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'trim|required|alpha_dash');

		if ($this->form_validation->run() === TRUE) {
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if ($new_group_id) {
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			} else {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
			}
		}

		// display the create group form
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['group_name'] = [
			'name'  => 'group_name',
			'id'    => 'group_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_name'),
		];
		$this->data['description'] = [
			'name'  => 'description',
			'id'    => 'description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('description'),
		];

		$this->_render_page('auth/create_group', $this->data);
	}

	/**
	 * Edit a group
	 *
	 * @param int|string $id
	 */
	public function edit_group($id)
	{
		// bail if no group id given
		if (!$id || empty($id)) {
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'trim|required|alpha_dash');

		if (isset($_POST) && !empty($_POST)) {
			if ($this->form_validation->run() === TRUE) {
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], array(
					'description' => $_POST['group_description']
				));

				if ($group_update) {
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
					redirect("auth", 'refresh');
				} else {
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$this->data['group_name'] = [
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
		];
		if ($this->config->item('admin_group', 'ion_auth') === $group->name) {
			$this->data['group_name']['readonly'] = 'readonly';
		}

		$this->data['group_description'] = [
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		];

		$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'edit_group', $this->data);
	}

	/**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return [$key => $value];
	}

	/**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $returnhtml
	 *
	 * @return mixed
	 */
	public function _render_page($view, $data = NULL, $returnhtml = FALSE) //I think this makes more sense
	{

		$viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml) {
			return $view_html;
		}
	}
	public function hapus_komentar($id)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$this->LWD_model->hapusKomentar($id);
			$this->session->set_flashdata('flash', 'Data Success Delete');
			redirect('adminlwd', 'refresh');
		}
	}
	public function hapus_project($id)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$this->LWD_model->hapusProject($id);
			$this->session->set_flashdata('flash', 'Data Success Delete');
			redirect('adminlwd', 'refresh');
		}
	}
	public function upload_project()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$this->form_validation->set_rules('project_name', 'Project Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required|max_length[500]');
			$this->form_validation->set_rules('link', 'URL', 'required|valid_url');
			if ($this->form_validation->run() == FALSE) {
				$data['judul'] = 'Upload  Project';
				$this->load->view('user/templates/header', $data);
				$this->load->view('user/upload_project');
				$this->load->view('user/templates/footer_login');
			} else {
				$this->LWD_model->inputProject();
				$this->session->set_flashdata('flash', 'Success Sending Message');
				redirect('adminlwd', 'refresh');
			}
		}
	}
	public function upload_comment()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$id = $_SESSION['user_id'];
			$data['login'] = $this->LWD_model->getLogin($id);
			// echo var_dump($login);
			$data['judul'] = 'Upload  New Comment';
			$this->form_validation->set_rules('komentar', 'Comment', 'required|max_length[500]');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('user/templates/header', $data);
				$this->load->view('user/upload_comment', $data);
				$this->load->view('user/templates/footer_login');
			} else {
				$this->LWD_model->inputKomentar();
				$this->session->set_flashdata('flash', 'Success Sending Message');
				redirect('adminlwd', 'refresh');
			}
		}
	}
	public function edit_project($id)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$data['judul'] = 'Edit Project';
			$data['project'] = $this->LWD_model->editProject($id);
			$this->form_validation->set_rules('project_name', 'Project Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required|max_length[500]');
			$this->form_validation->set_rules('link', 'URL', 'required|valid_url');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('user/templates/header', $data);
				$this->load->view('user/edit_project', $data);
				$this->load->view('user/templates/footer_login');
			} else {
				$this->LWD_model->prosesEditProject($id);
				$this->session->set_flashdata('flash', 'Success Sending Message');
				redirect('adminlwd', 'refresh');
			}
		}
	}
	public function upload_category()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$id = $_SESSION['user_id'];
			$data['login'] = $this->LWD_model->getLogin($id);
			// echo var_dump($login);
			$data['judul'] = 'Upload  New Category';
			$this->form_validation->set_rules('category', 'Category Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required|max_length[500]');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('user/templates/header', $data);
				$this->load->view('user/upload_category', $data);
				$this->load->view('user/templates/footer_login');
			} else {
				$this->LWD_model->inputCategory();
				$this->session->set_flashdata('flash', 'Success Sending Message');
				redirect('adminlwd', 'refresh');
			}
		}
	}
	public function edit_category($id_category)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$id = $_SESSION['user_id'];
			$data['login'] = $this->LWD_model->getLogin($id);
			$data['judul'] = 'Edit Category';
			$data['category'] = $this->LWD_model->editCategory($id_category);

			$this->form_validation->set_rules('category', 'Category Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required|max_length[500]');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('user/templates/header', $data);
				$this->load->view('user/edit_category', $data);
				$this->load->view('user/templates/footer_login');
			} else {
				$this->LWD_model->prosesEditCategory($id_category);
				$this->session->set_flashdata('flash', 'Success Sending Message');
				redirect('adminlwd', 'refresh');
			}
		}
	}
	public function hapus_category($id)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			echo var_dump($this->LWD_model->hapusCategory($id));
			$this->session->set_flashdata('flash', 'Data Success Delete');
			redirect('adminlwd', 'refresh');
		}
	}
	public function upload_file()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$id = $_SESSION['user_id'];
			$data['login'] = $this->LWD_model->getLogin($id);
			// echo var_dump($login);
			$data['judul'] = 'Upload New File';
			$data['kategori'] = $this->LWD_model->getCategory();
			$this->form_validation->set_rules('file_name', 'File Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required|max_length[500]');
			$this->form_validation->set_rules('protection', 'File Name', 'required');
			$this->form_validation->set_rules('category', 'Category', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('user/templates/header', $data);
				$this->load->view('user/upload_file', $data);
				$this->load->view('user/templates/footer_login');
			} else {
				$nama = $_POST['file_name'];
				$nama_baru = strtolower($nama);
				if ($this->LWD_model->cekNamaFile($nama_baru) > 0) {
					$this->session->set_flashdata('flash', 'File Name is Alredy');
					$this->load->view('user/templates/header', $data);
					$this->load->view('user/upload_file', $data);
					$this->load->view('user/templates/footer_login');
				} else {
					$upload = $this->LWD_model->uploadFile($nama_baru);
					if ($upload['result'] == "success") {
						$this->LWD_model->save($upload, $id);
						$this->session->set_flashdata('flash', 'Success Sending Message');
						redirect('adminlwd', 'refresh');
					} else {
						$this->session->set_flashdata('flash', $upload['error']);
						$this->load->view('user/templates/header', $data);
						$this->load->view('user/upload_file', $data);
						$this->load->view('user/templates/footer_login');
					}
				}
			}
		}
	}
	public function delete_file($id)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$this->LWD_model->hapusFile($id);
			$this->session->set_flashdata('flash', 'Data Success Delete');
			redirect('adminlwd', 'refresh');
		}
	}
	public function edit_file($id_file)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$id = $_SESSION['user_id'];
			$data['login'] = $this->LWD_model->getLogin($id);
			$data['judul'] = 'Edit File';
			$data['edit_file'] = $this->LWD_model->editFile($id_file);
			$data['category'] = $this->LWD_model->getCategory();
			$this->form_validation->set_rules('file_name', 'File Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required|max_length[500]');
			$this->form_validation->set_rules('protection', 'File Name', 'required');
			$this->form_validation->set_rules('category', 'Category', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('user/templates/header', $data);
				$this->load->view('user/edit_file', $data);
				$this->load->view('user/templates/footer_login');
			} else {
				$nama = $_POST['file_name'];
				$nama_lama = $data['edit_file'][0]['name'];
				$nama_baru = strtolower($nama);
				if ($nama === $nama_lama && $_FILES["file"]['error'] != 4) {
					// echo "masuk diawal";
					$upload = $this->LWD_model->uploadFileEdit($nama_baru, $id_file);
					if ($upload['result'] == "success") {
						$this->LWD_model->prosesEditFileDiubah($upload, $id_file);
						$this->session->set_flashdata('flash', 'Success Sending Message');
						redirect('adminlwd', 'refresh');
					} else {
						$this->session->set_flashdata('flash', $upload['error']);
						$this->load->view('user/templates/header', $data);
						$this->load->view('user/upload_file', $data);
						$this->load->view('user/templates/footer_login');
					}
				}
				if ($nama != $nama_lama && $_FILES["file"]['error'] != 4) {
					// echo "Masuk Disini";
					$upload = $this->LWD_model->uploadFileEdit($nama_baru, $id_file);
					if ($upload['result'] == "success") {
						$this->LWD_model->prosesEditNamaDiubah($upload, $id_file);
						$this->session->set_flashdata('flash', 'Success Sending Message');
						redirect('adminlwd', 'refresh');
					} else {
						$this->session->set_flashdata('flash', $upload['error']);
						$this->load->view('user/templates/header', $data);
						$this->load->view('user/upload_file', $data);
						$this->load->view('user/templates/footer_login');
					}
				}
				if ($_FILES["file"]['error'] == 4) {
					// echo "Masuk Di Else";
					$this->LWD_model->prosesEditFileTidakDiubah($id_file);
					$this->session->set_flashdata('flash', 'Success Sending Message');
					redirect('adminlwd', 'refresh');
				}
			}
		}
	}
	public function error_page()
	{
		$this->load->view('user/error');
	}
	public function upload_category_article()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			redirect('error_page', 'refresh');
		} else {
			$id = $_SESSION['user_id'];
			$data['login'] = $this->LWD_model->getLogin($id);
			// echo var_dump($login);
			$data['judul'] = 'Upload  New Category Article';
			$this->form_validation->set_rules('category', 'Category Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required|max_length[500]');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('user/templates/header', $data);
				$this->load->view('user/upload_category_article', $data);
				$this->load->view('user/templates/footer_login');
			} else {
				$this->LWD_model->inputCategory();
				$this->session->set_flashdata('flash', 'Success Sending Message');
				redirect('adminlwd', 'refresh');
			}
		}
	}
}
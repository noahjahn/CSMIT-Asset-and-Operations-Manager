<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// check for user authorization
        $this->load->model('Users_model');
		$this->load->helper("database");
		$this->load->helper("general");
		$this->user_id = $this->session->userdata('id');
	}

	public function index() {

	}

    public function add() {
		log_message('debug', 'Users: add - in function');

		if (!$this->input->is_ajax_request()) {
            // echo $this->output_json(['unauthorized']);
            exit;
        }
		$this->form_validation->set_rules($this->Users_model->get_insert_rules());
		if ($this->form_validation->run() == TRUE) {
			$user = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), //https://www.php.net/manual/en/function.password-hash.php
				'role' => $this->input->post('role'),
				'last_modified_by' => $this->user_id,
				'last_modified_time' => date('Y-m-d H:i:s'),
				'created_by' => $this->user_id,
				'created_time' => date('Y-m-d H:i:s')
			);

			$this->Users_model->insert($user);

			echo json_encode("success");

		} else {
			$errors = array(
                'first_name' => form_error('first_name'),
                'last_name' => form_error('last_name'),
				'email' => form_error('email'),
                'password' => form_error('password'),
				'password_confirm' => form_error('password_confirm'),
				'role' => form_error('role')
            );
			echo json_encode($errors);
		}
    }

	public function validate_first_name() {
		log_message('debug', 'Users: validate_first_name - in function');

		if (!$this->input->is_ajax_request()) {
			// echo $this->output_json(['unauthorized']);
			exit;
		}

		$this->form_validation->set_rules(array($this->Users_model->get_first_name_rules()));
		if ($this->form_validation->run() == TRUE) {
			echo json_encode("success");
		} else {
			log_message('debug', 'Users: validate_first_name - failed to validate first name');
			$errors = array(
				'first_name' => form_error('first_name'),
			);
			echo json_encode($errors);
		}
	}

	public function validate_last_name() {
		log_message('debug', 'Users: validate_last_name - in function');

		if (!$this->input->is_ajax_request()) {
			// echo $this->output_json(['unauthorized']);
			exit;
		}

		$this->form_validation->set_rules(array($this->Users_model->get_last_name_rules()));
		if ($this->form_validation->run() == TRUE) {
			echo json_encode("success");
		} else {
			log_message('debug', 'Users: validate_last_name - failed to validate last name');
			$errors = array(
				'last_name' => form_error('last_name'),
			);
			echo json_encode($errors);
		}
	}

	public function validate_add_email() {
		log_message('debug', 'Users: validate_add_email - in function');

		if (!$this->input->is_ajax_request()) {
			// echo $this->output_json(['unauthorized']);
			exit;
		}

		$this->form_validation->set_rules(array($this->Users_model->get_insert_email_rules()));
		if ($this->form_validation->run() == TRUE) {
			echo json_encode("success");
		} else {
			log_message('debug', 'Users: validate_add_email - failed to validate email');
			$errors = array(
				'email' => form_error('email')
			);
			echo json_encode($errors);
		}
	}

	public function validate_add_password() {
		log_message('debug', 'Users: validate_add_password - in function');

		if (!$this->input->is_ajax_request()) {
			// echo $this->output_json(['unauthorized']);
			exit;
		}

		log_message('debug', 'Users: validate_add_password - password'.$this->input->post('password'));

		$this->form_validation->set_rules(array($this->Users_model->get_insert_password_rules()));
		if ($this->form_validation->run() == TRUE) {
			echo json_encode("success");
		} else {
			log_message('debug', 'Users: validate_add_password - failed to validate password');
			$errors = array(
				'password' => form_error('password')
			);
			echo json_encode($errors);
		}
	}

	public function validate_password_confirm() {
		log_message('debug', 'Users: validate_password_confirm - in function');

		if (!$this->input->is_ajax_request()) {
			// echo $this->output_json(['unauthorized']);
			exit;
		}

		$this->form_validation->set_rules(array($this->Users_model->get_insert_password_rules()));
		$this->form_validation->set_rules(array($this->Users_model->get_password_confirm_rules()));
		if ($this->form_validation->run() == TRUE) {
			echo json_encode("success");
		} else {
			log_message('debug', 'Users: validate_password_confirm - failed to validate password confirm');
			$errors = array(
				'password_confirm' => form_error('password_confirm')
			);
			echo json_encode($errors);
		}
	}

	public function validate_role() {
		log_message('debug', 'Users: validate_role - in function');

		if (!$this->input->is_ajax_request()) {
			// echo $this->output_json(['unauthorized']);
			exit;
		}

		$this->form_validation->set_rules(array($this->Users_model->get_role_rules()));
		if ($this->form_validation->run() == TRUE) {
			echo json_encode("success");
		} else {
			log_message('debug', 'Users: validate_role - failed to validate role');
			$errors = array(
				'role' => form_error('role')
			);
			echo json_encode($errors);
		}
	}

    public function edit() {
		log_message('debug', 'Users: edit - in function');
		if (!$this->input->is_ajax_request()) {
            // echo $this->output_json(['unauthorized']);
            exit;
        }

		$check_password_confirmation = TRUE;
		$password = $this->input->post('password');
		if (null == $password) {
			$check_password_confirmation = FALSE;
		}

		$this->form_validation->set_rules($this->Users_model->get_update_rules($check_password_confirmation));
		if ($this->form_validation->run() == TRUE) {
			$user = array(
				'id' => $this->input->post('id'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'last_modified_by' => $this->user_id,
				'last_modified_time' => date('Y-m-d H:i:s')
			);

			if ($check_password_confirmation) {
				array_push($user, $user['password'] = password_hash($password, PASSWORD_DEFAULT));
			}

			if ($this->Users_model->update($user)) {
				echo json_encode("success");
			} else {
				echo json_encode("error");
			}


		} else {
			$errors = array(
				'first_name' => form_error('first_name'),
                'last_name' => form_error('last_name'),
				'email' => form_error('email'),
				'role' => form_error('role')
            );
			if ($check_password_confirmation) {
				array_push($errors, $errors['password'] = form_error('password'));
				array_push($errors, $errors['password_confirm'] = form_error('password_confirm'));
			}
			echo json_encode($errors);
		}
    }

	public function validate_edit_email() {
		log_message('debug', 'Users: validate_edit_email - in function');

		if (!$this->input->is_ajax_request()) {
			// echo $this->output_json(['unauthorized']);
			exit;
		}

		$this->form_validation->set_rules(array($this->Users_model->get_update_email_rules()));
		if ($this->form_validation->run() == TRUE) {
			echo json_encode("success");
		} else {
			log_message('debug', 'Users: validate_edit_email - failed to validate email');
			$errors = array(
				'email' => form_error('email')
			);
			echo json_encode($errors);
		}
	}

	public function validate_edit_password() {
		log_message('debug', 'Users: validate_edit_password - in function');

		if (!$this->input->is_ajax_request()) {
			// echo $this->output_json(['unauthorized']);
			exit;
		}

		log_message('debug', 'Users: validate_edit_password - password'.$this->input->post('password'));

		$this->form_validation->set_rules(array($this->Users_model->get_update_password_rules()));
		if ($this->form_validation->run() == TRUE) {
			echo json_encode("success");
		} else {
			log_message('debug', 'Users: validate_edit_password - failed to validate password');
			$errors = array(
				'password' => form_error('password')
			);
			echo json_encode($errors);
		}
	}

	public function validate_edit_password_confirm() {
		log_message('debug', 'Users: validate_edit_password_confirm - in function');

		if (!$this->input->is_ajax_request()) {
			// echo $this->output_json(['unauthorized']);
			exit;
		}

		$this->form_validation->set_rules(array($this->Users_model->get_update_password_rules()));
		$this->form_validation->set_rules(array($this->Users_model->get_password_confirm_rules()));
		if ($this->form_validation->run() == TRUE) {
			echo json_encode("success");
		} else {
			log_message('debug', 'Users: validate_edit_password_confirm - failed to validate password confirm');
			$errors = array(
				'password_confirm' => form_error('password_confirm')
			);
			echo json_encode($errors);
		}
	}

    public function delete($id) {
		log_message('debug', 'Users: delete - in function');

        $this->Users_model->delete($id);
    }

	public function get_active() {
		log_message('debug', 'Users: get_active - in function');

		$active_users = $this->Users_model->get_active();
		$json_users = json_encode($active_users, JSON_PRETTY_PRINT);
		echo $json_users;
	}

	function is_email_unique($email) {
		log_message('debug', 'Users: is_email_unique - in function');

		return $this->Users_model->is_email_unique($email);
	}

	function is_email_unique_not_different_from_current($email) {
		log_message('debug', 'Users: is_email_unique_not_different_from_current - in function');

		$id = $this->input->post('id');
		return $this->Users_model->is_email_unique_not_different_from_current($email, $id);
	}

	function id_exists($id) {
		log_message('debug', 'Users: id_exists - in function');

		return $this->Users_model->id_exists($id);
	}
}

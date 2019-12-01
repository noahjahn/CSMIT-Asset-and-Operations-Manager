<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {

    private $table;
    private $user_id;
    private $fields;
    private $permissionable_pages;

    function __construct() {
        parent::__construct();
        $this->load->helper('database');
        $this->table = "roles";
        $this->user_id = $this->session->userdata('id');
        $this->fields = array(
            'id' => 'id',
            'name' => 'name',
            'dashboard' => 'dashboard',
            'asset_manager' => 'asset_manager',
            'reports' => 'reports',
            'asset_groups' => 'asset_groups',
            'users' => 'users',
            'roles' => 'roles',
            'login_photos' => 'login_photos',
            'is_deleted' => 'is_deleted',
            'last_modified_by' => 'last_modified_by',
            'last_modified_time' => 'last_modified_time',
            'created_by' => 'created_by',
            'created_time' => 'created_time'
        );
        $this->permissionable_pages = array(
            'dashboard',
            'asset_manager',
            'reports',
            'asset_groups',
            'users',
            'roles',
            'login_photos'
        );
    }

    function get_page_access($id, $page) {
        log_message('debug', 'Roles_model: get_page_access - in function. id='.$id.',page='.$page);

        if ($this->id_exists($id) && !(record_is_deleted($id, $this->table))) {
            if (in_array($page, $this->permissionable_pages)) {
                $this->db->select($page);
                $this->db->from($this->table);
                $this->db->where('id', $id);
                return $this->db->get()->result_array()[0][$page];
            } else {
                log_message('debug', 'Roles_model: get_page_access - page not in permissionable pages. page='.$page);
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function get_settings_access($id) {
        log_message('debug', 'Roles_model: get_settings_access - in function');

        if ($this->id_exists($id) && !(record_is_deleted($id, $this->table))) {
            $tabs = array(
                'asset_groups' => $this->get_page_access($id, 'asset_groups'),
                'users' => $this->get_page_access($id, 'users'),
                'roles' => $this->get_page_access($id, 'roles'),
                'login_photos' => $this->get_page_access($id, 'login_photos')
            );
            return $tabs;
        } else {
            return FALSE;
        }
    }

    // function get_insert_rules() {
    //     log_message('debug', 'Users_model: get_insert_rules - in function');
    //
    //     $form_rules = array(
    //         $this->get_first_name_rules(),
    //         $this->get_last_name_rules(),
    //         $this->get_insert_email_rules(),
    //         $this->get_insert_password_rules(),
    //         $this->get_password_confirm_rules(TRUE),
    //         $this->get_role_rules()
    //     );
    //     return $form_rules;
    // }
    //
    // function get_first_name_rules() {
    //     log_message('debug', 'Users_model: get_insert_first_name_rules - in function');
    //     $first_name_rules = array(
    //         'field' => $this->fields['first_name'],
    //         'label' => 'first name',
    //         'rules' => 'required|trim',
    //     );
    //     return $first_name_rules;
    // }
    //
    // function get_last_name_rules() {
    //     log_message('debug', 'Users_model: get_insert_last_name_rules - in function');
    //     $last_name_rules = array(
    //         'field' => $this->fields['last_name'],
    //         'label' => 'last name',
    //         'rules' => 'required|trim',
    //     );
    //     return $last_name_rules;
    // }
    //
    // function get_insert_email_rules() {
    //     log_message('debug', 'Users_model: get_insert_email_rules - in function');
    //     $email_rules = array(
    //         'field' => $this->fields['email'],
    //         'label' => 'email',
    //         'rules' => 'required|valid_email|callback_is_email_unique|trim',
    //         'errors' => array(
    //             'is_email_unique' => 'The %s field must contain a unique value.'
    //         )
    //     );
    //     return $email_rules;
    // }
    //
    // function get_insert_password_rules() {
    //     log_message('debug', 'Users_model: get_insert_password_rules - in function');
    //     $password_rules = array(
    //         'field' => $this->fields['password'],
    //         'label' => 'password',
    //         'rules' => 'required|min_length[8]',
    //     );
    //     return $password_rules;
    // }
    //
    // function get_password_confirm_rules($check_password_confirmation) {
    //     log_message('debug', 'Users_model: get_password_confirm_rules - in function');
    //     $password_confirm_rules = array(
    //         'field' => 'password_confirm',
    //         'label' => 'password confirmation',
    //     );
    //
    //     if ($check_password_confirmation) {
    //         array_push($password_confirm_rules, $password_confirm_rules['rules']='required|matches[password]');
    //     } else {
    //         array_push($password_confirm_rules, $password_confirm_rules['rules']='');
    //     }
    //
    //     return $password_confirm_rules;
    // }
    //
    // function get_role_rules() {
    //     log_message('debug', 'Users_model: get_insert_role_rules - in function');
    //     $role_rules = array(
    //         'field' => $this->fields['role'],
    //         'label' => 'role',
    //         'rules' => 'required',
    //     );
    //     return $role_rules;
    // }
    //
    // function get_update_rules($check_password_confirmation) {
    //     log_message('debug', 'Users_model: get_update_rules - in function');
    //     $form_rules = array (
    //         $this->get_update_id_rules(),
    //         $this->get_first_name_rules(),
    //         $this->get_last_name_rules(),
    //         $this->get_update_email_rules(),
    //         $this->get_update_password_rules(),
    //         $this->get_password_confirm_rules($check_password_confirmation),
    //         $this->get_role_rules()
    //     );
    //     return $form_rules;
    // }
    //
    // function get_update_id_rules() {
    //     log_message('debug', 'Users_model: get_update_id_rules - in function');
    //     $id_rules = array(
    //         'field' => $this->fields['id'],
    //         'label' => 'id',
    //         'rules' => 'required|callback_id_exists|trim',
    //         'errors' => array (
    //             'id_exists' => 'The %s field does not exist.'
    //         )
    //     );
    //     return $id_rules;
    // }
    //
    // function get_update_email_rules() {
    //     log_message('debug', 'Users_model: get_update_email_rules - in function');
    //     $email_rules = array(
    //         'field' => $this->fields['email'],
    //         'label' => "email",
    //         'rules' => 'required|valid_email|callback_is_email_unique_not_different_from_current|trim',
    //         'errors' => array(
    //             'is_email_unique_not_different_from_current' => 'The %s field must contain a unique value.'
    //         )
    //     );
    //     return $email_rules;
    // }
    //
    // function get_update_password_rules() {
    //     log_message('debug', 'Users_model: get_update_password_rules - in function');
    //     $password_rules = array(
    //         'field' => $this->fields['password'],
    //         'label' => 'password',
    //         'rules' => 'min_length[8]',
    //     );
    //     return $password_rules;
    // }
    //
    function get_table_columns() {
        log_message('debug', 'Users_model: get_table_columns - in function');
        $return = '';
        $number_of_fields = count($this->fields);
        $i = 0;
        foreach ($this->fields as $field => $value) {
            if ($i == $number_of_fields - 1) {
                $return .= $this->fields[$field];
            } else {
                $return .= $this->fields[$field].', ';
            }
            $i++;
        }

        log_message('debug', 'Users_model: get_table_columns - columns: '.$return);
        return $return;
    }

    function get_active() {
        log_message('debug', 'Users_model: get_active - in function');


        $this->db->select($this->get_table_columns());
        $this->db->from($this->table);
        $this->db->where('is_deleted', FALSE);
        return $this->db->get()->result_array();
    }

    // function insert($user) {
    //     log_message('debug', 'Users_model: insert - in function');
    //
    //     if ($this->is_email_unique($user['email'])) { // if it's unique, add it
    //         $this->db->insert($this->table, $user);
    //     } else {
    //         log_message('error', 'Users_model: insert - failed, record '.$user['email'].' isn\'t unique');
    //         return FALSE;
    //     }
    // }
    //
    // function update($user) {
    //     log_message('debug', 'Users_model: update - in function');
    //
    //     // check if user passed in exists and is active
    //     if (record_exists($user['id'], $this->table) && !(record_is_deleted($user['id'], $this->table))) {
    //
    //         if ($this->is_email_unique_not_different_from_current($user['email'], $user['id'])) {
    //             log_message('debug', 'Users_model: update - in function '.json_encode($user));
    //             $this->db->where('id', $user['id']);
    //             $this->db->update($this->table, $user);
    //             return TRUE;
    //         } else {
    //             log_message('error', 'Users_model: update - failed, record '.$user['email'].' isn\'t unique');
    //             return FALSE;
    //         }
    //     } else {
    //         log_message('error', 'Users_model: update - failed, record '.$user['id'].' doesn\'t exist or is inactive');
    //         return FALSE;
    //     }
    // }
    //
    // function delete($id) {
    //     log_message('debug', 'Users_model: delete - in function');
    //
    //     // check if user passed in exists and is not deleted
    //     if (record_exists($id, $this->table) && !(record_is_deleted($id, $this->table))) {
    //         // if it is, set is_deleted to 1, this is a soft delete
    //         if (set_last_modified_by($id, $this->user_id, $this->table)) {
    //             if (set_last_modified_time($id, $this->table)) {
    //                 $this->db->set('is_deleted', '1');
    //                 $this->db->where('id', $id);
    //                 return $this->db->update($this->table);
    //             } else {
    //                 log_message('error', 'Users_model: delete - failed to set last modified time. Record id: '.$id.' Table: '.$this->table);
    //                 return FALSE; // failed to set last modified time
    //             }
    //         } else {
    //             log_message('error', 'Users_model: delete - failed to set last modified by. Record id: '.$id.' User id: '.$id.' Table: '.$this->table);
    //             return FALSE;  // failed to set last modified by
    //         }
    //     } else {
    //         log_message('error', 'Users_model: delete - failed, record '.$id.' doesn\'t exist or is deleted');
    //         return FALSE; // failed, record doesn't exist or is deleted
    //     }
    // }
    //
    // function is_email_unique($email) {
    //     log_message('debug', 'Users_model: is_email_unique - in function');
    //
    //     $this->db->select($this->get_table_columns());
    //     $this->db->from($this->table);
    //     $this->db->where($this->fields['email'], $email);
    //     $this->db->where('is_deleted', 0);
    //
    //     $query = $this->db->get();
    //
    //     if ($query->num_rows() == 0) {
    //         return TRUE;
    //     } else {
    //         log_message('debug', 'Users_model: is_email_unique - found more than one record with the same name '.$email);
    //         return FALSE;
    //     }
	// }
    //
    // function is_email_unique_not_different_from_current($email, $id) {
    //     log_message('debug', 'Users_model: is_email_unique_not_different_from_current - in function');
    //
    //     $this->db->select($this->get_table_columns());
    //     $this->db->from($this->table);
    //     $this->db->where('email', $email);
    //     $this->db->where('is_deleted', 0);
    //
    //     $query = $this->db->get();
    //
    //     if ($query->num_rows() == 1) {
    //         if ($query->result_array()[0]['id'] == $id) {
    //             return TRUE;
    //         } else {
    //             log_message('error', 'Users_model: is_email_unique_not_different_from_current - the email '.$email.' entered already exists. id='.$id);
    //             return FALSE;
    //         }
    //     } else if ($query->num_rows() == 0) {
    //         log_message('debug', 'Users_model: is_email_unique_not_different_from_current - a new email has been entered: '.$email);
    //         return TRUE;
    //     } else {
    //         log_message('error', 'Users_model: is_email_unique_not_different_from_current - found more than one record with the same email: '.$email);
    //         return FALSE;
    //     }
	// }
    //
    function id_exists($id) {
        log_message('debug', 'Roles_model: id_exists - in function');
        return record_exists($id, $this->table);
    }
}

?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssetManager_model extends CI_Model {

    private $table;
    private $user_id;
    private $fields;

    function __construct() {
        parent::__construct();
        $this->table = "assets";
        $this->user_id = $this->session->userdata('id');
        $this->fields = array(
            'id' => 'id',
            'model_id' => 'model_id',
            'owner' => 'owner',
            'serial_number' => 'serial_number',
            'asset_tag' => 'asset_tag',
            'phone_number' => 'phone_number',
            'imei' => 'imei',
            'purchase_price' => 'purchase_price',
            'purchase_date' => 'purchase_date',
            'team_id' => 'team_id',
            'job_number' => 'job_number',
            'is_deleted' => 'is_deleted',
            'last_modified_by' => 'last_modified_by',
            'last_modified_time' => 'last_modified_time',
            'created_by' => 'created_by',
            'created_time' => 'created_time'
        );
    }

    function get_insert_rules() {
        log_message('debug', 'AssetManager_model: get_insert_rules - in function');

        $form_rules = array(
            $this->get_insert_model_id_rules(),
            $this->get_insert_owner_rules(),
            $this->get_insert_serial_number_rules(),
            $this->get_insert_asset_tag_rules(),
            $this->get_insert_team_id_rules(),
            $this->get_insert_phone_number_rules(),
            $this->get_insert_imei_rules(),
            $this->get_insert_purchase_price_rules(),
            $this->get_insert_purchase_date_rules(),
            $this->get_insert_job_number_rules(),
        );
        return $form_rules;
    }

    function get_insert_model_id_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_model_id_rules - in function');
        $model_id_rules = array(
            'field' => $this->fields['model_id'],
            'label' => 'model',
            'rules' => 'required|callback_model_exists|trim',
            'errors' => array (
                'model_exists' => 'The model selected doesn\'t exist.'
            )
        );
        return $model_id_rules;
    }

    function get_insert_owner_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_owner_rules - in function');
        $owner_rules = array(
            'field' => $this->fields['owner'],
            'label' => $this->fields['owner'],
            'rules' => 'required|trim',
        );
        return $owner_rules;
    }

    function get_insert_serial_number_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_serial_number_rules - in function');
        $serial_number_rules = array(
            'field' => $this->fields['serial_number'],
            'label' => $this->fields['serial_number'],
            'rules' => 'callback_is_serial_number_unique|trim',
            'errors' => array (
                'is_serial_number_unique' => 'The %s field must contain a unique value.'
            )
        );
        return $serial_number_rules;
    }

    function get_insert_asset_tag_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_asset_tag_rules - in function');
        $asset_tag_rules = array(
            'field' => $this->fields['asset_tag'],
            'label' => 'asset tag',
            'rules' => 'callback_is_asset_tag_unique|trim',
            'errors' => array (
                'is_asset_tag_unique' => 'The %s field must contain a unique value.'
            )
        );
        return $asset_tag_rules;
    }

    function get_insert_team_id_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_team_id_rules - in function');
        $team_id_rules = array(
            'field' => $this->fields['team_id'],
            'label' => 'team',
            'rules' => 'required|callback_team_exists|trim',
            'errors' => array (
                'team_exists' => 'The team selected doesn\'t exist.'
            )
            
        );
        return $team_id_rules;
    }

    function get_insert_phone_number_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_phone_number_rules - in function');
        $phone_number_rules = array(
            'field' => $this->fields['phone_number'],
            'label' => 'phone number',
            'rules' => 'trim',
        );
        return $phone_number_rules;
    }

    function get_insert_imei_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_imei_rules - in function');
        $imei_rules = array(
            'field' => $this->fields['imei'],
            'label' => 'imei',
            'rules' => 'trim',
        );
        return $imei_rules;
    }

    function get_insert_purchase_price_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_purchase_price_rules - in function');
        $purchase_price_rules = array(
            'field' => $this->fields['purchase_price'],
            'label' => $this->fields['purchase_price'],
            'rules' => 'trim',
        );
        return $purchase_price_rules;
    }

    function get_insert_purchase_date_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_purchase_date_rules - in function');
        $purchase_date_rules = array(
            'field' => $this->fields['purchase_date'],
            'label' => $this->fields['purchase_date'],
            'rules' => 'trim',
        );
        return $purchase_date_rules;
    }

    function get_insert_job_number_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_job_number_rules - in function');
        $job_number_rules = array(
            'field' => $this->fields['job_number'],
            'label' => $this->fields['job_number'],
            'rules' => 'trim',
        );
        return $job_number_rules;
    }

    function get_insert_notes_rules() {
        log_message('debug', 'AssetManagers_model: get_insert_notes_rules - in function');
        $notes_rules = array(
            'field' => $this->fields['notes'],
            'label' => $this->fields['notes'],
            'rules' => 'trim',
        );
        return $notes_rules;
    }

    function get_update_rules() {
        log_message('debug', 'AssetManager_model: get_update_rules - in function');

        $form_rules = array(
            $this->get_insert_model_id_rules(),
            $this->get_insert_owner_rules(),
            $this->get_update_serial_number_rules(),
            $this->get_update_asset_tag_rules(),
            $this->get_insert_team_id_rules(),
            $this->get_insert_phone_number_rules(),
            $this->get_insert_imei_rules(),
            $this->get_insert_purchase_price_rules(),
            $this->get_insert_purchase_date_rules(),
            $this->get_insert_job_number_rules(),
        );
        return $form_rules;
    }

    function get_update_serial_number_rules() {
        log_message('debug', 'AssetManagers_model: get_update_serial_number_rules - in function');
        $serial_number_rules = array(
            'field' => $this->fields['serial_number'],
            'label' => 'serial number',
            'rules' => 'trim|callback_is_serial_number_unique_not_different_from_current',
            'errors' => array (
                'is_serial_number_unique_not_different_from_current' => 'The %s field must contain a unique value.'
            )
        );
        return $serial_number_rules;
    }

    function get_update_asset_tag_rules() {
        log_message('debug', 'AssetManagers_model: get_update_asset_tag_rules - in function');
        $asset_tag_rules = array(
            'field' => $this->fields['asset_tag'],
            'label' => 'asset tag',
            'rules' => 'callback_is_asset_tag_unique_not_different_from_current|trim',
            'errors' => array (
                'is_asset_tag_unique_not_different_from_current' => 'The %s field must contain a unique value.'
            )
        );
        return $asset_tag_rules;
    }

    public function get_active() {
        $this->db->select('
            assets.id,
            assets.owner,
            assets.serial_number,
            assets.asset_tag,
            assets.phone_number,
            assets.imei,
            assets.purchase_price,
            assets.purchase_date,
            assets.job_number,
            assets.notes,
            assets.last_modified_time,
            teams.id as team_id,
            teams.name as team,
            models.id as model_id,
            models.name as model,
            models.rate as rate,
            manufacturers.id as manufacturer_id,
            manufacturers.name as manufacturer,
            asset_types.id as type_id,
            asset_types.name as type
        ');

        $this->db->from('assets');
        $this->db->join('teams', 'assets.team_id = teams.id');
        $this->db->join('models', 'assets.model_id = models.id');
        $this->db->join('manufacturers', 'models.manufacturer_id = manufacturers.id');
        $this->db->join('asset_types', 'models.type_id = asset_types.id');
        $this->db->where('assets.is_deleted', FALSE);
        $query = $this->db->get()->result_array();

        return $query;
    }

    function insert($asset) {
        log_message('debug', 'AssetManager_model: insert - in function');
        $this->db->insert($this->table, $asset);
    }

    function update($asset) {
        log_message('debug', 'AssetManager_model: update - in function');

        // check if asset passed in exists and is active
        if (record_exists($asset['id'], $this->table) && !(record_is_deleted($asset['id'], $this->table))) {
            // if it is, update it
            if ($this->is_asset_tag_unique_not_different_from_current($asset['asset_tag'], $asset['id'])) {
                if ($this->is_serial_number_unique_not_different_from_current($asset['serial_number'], $asset['id'])) {
                    $this->db->where('id', $asset['id']);
                    $this->db->update($this->table, $asset);
                } else {
                    log_message('error', 'AssetManager_model: update - failed, record '.$asset['serial_number'].' isn\'t unique');
                    return FALSE;
                }
            } else {
                log_message('error', 'AssetManager_model: update - failed, record '.$asset['asset_tag'].' isn\'t unique');
                return FALSE;
            }
        } else {
            log_message('error', 'AssetManager_model: update - failed, record '.$asset['id'].' doesn\'t exist or is inactive');
            return FALSE;
        }
    }

    function delete($id) {
        log_message('debug', 'AssetManager_model: delete - in function');

        // check if model passed in exists and is not deleted
        if (record_exists($id, $this->table) && !(record_is_deleted($id, $this->table))) {
            // if it is, set is_deleted to 1, this is a soft delete
            if (set_last_modified_by($id, $this->user_id, $this->table)) {
                if (set_last_modified_time($id, $this->table)) {
                    $this->db->set('is_deleted', '1');
                    $this->db->where('id', $id);
                    return $this->db->update($this->table);
                } else {
                    log_message('error', 'AssetManager_model: delete - failed to set last modified time. Record id: '.$id.' Table: '.$this->table);
                    return FALSE; // failed to set last modified time
                }
            } else {
                log_message('error', 'AssetManager_model: delete - failed to set last modified by. Record id: '.$id.' User id: '.$id.' Table: '.$this->table);
                return FALSE;  // failed to set last modified by
            }
        } else {
            log_message('error', 'AssetManager_model: delete - failed, record '.$id.' doesn\'t exist or is deleted');
            return FALSE; // failed, record doesn't exist or is deleted
        }
    }

    function get_count_by_asset_type($asset_type) {
        log_message('debug', 'AssetManager_model: get_count_by_asset_type - in function. asset_type='.$asset_type);

        $this->db->select('assets.id');
        $this->db->from('assets');
        $this->db->join('models', 'assets.model_id = models.id');
        $this->db->join('asset_types', 'models.type_id = asset_types.id');
        $this->db->where('asset_types.name', $asset_type);
        $this->db->where('assets.is_deleted', FALSE);

        $query = $this->db->get();

        $num_rows = $query->num_rows();

        log_message('debug', 'AssetManager_model: get_count_by_asset_type - num_rows='.$num_rows);

        return $num_rows;
    }

    function get_count_by_model($model) {
        log_message('debug', 'AssetManager_model: get_count_by_model - in function. model='.$model['name']);
        $this->db->select('assets.id');
        $this->db->from('assets');
        $this->db->join('models', 'assets.model_id = models.id');
        $this->db->where('models.name', $model['name']);
        $this->db->where('assets.is_deleted', FALSE);

        $query = $this->db->get();

        $num_rows = $query->num_rows();

        log_message('debug', 'AssetManager_model: get_count_by_model - num_rows='.$num_rows);

        return $num_rows;
    }

    public function is_serial_number_unique($serial_number) {
        log_message('debug', 'AssetManager_model: is_serial_number_unique - in function');
        
        if (!isset($serial_number) || $serial_number == NULL) {
            return TRUE;
        }

        $this->db->select($this->fields['serial_number']);
        $this->db->from($this->table);
        $this->db->where('serial_number', $serial_number);
        $this->db->where('is_deleted', 0);

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return TRUE;
        } else {
            log_message('debug', 'AssetManager_model: is_serial_number_unique - found more than one record with the same serial number '.$serial_number);
            return FALSE;
        }
    }

    public function is_asset_tag_unique($asset_tag) {
        log_message('debug', 'AssetManager_model: is_asset_tag_unique - in function');
        
        if (!isset($asset_tag) || $asset_tag == NULL) {
            return TRUE;
        }

        $this->db->select($this->fields['asset_tag']);
        $this->db->from($this->table);
        $this->db->where('asset_tag', $asset_tag);
        $this->db->where('is_deleted', 0);

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return TRUE;
        } else {
            log_message('debug', 'AssetManager_model: is_asset_tag_unique - found more than one record with the same asset tag '.$asset_tag);
            return FALSE;
        }
    }

    function is_serial_number_unique_not_different_from_current($serial_number, $id) {
        log_message('debug', 'AssetManager_model: is_serial_number_unique_not_different_from_current - in function');
        if (isset($serial_number) && $serial_number != '') {
            log_message('debug', $serial_number);
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('serial_number', $serial_number);
            $this->db->where('is_deleted', 0);

            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                if ($query->result_array()[0]['id'] == $id) {
                    return TRUE;
                } else {
                    log_message('error', 'AssetManager_model: is_serial_number_unique_not_different_from_current - the serial number '.$serial_number.' entered already exists');
                    return FALSE;
                }
            } else if ($query->num_rows() == 0) {
                log_message('debug', 'AssetManager_model: is_serial_number_unique_not_different_from_current - a new serial number has been entered: '.$serial_number);
                return TRUE;
            } else {
                log_message('error', 'AssetManager_model: is_serial_number_unique_not_different_from_current - found more than one record with the same serial number: '.$serial_number);
                return FALSE;
            }
        } else {
            return TRUE;
        }
	}

    function is_asset_tag_unique_not_different_from_current($asset_tag, $id) {
        log_message('debug', 'AssetManager_model: is_asset_tag_unique_not_different_from_current - in function');

        if (!isset($asset_tag) || $asset_tag == NULL) {
            return TRUE;
        }

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('asset_tag', $asset_tag);
        $this->db->where('is_deleted', 0);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            if ($query->result_array()[0]['id'] == $id) {
                return TRUE;
            } else {
                log_message('error', 'AssetManager_model: is_asset_tag_unique_not_different_from_current - the asset tag '.$asset_tag.' entered already exists');
                return FALSE;
            }
        } else if ($query->num_rows() == 0) {
            log_message('debug', 'AssetManager_model: is_asset_tag_unique_not_different_from_current - a new asset tag has been entered: '.$asset_tag);
            return TRUE;
        } else {
            log_message('error', 'AssetManager_model: is_asset_tag_unique_not_different_from_current - found more than one record with the same asset tag: '.$asset_tag);
            return FALSE;
        }
	}
}

?>

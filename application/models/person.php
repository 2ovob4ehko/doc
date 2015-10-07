<?
class Person extends CI_Model {

	var $id ='';
	var $login ='';
	var $pub_key ='';
	var $f_name ='';
	var $s_name ='';
	var $surname ='';
	var $priv_surname ='';
	var $blood ='';
	var $sex ='';
	var $born ='';
	var $photo ='';

	function __construct()
    {
        parent:: __construct();
    }
	function insert_new($data) {
		if(!empty($data)) {
			$this->db->insert('person', $data);
			return true;
		} else return false;
	}
	function get_all() {
		$query = $this->db->get('person');
		return $query->result();
	}
	function get_by_id($id) {
		if(!empty($id)) {
			$this->db->where('id', $id);
			$query = $this->db->get('person');
			return $query->result();
		} else return false;
	}
	function get_by_born($born) {
		if(!empty($born)) {
			$this->db->where('born', $born);
			$query = $this->db->get('person');
			return $query->result();
		} else return false;
	}
	function get_by_login($login) {
		if(!empty($login)) {
			$this->db->where('login', $login);
			$query = $this->db->get('person');
			return $query->result();
		} else return false;
	}
}
?>

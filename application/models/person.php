<?
class Person extends CI_Model {

	var $id ='';
	var $login ='';
	var $pub_key =''; //публічний ключ, який генерується організацією реєстратором при створенні ключів.
	var $f_name ='';
	var $s_name ='';
	var $surname ='';
	var $priv_surname =''; //при зміні прізвища сюди пишеться попереднє
	var $blood ='';
	var $sex ='';
	var $born ='';
	var $photo ='';
	var $register =''; //ід організації, що зареєструвала цю фізичну особу

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
			$this->db->select('person.*,blood.name as `blood_name`,sex.name as `sex_name`');
			$this->db->from('person');
			$this->db->join('blood', 'blood.id = person.blood');
			$this->db->join('sex', 'sex.id = person.sex');
			$this->db->where('person.id', $id);
			$query = $this->db->get();
			return $query->result()[0];
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
			$this->db->select('person.*,blood.name as `blood_name`,sex.name as `sex_name`');
			$this->db->from('person');
			$this->db->join('blood', 'blood.id = person.blood');
			$this->db->join('sex', 'sex.id = person.sex');
			$this->db->where('login', $login);
			$query = $this->db->get();
			return $query->result()[0];
		} else return false;
	}
	function get_by_register($register) {
		if(!empty($register)) {
			$this->db->select('person.*,blood.name as `blood_name`,sex.name as `sex_name`');
			$this->db->from('person');
			$this->db->join('blood', 'blood.id = person.blood');
			$this->db->join('sex', 'sex.id = person.sex');
			$this->db->where('person.register', $register);
			$query = $this->db->get();
			return $query->result();
		} else return false;
	}
}
?>

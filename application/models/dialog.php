<?
class Dialog extends CI_Model {
/*http://www.9lessons.info/2013/05/message-conversation-database-design.html*/
	var $id ='';
	var $person_one ='';
	var $person_two ='';

	function __construct()
    {
        parent:: __construct();
    }
	function insert_new($data) {
		if(!empty($data)) {
			$this->db->insert('dialog', $data);
			return $this->db->insert_id();
		} else return false;
	}
	function get_all() {
		$query = $this->db->get('messages');
		return $query->result();
	}
	function get_last_by_person($person) {
		if(!empty($person)) {
			$this->db->select('messages.*');
			$this->db->from('messages');
			$this->db->where('id_from', $person);
			$this->db->or_where('id_to', $person);
			$this->db->order_by("time","desc");
			$this->db->group_by("id_from");
			$this->db->group_by("id_to");
			$query = $this->db->get();
			return $query->result();
		} else return false;
	}
	function get_if_exist($person_one,$person_two) {
		if(!empty($person_one)&&!empty($person_one)){
			$query = $this->db->query('SELECT * FROM dialog WHERE (person_one="'.$person_one.'" AND person_two="'.$person_two.'") OR (person_two="'.$person_one.'" AND person_one="'.$person_two.'")');
			return count($query->result());
		} else return false;
	}
	function get_permission($dialog,$person) {
		if(!empty($dialog)){
			$query = $this->db->query('SELECT * FROM dialog WHERE dialog="'.$dialog.'" AND (person_one="'.$person.'" OR person_two="'.$person.'")');
			return count($query->result());
		} else return false;
	}
	function get_by_person($person) {
		if(!empty($person)){
			$query = $this->db->query('SELECT * FROM dialog WHERE person_one="'.$person.'" OR person_two="'.$person.'"');
			return $query->result()[0];
		} else return false;
	}
}
?>

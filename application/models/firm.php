<?
class Firm extends CI_Model {

	var $id ='';
	var $name ='';
	var $owner_id ='';
	var $logo ='';
	var $create_date ='';
	var $close_date ='';

	function __construct()
    {
        parent:: __construct();
    }
	function insert_new($data) {
		if(!empty($data)) {
			$this->db->insert('firm', $data);
			return true;
		} else return false;
	}
	function get_all() {
		$this->db->select('person.login,firm.*');
		$this->db->from('firm');
		$this->db->join('person', 'firm.owner_id = person.id');
		$query = $this->db->get();
		return $query->result();
	}
	function get_by_id($id) {
		if(!empty($id)) {
			$this->db->select('person.login,firm.*');
			$this->db->from('firm');
			$this->db->join('person', 'firm.owner_id = person.id');
			$this->db->where('firm.id', $id);
			$query = $this->db->get();
			return $query->result()[0];
		} else return false;
	}
}
?>

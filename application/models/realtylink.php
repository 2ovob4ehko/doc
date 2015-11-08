<?
class Realtylink extends CI_Model {

	var $id ='';
	var $person ='';
	var $realty ='';
	var $property ='';
	var $square ='';

	function __construct()
    {
        parent:: __construct();
    }
	function insert_new($data) {
		if(!empty($data)) {
			$this->db->insert('realty_link', $data);
			return true;
		} else return false;
	}
	function get_all() {
		$query = $this->db->get('realty_link');
		return $query->result();
	}
	function get_by_id($id) {
		if(!empty($id)) {
			$this->db->select('realty.*,realty_type.name as `realty_type`');
			$this->db->from('realty');
			$this->db->join('realty_type', 'realty_type.id = realty.type');
			$this->db->where('realty.id', $id);
			$query = $this->db->get();
			return $query->result()[0];
		} else return false;
	}
}
?>

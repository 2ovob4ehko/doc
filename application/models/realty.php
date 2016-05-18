<?
class Realty extends CI_Model {

	var $id ='';
	var $address ='';
	var $square ='';
	var $type ='';
	var $rooms ='';
	var $date ='';
	var $register ='';

	function __construct()
    {
        parent:: __construct();
    }
	function insert_new($data) {
		if(!empty($data)) {
			$this->db->insert('realty', $data);
			return $this->db->insert_id();
		} else return false;
	}
	function get_all() {
		$query = $this->db->get('realty');
		return $query->result();
	}
	function get_by_register($register,$n,$page) {
		if(!empty($register)) {
			$this->db->select('realty.*,realty_type.name,realty_link.person');
			$this->db->from('realty');
			$this->db->join('realty_type', 'realty_type.id = realty.type');
			$this->db->join('realty_link', 'realty_link.realty = realty.id');
			$this->db->where('realty.register', $register);
			$this->db->where('realty_link.property', 1);
			$this->db->order_by("realty.id","desc");
			$this->db->limit($n*$page);
			$query = $this->db->get();
			return $query->result();
		} else return false;
	}
	function get_by_person($person) {
		if(!empty($person)) {
			$this->db->select('realty.id,realty.address,realty_type.name as realty_type,realty_link.square,property_type.name as property_type');
			$this->db->from('realty');
			$this->db->join('realty_type', 'realty_type.id = realty.type');
			$this->db->join('realty_link', 'realty_link.realty = realty.id');
			$this->db->join('property_type', 'property_type.id = realty_link.property');
			$this->db->where('realty_link.person', $person);
			$this->db->order_by("realty.id","desc");
			$query = $this->db->get();
			return $query->result();
		} else return false;
	}
	function get_by_owner($person) {
		if(!empty($person)) {
			$this->db->select('realty.id,realty.address,realty_type.name as realty_type,realty_link.square,property_type.name as property_type');
			$this->db->from('realty');
			$this->db->join('realty_type', 'realty_type.id = realty.type');
			$this->db->join('realty_link', 'realty_link.realty = realty.id');
			$this->db->join('property_type', 'property_type.id = realty_link.property');
			$this->db->where('realty_link.person', $person);
			$this->db->where('property_type.id', 1);
			$this->db->order_by("realty.id","desc");
			$query = $this->db->get();
			return $query->result();
		} else return false;
	}
}
?>

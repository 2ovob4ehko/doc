<?
class Medic extends CI_Model {

	var $id ='';
	var $person ='';
	var $parameter ='';
	var $value ='';
	var $exam_date ='';

	function __construct()
    {
        parent:: __construct();
    }
	function get_last_by_person($person) {
		if(!empty($person)) {
			$this->db->select('medic.parameter,medic.value,medic.exam_date');
			$this->db->from('perent');
			$this->db->join('person', 'person.id = perent.perent');
			$this->db->where('person', $person);
			$query = $this->db->get();
			return $query->result();
		} else return false;
	}
}
?>

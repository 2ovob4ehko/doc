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
			$this->db->select('medic.value,medic.exam_date,medic_parameter.name');
			$this->db->from('medic');
			$this->db->join('medic_parameter', 'medic_parameter.id = medic.parameter');
			$this->db->where('person', $person);
			$query = $this->db->get();
			return $query->result();
		} else return false;
	}
}
?>

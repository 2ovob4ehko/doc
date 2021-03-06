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
	function insert_new($data) {
		if(!empty($data)) {
			$this->db->insert('medic', $data);
			return true;
		} else return false;
	}
	function get_last_by_person($person) {
		if(!empty($person)) {
			$query = $this->db->query('SELECT * FROM (SELECT medic.parameter, medic.value, medic.exam_date, medic_parameter.name FROM medic JOIN medic_parameter ON(medic_parameter.id = medic.parameter) WHERE person = "'.$person.'" ORDER BY medic.exam_date DESC) AS x GROUP BY x.parameter');
			return $query->result();
		} else return false;
	}
	function get_by_person($person) {
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

<?
class Perent extends CI_Model {

	var $id ='';
	var $person ='';
	var $perent ='';

	function __construct()
    {
        parent:: __construct();
    }
	function get_by_person($person) {
		if(!empty($person)) {
			$this->db->select('person.id,person.f_name,person.s_name,person.surname,person.priv_surname');
			$this->db->from('perent');
			$this->db->join('person', 'person.id = perent.perent');
			$this->db->where('person', $person);
			$query = $this->db->get();
			return $query->result();
		} else return false;
	}
}
?>

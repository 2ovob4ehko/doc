<?
class Workfor extends CI_Model {

	var $id ='';
	var $person ='';
	var $firm ='';
	var $job_title ='';
	var $start ='';
	var $stop ='';

	function __construct()
    {
        parent:: __construct();
    }
	function insert_new($data) {
		if(!empty($data)) {
			$this->db->insert('work_for', $data);
			return true;
		} else return false;
	}
	function get_all() {
		$query = $this->db->get('work_for');
		return $query->result();
	}
	function get_by_person($person) {
		if(!empty($person)) {
			$this->db->select('job_title.name as job_title,firm.name as firm,work_for.start,work_for.stop');
			$this->db->from('work_for');
			$this->db->join('firm', 'firm.id = work_for.firm');
			$this->db->join('job_title', 'job_title.id = work_for.job_title');
			$this->db->where('person', $person);
			$query = $this->db->get();
			return $query->result();
		} else return false;
	}
}
?>

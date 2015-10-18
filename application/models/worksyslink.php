<?
class Worksyslink extends CI_Model {

	var $id ='';
	var $firm ='';
	var $job_title ='';
	var $work_system ='';

	function __construct()
    {
        parent:: __construct();
    }
	function insert_new($data) {
		if(!empty($data)) {
			$this->db->insert('work_system_link', $data);
			return true;
		} else return false;
	}
	function get_all() {
		$query = $this->db->get('work_system_link');
		return $query->result();
	}
	function get_by_jobfirm($job,$firm) {
		if(!empty($job)&&!empty($firm)) {
			$this->db->select('work_system.system');
			$this->db->from('work_system_link');
			$this->db->join('work_system', 'work_system.id = work_system_link.work_system');
			$this->db->where('firm', $firm);
			$this->db->where('job_title', $job);
			$query = $this->db->get();
			return $query->result()[0];
		} else return false;
	}
}
?>

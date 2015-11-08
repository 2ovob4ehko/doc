<?
class Realtytype extends CI_Model {

	var $id ='';
	var $name ='';

	function __construct()
    {
        parent:: __construct();
    }
	function get_by_id($id) {
		if(!empty($id)) {
			$this->db->where('id', $id);
			$query = $this->db->get('realty_type');
			return $query->result();
		} else return false;
	}
	function get_all() {
		$query = $this->db->get('realty_type');
		return $query->result();
	}
}
?>

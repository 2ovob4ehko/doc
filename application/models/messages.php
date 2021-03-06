<?
class Messages extends CI_Model {
/*http://www.9lessons.info/2013/05/message-conversation-database-design.html*/
	var $id ='';
	var $person ='';
	var $dialog ='';
	var $text ='';
	var $time ='';
	var $readed='';

	function __construct()
    {
        parent:: __construct();
    }
	function insert_new($data) {
		if(!empty($data)) {
			$this->db->insert('messages', $data);
			return $this->db->insert_id();
		} else return false;
	}
	function get_all() {
		$query = $this->db->get('messages');
		return $query->result();
	}
	function get_last_by_person($person,$n,$page) {
		if(!empty($person)) {
			$query = $this->db->query('SELECT * FROM (SELECT messages.*,dialog.person_one,dialog.person_two,dialog.id as dialog_id FROM messages JOIN dialog ON(dialog.id = messages.dialog) WHERE dialog.person_one = "'.$person.'" OR dialog.person_two = "'.$person.'" ORDER BY messages.time DESC) AS x GROUP BY x.dialog ORDER BY x.time DESC LIMIT '.$n*$page);
			return $query->result();
		} else return false;
	}
	function get_by_dialog($dialog) {
		if(!empty($dialog)) {
			$this->db->select('*');
			$this->db->from('messages');
			$this->db->where('dialog', $dialog);
			$this->db->order_by('time', 'desc');
			$query=$this->db->get();
			return $query->result();
		} else return false;
	}
	function read_dialog($dialog) {
		if(!empty($dialog)){
			$this->db->where('dialog',$dialog);
			$this->db->where('readed',0);
			$this->db->update('messages',array('readed'=>1));
			return true;
		} else return false;
	}
	function del($id){
		$this->db->delete('messages',array('id'=>$id));
		return $this->db->affected_rows();
	}
}
?>

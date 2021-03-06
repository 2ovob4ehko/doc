<?
class Ajax extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Person');
		$this->load->model('Perent');
		$this->load->model('Medic');
		$this->load->model('Workfor');
		$this->load->model('Worksyslink');
		$this->load->model('Realty');
		$this->load->model('Firm');
		$this->load->model('Messages');
		$this->load->model('Dialog');
		$this->load->model('Propertytype');
		$browser_lang=$this->input->cookie('lang');
		if(empty($browser_lang)){
			$browser_lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		}
		switch ($browser_lang){
	    case "uk":
	        $this->lang->load('text','ukrainian');
	        break;
	    case "ru":
	        $this->lang->load('text','russian');
	        break;
	    default:
        	$this->lang->load('text','english');
      break;
		}
	}
	public function patient_list($firm,$n,$page)
	{
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		$job=$this->Workfor->get_by_person_firm($this->session->userdata('id'),$firm);
		$system=$this->Worksyslink->get_by_jobfirm($job->job_title,$firm);
		if($system->system=="maternity_hospital"){
			$data['client']=$this->Person->get_by_register($firm,$n,$page);
			foreach ($data['client'] as $item){
				$data['perent'][$item->id]=$this->Perent->get_by_person($item->id);
				$data['medic'][$item->id]=$this->Medic->get_last_by_person($item->id);
			}
			$this->load->view('patient_list_view',$data);
		}else echo "Access denied";
	}
	public function realty_list($firm,$n,$page)
	{
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		$job=$this->Workfor->get_by_person_firm($this->session->userdata('id'),$firm);
		$system=$this->Worksyslink->get_by_jobfirm($job->job_title,$firm);
		if($system->system=="property_register"){
			$data['realty']=$this->Realty->get_by_register($firm,$n,$page);
			foreach ($data['realty'] as $item){
				$l=str_split($item->person);
				if($l[0]=='p'){
					$p=$this->Person->get_by_id(substr($item->person,1));
					$data['person'][$item->id]=$p->f_name.' '.$p->s_name.' '.$p->surname;
				}else{
					$data['person'][$item->id]=$this->Firm->get_by_id(substr($item->person,1))->name;
				}
			}
			$this->load->view('realty_list_view',$data);
		}else echo "Access denied";
	}
	public function dialog_list($n,$page)
	{
		$data['dialogs']=$this->Messages->get_last_by_person('p'.$this->session->userdata('id'),$n,$page);
		foreach ($data['dialogs'] as $item){
			$l1=str_split($item->person_one);
			$l2=str_split($item->person_two);
			if($l1[0]=='f'){
				$data['name'][$item->id]=$this->Firm->get_by_id(substr($item->person_one,1))->name;
				$data['logo'][$item->id]=$this->Firm->get_by_id(substr($item->person_one,1))->logo;
			}else if(substr($item->person_one,1)!=$this->session->userdata('id')){
				$p=$this->Person->get_by_id(substr($item->person_one,1));
				$data['name'][$item->id]=$p->priv_surname=='' ? $p->f_name.' '.$p->s_name.' '.$p->surname : $p->f_name.' '.$p->s_name.' '.$p->surname.' ('.$p->priv_surname.')';
				$data['logo'][$item->id]=$p->photo;
			}else if($l2[0]=='f'){
				$data['name'][$item->id]=$this->Firm->get_by_id(substr($item->person_two,1))->name;
				$data['logo'][$item->id]=$this->Firm->get_by_id(substr($item->person_two,1))->logo;
			}else{
				$p=$this->Person->get_by_id(substr($item->person_two,1));
				$data['name'][$item->id]=$p->priv_surname=='' ? $p->f_name.' '.$p->s_name.' '.$p->surname : $p->f_name.' '.$p->s_name.' '.$p->surname.' ('.$p->priv_surname.')';
				$data['logo'][$item->id]=$p->photo;
			}
		}
		$this->load->view('dialog_list_view',$data);
	}
	public function chat($dialog)
	{
		if($this->Dialog->get_permission($dialog,'p'.$this->session->userdata('id'))){
			$this->Messages->read_dialog($dialog);
			$data['messages']=$this->Messages->get_by_dialog($dialog);
			foreach ($data['messages'] as $item){
				$l=str_split($item->person);
				if($l[0]=='p'){
					$p=$this->Person->get_by_id(substr($item->person,1));
					$data['name'][$item->id]=$p->priv_surname=='' ? $p->f_name.' '.$p->s_name.' '.$p->surname : $p->f_name.' '.$p->s_name.' '.$p->surname.' ('.$p->priv_surname.')';
					$data['logo'][$item->id]=$p->photo;
				}else{
					$data['name'][$item->id]=$this->Firm->get_by_id(substr($item->person,1))->name;
					$data['logo'][$item->id]=$this->Firm->get_by_id(substr($item->person,1))->logo;
				}
			}
			$this->load->view('message_list_view',$data);
		}else echo "Access denied";
	}
	public function del_message($type,$id)
	{
		if($type==1){
			$this->Dialog->del($id);
		}else{
			$this->Messages->del($id);
		}
	}
	public function blank($n,$person=null)
	{
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		if($n==1){
			$data['realty']=$this->Realty->get_by_owner($person);
			$data['property']=$this->Propertytype->get_all();
			$this->load->view('realty_blank_view',$data);
		}
	}
}
?>

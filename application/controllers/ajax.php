<?
class Ajax extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Person');
		$this->load->model('Perent');
		$this->load->model('Medic');
		$this->load->model('Workfor');
		$this->load->model('Worksyslink');
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
		$job=$this->Workfor->get_by_person_firm($this->input->cookie('id'),$firm);
		$system=$this->Worksyslink->get_by_jobfirm($job->job_title,$firm);
		if($system->system=="maternity_hospital"){
			$data['client']=$this->Person->get_by_register($firm,$n,$page);
			$this->load->view('patient_list_view',$data);
		}else echo "Access denied";
	}
}
?>

<?
class Main extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->library('enc');
		$this->load->model('Person');
		$this->load->model('Perent');
		$this->load->model('Medic');
		$this->load->model('Workfor');
		$this->load->model('Worksyslink');
		$this->load->model('Sex');
		$this->load->model('Blood');
		$this->load->model('Realty');
		$this->load->model('Realtylink');
		$this->load->model('Realtytype');
		$this->load->model('Firm');
		$this->load->model('Messages');
		$this->load->model('Dialog');
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
	public function index()
	{
		/*if(!$this->session->userdata('id')){
			redirect('/main/author/', 'refresh');
		}else{
			$p=$this->Person->get_by_id($this->session->userdata('id'));
			$data['title']=$this->lang->line("text_my_page");
			foreach ($this->lang->language as $key => $value){
				$data[$key]=$value;
			}
			foreach ($p as $key => $value){
				$data[$key]=$value;
			}
			$data['perent']=$this->Perent->get_by_person($p->id);
			$data['medic']=$this->Medic->get_last_by_person($p->id);
			$data['content']=$this->load->view('person_page_view',$data,true);
			$this->load->view('main_view',$data);
		}*/
		echo 'hello:'; var_dump($this->session->userdata('id'));
	}
	public function author($error="")
	{
		$data['title']=$this->lang->line("text_autorisation");
		$data['error']=$error;
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		$data['content']=$this->load->view('author_view',$data,true);
		$this->load->view('main_view',$data);
	}
	public function author_action()
	{
		$pers=$this->Person->get_by_login($_POST['login']);

		if(!$pers){
			redirect('/main/author/'.urlencode($this->lang->line("text_error_login")), 'refresh');
		}else{
			$enc_str=$this->enc->text_enc($_POST['login'],$_FILES['key']['tmp_name']);
			$dec_str=$this->enc->text_dec($enc_str,$pers[0]->pub_key);
			if($_POST['login']==$dec_str){
				$this->session->set_userdata('id',$pers[0]->id);
				redirect('/', 'refresh');
			}else{
				redirect('/main/author/'.urlencode($this->lang->line("text_error_key")), 'refresh');
			}
		}
	}
	public function realty_action()
	{
		$data=array(
			'address'=>$_POST['address'],
			'square'=>str_replace(",",".",$_POST['square']),
			'type'=>$_POST['type'],
			'rooms'=>$_POST['rooms'],
			'date'=>$_POST['date'],
			'register'=>$_POST['firm']
		);
		$realty_id=$this->Realty->insert_new($data);
		$data=array(
			'person'=>$_POST['person'],
			'realty'=>$realty_id,
			'property'=>1,
			'square'=>$_POST['square']
		);
		$this->Realtylink->insert_new($data);

		header('Location: /main/work_system/'.$_POST['firm']);
	}
	public function message_action()
	{
		if(!$this->Dialog->get_if_exist('p'.$this->session->userdata('id'),$_POST['person'])){
			$data=array(
				'person_one'=>'p'.$this->session->userdata('id'),
				'person_two'=>$_POST['person']
			);
			$dialog_id=$this->Dialog->insert_new($data);
		}else{
			$dialog_id=$this->Dialog->get_by_person('p'.$this->session->userdata('id'))->id;
		}
		$data=array(
			'person'=>'p'.$this->session->userdata('id'),
			'dialog'=>$dialog_id,
			'text'=>$_POST['message']
		);
		$this->Messages->insert_new($data);

		header('Location: /main/new_message');
	}
	public function registr_action()
	{
		$login=strtolower($this->translit($_POST['f_name'].'.'.$_POST['surname'].'.'.Date("Y",strtotime($_POST['born']))));
		$person=$this->Person->get_like_login($login);
		if(empty($person)){$login.=1;}else{$login.=count($person)+1;}
		$key=$this->enc->get_keys($login,$_POST['f_name'].' '.$_POST['s_name'].' '.$_POST['surname']);
		$data=array(
			'login'=>$login,
			'pub_key'=>$key['public'],
			'f_name'=>$_POST['f_name'],
			's_name'=>$_POST['s_name'],
			'surname'=>$_POST['surname'],
			'blood'=>$_POST['blood'],
			'sex'=>$_POST['sex'],
			'born'=>$_POST['born'],
			'register'=>$_POST['firm']
		);
		$person_id=$this->Person->insert_new($data);
		$data=array(
			'login'=>$login,
			'pub_key'=>$key['public'],
			'f_name'=>$_POST['f_name'],
			's_name'=>$_POST['s_name'],
			'surname'=>$_POST['surname'],
			'blood'=>$_POST['blood'],
			'sex'=>$_POST['sex'],
			'born'=>$_POST['born'],
			'register'=>$_POST['firm']
		);
		$person_id=$this->Person->insert_new($data);
		$data=array(
			'person'=>$person_id,
			'parameter'=>'1',
			'value'=>$_POST['weight'],
			'exam_date'=>Date("Y-m-d H:i:s")
		);
		$this->Medic->insert_new($data);
		$data=array(
			'person'=>$person_id,
			'parameter'=>'2',
			'value'=>$_POST['height'],
			'exam_date'=>Date("Y-m-d H:i:s")
		);
		$this->Medic->insert_new($data);
		if(isset($_POST['perents'])){
			foreach($_POST['perents'] as $item){
				$data=array(
					'person'=>$person_id,
					'perent'=>$item
				);
				$this->Perent->insert_new($data);
			}
		}
		$filename=time();
		$handle = fopen($filename, "w");
    fwrite($handle,$key['private']);
    fclose($handle);

    header('Content-Type: application/octet-stream');
		header("Cache-Control: no-cache, must-revalidate");
    header('Content-Disposition: attachment; filename='.$login.'.key');
    header('Content-Length: '.filesize($filename));
    readfile($filename);
		unlink($filename);
		//header('Location: /main/work_system/'.$_POST['firm']);
	}
	public function new_message()
	{
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		$data['person']=$this->Person->get_all();
		$data['firm']=$this->Firm->get_all();
		$data['title']=$this->lang->line("text_new_message");
		$data['content']=$this->load->view('new_message_view',$data,true);
		$this->load->view('main_view',$data);
	}
	public function chat($dialog)
	{
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		/*if(!$this->Dialog->get_permission($dialog,'p'.$this->session->userdata('id')){*/
		$data['person']=$this->Person->get_all();
		$data['firm']=$this->Firm->get_all();
		$data['title']=$this->lang->line("text_new_message");
		$data['content']=$this->load->view('new_message_view',$data,true);
		$this->load->view('main_view',$data);
	}
	public function property_list()
	{
		$data['title']=$this->lang->line("text_my_property");
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		$data['realty']=$this->Realty->get_by_person('p'.$this->session->userdata('id'));
		$data['content']=$this->load->view('property_list_view',$data,true);
		$this->load->view('main_view',$data);
	}
	public function work_list()
	{
		$data['title']=$this->lang->line("text_my_work");
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		$data['work']=$this->Workfor->get_by_person($this->session->userdata('id'));
		$data['content']=$this->load->view('work_list_view',$data,true);
		$this->load->view('main_view',$data);
	}
	public function work_system($firm)
	{
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		$data['sex']=$this->Sex->get_all();
		$data['blood']=$this->Blood->get_all();
		$data['person']=$this->Person->get_all();
		$data['firm']=$this->Firm->get_all();
		$data['realty_type']=$this->Realtytype->get_all();
		$job=$this->Workfor->get_by_person_firm($this->session->userdata('id'),$firm);
		$system=$this->Worksyslink->get_by_jobfirm($job->job_title,$firm);
		$data['title']=$this->lang->line("text_".$system->system);
		$data['content']=$this->load->view($system->system.'_view',$data,true);
		$this->load->view('main_view',$data);
	}
	public function del_cookie()
	{
		$this->session->unset_userdata('id');
		redirect('/main/author/', 'refresh');
	}
	public function change_lang($lang)
	{
		$this->input->set_cookie('lang',$lang,2595000);
		redirect('/main/author/', 'refresh');
	}
	function translit($textcyr=null,$textlat=null){
	$cyr=array('а','б','в','г','ґ','д','е','є','ж','з','и','і','ї','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ', 'ю','я','ь','А','Б','В','Г','Ґ','Д','Е','Є','Ж','З','И','І','Ї','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ю','Я','Ь');
  $lat=array('a','b','v','h','g','d','e','ye','zh','z','y','i','yi','j','k','l','m','n','o','p','r','s','t','u','f','kh','ts','ch','sh','shch','yu','ya','','A','B','V','H','G','D','E','YE','Zh','Z','Y','I','YI','J','K','L','M','N','O','P','R','S','T','U','F','H','TS','CH','SH','SHCH','YU','YA','');
	if($textcyr) return str_replace($cyr,$lat,$textcyr);
    else if($textlat) return str_replace($lat,$cyr,$textlat);
    else return null;
	}
}
?>

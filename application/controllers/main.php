<?
class Main extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Person');
		$this->load->model('Perent');
		$this->load->model('Medic');
		$this->load->model('Workfor');
		$this->load->model('Worksyslink');
		$this->load->model('Sex');
		$this->load->model('Blood');
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
		if(!$this->input->cookie('id')){
			redirect('/main/author/', 'refresh');
		}else{
			$p=$this->Person->get_by_id($this->input->cookie('id'));
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
		}
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
			$enc_str=$this->text_enc($_POST['login'],$_FILES['key']['tmp_name']);
			$dec_str=$this->text_dec($enc_str,$pers[0]->pub_key);
			if($_POST['login']==$dec_str){
				$this->input->set_cookie('id',$pers[0]->id,0);
				redirect('/', 'refresh');
			}else{
				redirect('/main/author/'.urlencode($this->lang->line("text_error_key")), 'refresh');
			}
		}
	}
	public function registr_action()
	{
		$login=strtolower($this->translit($_POST['f_name'].'.'.$_POST['surname'].'.'.Date("Y",strtotime($_POST['born']))));
		$person=$this->Person->get_like_login($login);
		if(empty($person)){$login.=1;}else{$login.=count($person)+1;}
		$data=array(
			'login'=>$login,
			'pub_key'=>'',
			'f_name'=>$_POST['f_name'],
			's_name'=>$_POST['s_name'],
			'surname'=>$_POST['surname'],
			'blood'=>$_POST['blood'],
			'sex'=>$_POST['sex'],
			'born'=>$_POST['born'],
			'register'=>$_POST['firm']
		);
		print_r($data);
		/*header('Content-Disposition: attachment; filename=qrcode.png');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($filename));*/
		//$this->Person->insert_new($data);

		//redirect('/main/work_system/'.$_POST['firm'], 'refresh');
	}
	public function work_list()
	{
		$data['title']=$this->lang->line("text_my_work");
		foreach ($this->lang->language as $key => $value){
			$data[$key]=$value;
		}
		$data['work']=$this->Workfor->get_by_person($this->input->cookie('id'));
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
		/*Це треба зробити в у вигляді ajax запиту, а не тут*/
		$data['client']=$this->Person->get_by_register($firm);
		/***************************************************/
		$job=$this->Workfor->get_by_person_firm($this->input->cookie('id'),$firm);
		$system=$this->Worksyslink->get_by_jobfirm($job->job_title,$firm);
		$data['title']=$this->lang->line("text_".$system->system);
		$data['content']=$this->load->view($system->system.'_view',$data,true);
		$this->load->view('main_view',$data);
	}
	public function del_cookie()
	{
		delete_cookie('login');
		redirect('/main/author/', 'refresh');
	}
	public function change_lang($lang)
	{
		$this->input->set_cookie('lang',$lang,2595000);
		redirect('/main/author/', 'refresh');
	}

	function text_enc($str,$key) {
		$fpr = fopen($key,"r");
		$pr_key = fread($fpr,1024);
		fclose($fpr);
		openssl_private_encrypt($str,$result,$pr_key);
		return $result;
	}
	function text_dec($str,$key) {
		openssl_public_decrypt($str,$result,$key);
		return $result;
	}
	function translit($textcyr=null,$textlat=null){
	$cyr=array('а','б','в','г','ґ','д','e','є','ж','з','и','і','ї','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ', 'ю','я','ь','А','Б','В','Г','Ґ','Д','Е','Є','Ж','З','И','І','Ї','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ю','Я','Ь');
  $lat=array('a','b','v','h','g','d','e','ye','zh','z','y','i','yi','j','k','l','m','n','o','p','r','s','t','u','f','kh','ts','ch','sh','shch','yu','ya','','A','B','V','H','G','D','E','YE','Zh','Z','Y','I','YI','J','K','L','M','N','O','P','R','S','T','U','F','H','TS','CH','SH','SHCH','YU','YA','');
	if($textcyr) return str_replace($cyr,$lat,$textcyr);
    else if($textlat) return str_replace($lat,$cyr,$textlat);
    else return null;
	}
}
?>

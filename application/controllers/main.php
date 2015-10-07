<?
class Main extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Person');
	}
	public function index()
	{
		if(!$this->input->cookie('login')){
			redirect('/main/author/', 'refresh');
		}else{
			/*$login=$this->input->cookie('login');
			$person=$this->Person->get_by_login($login);
			if($person){
				$data['fio']=$person[0]->surname.' '.$person[0]->name.' '.$person[0]->secondname;
				$data['id']=$person[0]->id;
				$this->load->view('main_view',$data);
			}else echo "DataBase of Persons is empty";*/
		}
	}
	public function author($error="")
	{
		$data['error']=$error;
		$this->load->view('author_view',$data);
	}
	public function author_action()
	{
		$pers=$this->Person->get_by_login($_POST['login']);

		if(!$pers){
			redirect('/main/author/'.urlencode('Не вірний логін'), 'refresh');
		}else{
			$enc_str=$this->text_enc($_POST['login'],$_FILES['key']['tmp_name']);
			$dec_str=$this->text_dec($enc_str,$pers[0]->pub_key);
			if($_POST['login']==$dec_str){
				$this->input->set_cookie('login',$_POST['login'],0);
				redirect('/', 'refresh');
			}else{
				redirect('/main/author/'.urlencode('Не вірний ключ'), 'refresh');
			}
		}
	}
	/*public function regist($error="")
	{
		$data['error']=$error;
		$data['sex']=$this->Sex->get_all();
		$this->load->view('regist_view',$data);
	}
	public function regist_action()
	{
		$login=$this->Person->get_by_login($_POST['login']);
		if(!$login){
			$col=count($this->Person->get_by_born($_POST['born']))+1;
			if(empty($_POST['photo'])){$_POST['photo']='';}
			$data=array(
				'id'=>_generateIPN($_POST['born'],$col),
				'login'=>$_POST['login'],
				'pass'=>$_POST['pass'],
				'name'=>$_POST['name'],
				'secondname'=>$_POST['secondname'],
				'surname'=>$_POST['surname'],
				'sex'=>$_POST['sex'],
				'born'=>$_POST['born'],
				'photo'=>$_FILES['photo']['name']
			);
			$this->Person->insert_new($data);

			$path='./data/photo/';
			$file=$path.basename($_FILES['photo']['name']);
			move_uploaded_file($_FILES['photo']['tmp_name'], $file);

			redirect('/main/author/', 'refresh');
		}else{
			redirect('/main/regist/'.urlencode('Такий логін вже зайнятий'), 'refresh');
		}
	}
	public function del_cookie()
	{
		delete_cookie('login');
		redirect('/main/author/', 'refresh');
	}
*/
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
}
?>

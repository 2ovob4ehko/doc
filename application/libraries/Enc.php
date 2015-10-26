<? if (!defined('BASEPATH')) exit('Нет доступа к скрипту');
class Enc {
  static public function get_keys($login,$full_name) {
    $CA_CERT = base_url()."data/key/CA_DOC.csr";
    $CA_KEY  = base_url()."data/key/CA_DOC_priv.key";
    $config = array(
      "private_key_type"=>OPENSSL_KEYTYPE_RSA,
      "private_key_bits"=>512
    );
    $res = openssl_pkey_new($config);
    $privKey = '';
    openssl_pkey_export($res,$privKey);
    $arr = array(
      "organizationName" => "Фізична особа",
      "organizationalUnitName" => "Фізична особа",
      "commonName" => $full_name,
      "UID" => $login,
      "countryName" => "UA"
    );
    $csr = openssl_csr_new($arr,$privKey);
    $cert = openssl_csr_sign($csr,file_get_contents($CA_CERT),file_get_contents($CA_KEY),730);
    openssl_x509_export($cert,$str_cert);
    $public_key = openssl_pkey_get_public($str_cert);
    $public_key_details = openssl_pkey_get_details($public_key);
    $public_key_string = $public_key_details['key'];
    return array('private'=>$privKey,'cert'=>$str_cert,'public'=>$public_key_string);
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
}
?>

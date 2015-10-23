<?
class Enc {
  static public function get_keys($login,$full_name,$city,$state) {
	$CA_CERT = "CA_DOC.csr";
	$CA_KEY  = "CA_DOC_priv.key";
    $config = array(
      "private_key_type"=>OPENSSL_KEYTYPE_RSA,
      "private_key_bits"=>512
    );
    $res = openssl_pkey_new($config);
    $privKey = '';
    openssl_pkey_export($res,$privKey);
    $fpr = fopen($login.".key","w");
    fwrite($fpr,$privKey);
    fclose($fpr);
    $arr = array(
	"organizationName" => "Фізична особа",
	"organizationalUnitName" => "Фізична особа",
	"commonName" => $full_name,
	"countryName" => "UA",
	"localityName" => $city,
	"stateOrProvinceName" => $state
    );
    $csr = openssl_csr_new($arr,$privKey);
    $cert = openssl_csr_sign($csr,file_get_contents($CA_CERT),file_get_contents($CA_KEY),365);
    openssl_x509_export($cert,$str_cert);
    $public_key = openssl_pkey_get_public($str_cert);
    $fcert1 = fopen($login.".csr","w");
    fwrite($fcert1,$str_cert);
    fclose($fcert1);
    $public_key_details = openssl_pkey_get_details($public_key);
    $public_key_string = $public_key_details['key'];
    $fpr1 = fopen("CA_DOC_pub.key","w");
    fwrite($fpr1,$public_key_string);
    fclose($fpr1);
    return array('private'=>$privKey,'public'=>$public_key_string);
  }
  public function text_enc($str,$key) {
    $fpr = fopen($key,"r");
    $pub_key = fread($fpr,1024);
    fclose($fpr);
    openssl_public_encrypt($str,$result,$pub_key);
    return $result;
  }
  public function text_dec($str,$key) {
    $fpr = fopen($key,"r");
    $pr_key = fread($fpr,1024);
    fclose($fpr);
    openssl_private_decrypt($str,$result,$pr_key);
    return $result;
  }
}
?>
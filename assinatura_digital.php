<?
$ds_path_teste = 'D:\dev\php\portal-online\arquivo.txt';
$ds_path_teste_fim = 'D:\dev\php\portal-online\arquivo_assinado.txt';

$ds_path_crt = 'file://D:\dev\php\portal-online\claudionor.crt';
$ds_path_key = 'file://D:\dev\php\portal-online\claudionor.key';


$sn_teste_assinatura = openssl_pkcs7_sign(
   $ds_path_teste,
   $ds_path_teste_fim,
   $ds_path_crt,
   array(
      $ds_path_key,
      'claudionor'
   ),
   array(
   )
);

var_dump(file_exists($ds_path_teste));
echo "<HR>";
var_dump(file_exists($ds_path_teste_fim));
echo "<HR>";
var_dump(file_exists($ds_path_crt));
echo "<HR>";
var_dump(file_exists($ds_path_key));
echo "<HR>";
var_dump($sn_teste_assinatura);





$ds_path_teste = 'D:\dev\php\portal-online\70.pdf';
$ds_path_teste_fim = 'D:\dev\php\portal-online\arquivo_assinado.pdf';

$ds_path_crt = 'file://D:\dev\php\portal-online\claudionor.crt';
$ds_path_key = 'file://D:\dev\php\portal-online\claudionor.key';

$sn_teste_assinatura = openssl_pkcs7_sign(
   $ds_path_teste,
   $ds_path_teste_fim,
   $ds_path_crt,
   array(
      $ds_path_key,
      'claudionor'
   ),
   [],
   PKCS7_BINARY | PKCS7_DETACHED
);

var_dump(file_exists($ds_path_teste));
echo "<HR>";
var_dump(file_exists($ds_path_teste_fim));
echo "<HR>";
var_dump(file_exists($ds_path_crt));
echo "<HR>";
var_dump(file_exists($ds_path_key));
echo "<HR>";
var_dump($sn_teste_assinatura);








$ds_path_teste = 'D:\dev\php\portal-online\70.pdf';
$ds_path_teste_fim = 'D:\dev\php\portal-online\arquivo_assinado.pdf';

$ds_path_crt = 'file://D:\dev\php\portal-online\mengarda.pem';
$ds_path_key = 'file://D:\dev\php\portal-online\mengarda.pem';

$sn_teste_assinatura = openssl_pkcs7_sign(
   $ds_path_teste,
   $ds_path_teste_fim,
   $ds_path_crt,
   array(
      $ds_path_key,
      'PASSWORD_aqui'
   ),
   [],
   PKCS7_BINARY | PKCS7_DETACHED
);

var_dump(file_exists($ds_path_teste));
echo "<HR>";
var_dump(file_exists($ds_path_teste_fim));
echo "<HR>";
var_dump(file_exists($ds_path_crt));
echo "<HR>";
var_dump(file_exists($ds_path_key));
echo "<HR>";
var_dump($sn_teste_assinatura);



/*

-- cria a key
openssl pkcs12 -in mengarda.pfx -out mengarda.key -nocerts -nodes -password pass:PASSWORD_aqui

-- gerar o pem
openssl pkcs12 -in mengarda.pfx -out mengarda.pem -nokeys -clcerts -password pass:PASSWORD_aqui
openssl pkcs12 -in mengarda.pfx -out mengarda.pem -password pass:PASSWORD_aqui

openssl pkcs12 -in mengarda.pfx -out mengarda.crt -nodes


--
openssl x509 -outform der -in mengarda.pem -out mengarda.crt

openssl rsa -in ${SAIDA}/aa.key -out ${SAIDA}/chave.key

*/


// exemplo de leitura de PFX

$data = file_get_contents('D:\dev\php\portal-online\mengarda.pfx');
$certPassword = 'PASSWORD_aqui';

openssl_pkcs12_read($data, $certs, $certPassword);


$public_key = $certs['cert'];
$private_key = $certs['pkey'];



/*

$signed_csr = $certs['cert'];
$signed_csr = $certs['cert'];
$cerificate_out = 'teste.pem';
$private_key_resource = $certs['pkey'];
$passphrase = "PASSWORD_aqui";
$args = [];

$teste = openssl_pkcs12_export($signed_csr, $cerificate_out, $private_key_resource, $passphrase, $args);
var_dump($teste);

file_put_contents("teste.pem", $cerificate_out);


$cerificate_out = 'teste2.pem';
$teste = openssl_x509_export ( $signed_csr, $cerificate_out, true);
file_put_contents("teste2.pem", $cerificate_out);




*/



/*use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;

require 'vendor/autoload.php';

$pfx = file_get_contents('your-cert.pfx');
$password = 'YOUR-PASSWORD';

$certificate = new X509Certificate($pfx, $password);
$pem = $certificate->export(X509ContentType::PEM);

file_put_contents('certificate.pem', $pem);*/

var_dump($public_key);
var_dump($private_key);

// exemplo de criação de PEM

file_put_contents('teste3.pem', $public_key . $private_key);



$ds_path_teste = 'D:\dev\php\portal-online\70.pdf';
$ds_path_teste_fim = 'D:\dev\php\portal-online\arquivo_assinado_pem.pdf';

$ds_path_crt = 'file://D:\dev\php\portal-online\teste3.pem';
$ds_path_key = 'file://D:\dev\php\portal-online\teste3.pem';

$sn_teste_assinatura = openssl_pkcs7_sign(
   $ds_path_teste,
   $ds_path_teste_fim,
   $ds_path_crt,
   array(
      $ds_path_key,
      'PASSWORD_aqui'
   ),
   [],
   PKCS7_BINARY | PKCS7_DETACHED
);

var_dump(file_exists($ds_path_teste));
echo "<HR>";

var_dump(file_exists($ds_path_teste_fim));
echo "<HR>";

var_dump(file_exists($ds_path_crt));
echo "<HR>";

var_dump(file_exists($ds_path_key));
echo "<HR>";

var_dump($sn_teste_assinatura);

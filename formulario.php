<style type="text/css">
	h2{font-family: 'Roboto', sans-serif; font-size: 24px; color: #008C00; margin-top: 20px;}
</style>
<?php
//Pega os dados postados pelo formulário HTML e os coloca em variáveis
if (eregi('tempsite.ws$|mangelsantichamas.com.br/$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
//substitua na linha acima a aprte locaweb.com.br por seu domínio.
$email_from='comercial@mangelsantichamas.com.br';// Substitua essa linha pelo seu e-mail@seudominio
}else {
$email_from = "contato@" . $_SERVER[HTTP_HOST];
// Na linha acima estamos forçando que o remetente seja 'webmaster@',
// você pode alterar para que o remetente seja, por exemplo, 'contato@'.
}
if( PATH_SEPARATOR ==';'){ $quebra_linha="\r\n";
} elseif (PATH_SEPARATOR==':'){ $quebra_linha="\n";
} elseif ( PATH_SEPARATOR!=';' and PATH_SEPARATOR!=':' ) {echo ('Esse script não funcionará corretamente neste
servidor, a função PATH_SEPARATOR não retornou o parâmetro esperado.');
}
//pego os dados enviados pelo formulário
$nome_para = $_POST["nome_para"];
$email = $_POST["email"];
$emailcliente = $_POST["emailcliente"];
$telefone = $_POST["telefone"];
$empresa = $_POST["empresa"];
$mensagem = $_POST["mensagem"];
$assunto = $_POST["assunto"];

$all =
"Nome: ".$nome_para."\r<br />".
"Email: ".$emailcliente."\r<br />".
"Telefone: ".$telefone."\r<br />".
"Empresa: ".$empresa."\r<br />".
"Mensagem: ".$mensagem."\r";

//formato o campo da mensagem
$mensagem = wordwrap( $mensagem, 50, "<br>", 1);
//valido os emails
if (!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,AZ]){2}([0-9,a-z,A-Z])?$", $emailcliente)){
echo"<center>Digite um email valido</center>";
echo "<center><a href=\"javascript:history.go(-1)\">Voltar</center></a>";
exit;
}
$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
$fp = fopen($_FILES["arquivo"]["tmp_name"],"rb");
$anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"]));
$anexo = base64_encode($anexo);
fclose($fp);
$anexo = chunk_split($anexo);
$boundary = "XYZ-" . date("dmYis") . "-ZYX";
$mens = "--$boundary" . $quebra_linha . "";
$mens .= "Content-Transfer-Encoding: 8bits" . $quebra_linha . "";
$mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $quebra_linha . "" . $quebra_linha . ""; //plain
$mens .= "$mensagem" . $quebra_linha . "";
$mens .= "--$boundary" . $quebra_linha . "";
$mens .= "Content-Type: ".$arquivo["type"]."" . $quebra_linha . "";
$mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"" . $quebra_linha . "";
$mens .= "Content-Transfer-Encoding: base64" . $quebra_linha . "" . $quebra_linha . "";
$mens .= "$anexo" . $quebra_linha . "";
$mens .= "--$boundary--" . $quebra_linha . "";
$headers = "MIME-Version: 1.0" . $quebra_linha . "";
$headers .= "From: $email_from " . $quebra_linha . "";
$headers .= "Return-Path: $email_from " . $quebra_linha . "";
$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"" . $quebra_linha . "";
$headers .= "$boundary" . $quebra_linha . "";
//envio o email com o anexo
mail($email,$assunto, $mens,$headers, "-r".$email_from);
echo"Email enviado com Sucesso!";
}
//se nao tiver anexo
else{
$headers = "MIME-Version: 1.0" . $quebra_linha . "";
$headers .= "Content-type: text/html; charset=iso-8859-1" . $quebra_linha . "";
$headers .= "From: $email_from " . $quebra_linha . "";
$headers .= "Return-Path: $email_from " . $quebra_linha . "";
//envia o email sem anexo
mail($email,$assunto, $all, $headers, "-r".$email_from);
echo"<center><h2>E-mail enviado com sucesso!<br>Entraremos em contato!</h2></center>";
}
?>
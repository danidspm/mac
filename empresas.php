<html>
<head>
<script language="javascript">
function checa_formulario(email){
if (email.nome_para.value == ""){
alert("Por Favor nao deixe o nome em branco!!!");
email.nome.focus();
return (false);}
if (email.email.value == ""){
alert("Nao deixe o email destinatario em branco!!!");
email.email.focus();
return (false);}
if (email.assunto.value == ""){
alert("Nao deixe o assunto em branco!!!");
email.assunto.focus();
return (false);}}
</script>
<title>Enviando texto</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
.email {text-transform: lowercase;}
.texto {color: #333; font-size:16px; font-family: 'Roboto', sans-serif;}
.inputou{border: 1px solid #999; height: 30px; width: 100%; padding: 5px; font-family: 'Roboto', sans-serif;}
.inputext{border: 1px solid #999; height: 150px; width: 100%; padding: 5px; font-family: 'Roboto', sans-serif;}
.subou{background-color:#003CA8; font-weight: bold; font-size: 16px; border:0px; color: #fff; font-family: 'Roboto', sans-serif; padding: 20px; cursor: pointer;}
.subou:hover{background-color:#E43F00; font-weight: bold; font-size: 16px; border:0px; color: #fff; font-family: 'Roboto', sans-serif; padding: 20px;}
.style1 {color: #FF0000}
</style>
</head>
<body onLoad="document.email.nome.focus();">
<form onsubmit="return checa_formulario(this)" action="formulario.php" method="post" enctype="multipart/form-data"
name="email">
<table width="80%" border="0" align="center">
<tr>
<td><span class="texto">Nome:</span><br><input class="inputou" name="nome_para" type="text" id="nome_para" required=""></td>
</tr>
<tr>
<td><span class="texto">Empresa:</span><br><input class="inputou" name="empresa" type="text" id="empresa"></td>
</tr>
<tr>
<td><input class="inputou" name="email" type="text" class="email" hidden="" value="daniela.duoeme@gmail.com">
</tr>
<tr>
<td><span class="texto">Email:</span><br><input class="inputou" name="emailcliente" type="text" class="emailcliente" required="">
</tr>
<tr>
<td><span class="texto">Telefone:</span><br><input class="inputou" name="telefone" type="text" id="telefone" required=""></td>
</tr>
<tr>
<td><span class="texto">Assunto:</span><br><input class="inputou" name="assunto" type="text" id="assunto" required=""></td>
</tr>
<tr>
<td><span class="texto">Mensagem:</span><br><textarea class="inputext" name="mensagem" cols="50" rows="10" id="mensagem" required=""></textarea></td>
</tr>
<tr>
<td><input class="subou" type="submit" name="Submit" value="ENVIAR MENSAGEM"></td>
</tr>
</table>
</form>
</body>
</html>
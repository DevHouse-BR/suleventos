<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);

include("includes/funcoes.php");

$passo = $_POST["passo"];

if(strlen($passo) == 0) $passo = 1;

constroi_inicio_pagina(); 
if($passo == 1){
	require("includes/conectar_mysql.php");
	$query = "SELECT conteudo FROM textos WHERE nome='cartaofidelidade'";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$text = mysql_fetch_row($result);
	require("includes/desconectar_mysql.php");
	echo('<div>' . $text[0] . '</div>');
	constroi_cadastro_cartao_fidelidade();
}
elseif($passo == 2){
	registra_internauta();
}
constroi_banner();
constroi_fim_pagina();

function constroi_cadastro_cartao_fidelidade(){ ?>
	<div><a href="imprime_parceiros_cartao.php" target="_blank"><img border="0" src="imagens/imprima.jpg" align="left"></a><br><br>&nbsp;&nbsp;<a href="imprime_parceiros_cartao.php" target="_blank" class="menurodape">Imprima a Lista de Empresas Credenciadas</a></div><br><br><br><br>
	<script language="javascript" type="text/javascript">
		function valida_form(){
			var f = document.forms["cartaofidelidade"];
			if ((f.nome.value == "") || (f.sobrenome.value == "") || (f.nome_para_cartao.value == "") || (f.nascimento_dia.value == "") || (f.nascimento_mes.value == "") || (f.nascimento_ano.value == "")  || (f.rg.value == "") || (f.endereco.value == "")  || (f.bairro.value == "") || (f.cidade.value == "") || (f.cep1.value == "") || (f.cep2.value == "")){
				alert("Preecha todos os campos com asterisco");
			}
			else{
				if(checkEmail(f)) f.submit();
			}
		}
		function checkEmail(myForm) {
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.email.value)){
				return (true)
			}
			alert("Endereço de Email Invalido!")
			return (false)
		}
	</script>
	<hr>
	<table width="100%" border="0" cellspacing="1" height="428">
		<form name="cartaofidelidade" action="cartao_fidelidade.php" method="post">
		<tr> 
			<td class="label" width="30%">*Nome:</td>
			<td width="70%"><input type="text" name="nome" maxlength="50" style="width: 100%"></td>
		</tr>
		<tr> 
			<td class="label">*Sobrenome:</td>
			<td><input type="text" name="sobrenome" maxlength="100" style="width: 100%"></td>
		</tr>
		<tr>
			<td class="label">*Nome para o Cartão:</td>
			<td><input type="text" name="nome_para_cartao" maxlength="50" style="width: 100%"></td>
		</tr>
		<tr>
			<td class="label">*E-mail:</td>
			<td><input type="text" name="email" maxlength="100" style="width: 100%"></td>
		</tr>
		<tr>
			<td class="label">*Data de Nascimento:</td>
			<td class="label" style="text-align: left;">
				<select name="nascimento_dia">
					<option value=""> Dia </option>
					<?
					for($i = 1; $i < 32; $i++){
						echo('<option value="' . $i . '" >' . $i . '</option>');
					}
					?>
				</select>&nbsp;/
				<select name="nascimento_mes">
					<option value=""> Mês </option>
					<option value="1" >Janeiro</option>
					<option value="2" >Fevereiro</option>
					<option value="3" >Março</option>
					<option value="4" >Abril</option>
					<option value="5" >Maio</option>
					<option value="6" >Junho</option>
					<option value="7" >Julho</option>
					<option value="8" >Agosto</option>
					<option value="9" >Setembro</option>
					<option value="10" >Outubro</option>
					<option value="11" >Novembro</option>
					<option value="12" >Dezembro</option>
				</select>&nbsp;/
				<select name="nascimento_ano">
					<option value=""> Ano </option>
					<?
					for($i = 1934; $i < (date("Y", mktime()) - 15); $i++){
						echo('<option value="' . $i . '" >' . $i . '</option>');
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label">*Sexo:</td>
			<td class="label" style="text-align:left;">
				<input type="radio" value="M" name="sexo">Masculino&nbsp;
				<input type="radio" value="F" name="sexo" checked>Feminino
			</td>
		</tr>
		<tr>
			<td class="label">*RG:</td>
			<td><input type="text" name="rg" maxlength="50" style="width: 100%"></td>
		</tr>
		<tr>
			<td class="label">*Endereço:</td>
			<td><input type="text" name="endereco" maxlength="255" style="width: 100%"></td>
		</tr>
		<tr>
			<td class="label">Complemento:</td>
			<td><input type="text" name="complemento" maxlength="100" style="width: 100%"></td>
		</tr>
		<tr>
			<td class="label">*Bairro:</td>
			<td><input type="text" name="bairro" maxlength="100" style="width: 100%"></td>
		</tr>
		<tr>
			<td class="label">*Cidade:</td>
			<td><input type="text" name="cidade" maxlength="100" style="width: 100%"></td>
		</tr>
		<tr>
			<td class="label">*Estado:</td>
			<td>
				<select name="estado">
						<option value="AC">Acre</option>
						<option value="AL">Alagoas</option>
						<option value="AP">Amapa</option>
						<option value="AM">Amazonas</option>
						<option value="BA">Bahia</option>
						<option value="CE">Ceara</option>
						<option value="DF">Distrito Federal</option>
						<option value="ES">Espirito Santo</option>
						<option value="OU">Fora do Brasil</option>
						<option value="GO">Goias</option>
						<option value="MA">Maranhao</option>
						<option value="MT">Mato Grosso</option>
						<option value="MS">Mato Grosso do Sul</option>
						<option value="MG">Minas Gerais</option>
						<option value="PA">Para</option>
						<option value="PB">Paraiba</option>
						<option value="PR">Parana</option>
						<option value="PE">Pernambuco</option>
						<option value="PI">Piaui</option>
						<option value="RN">Rio Grande do Norte</option>
						<option value="RS">Rio Grande do Sul</option>
						<option value="RJ">Rio de Janeiro</option>
						<option value="RO">Rondonia</option>
						<option value="RR">Roraima</option>
						<option value="SC" selected>Santa Catarina</option>
						<option value="SE">Sergipe</option>
						<option value="SP">São Paulo</option>
						<option value="TO">Tocantins</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label">*CEP:</td>
			<td>
				<input type="text" name="cep1" maxlength="5" size="5">
				- <input type="text" name="cep2" maxlength="3" size="3">
			</td>
		</tr>
		<tr>
			<td class="label">Telefone:</td>
			<td><input type="text" name="telefone" maxlength="30" style="width: 100%"></td>
		</tr>
		<tr>
			<td class="label">Data do Evento:</td>
			<td>
				<select name="evento_dia">
					<option value=""> Dia </option>
					<?
					for($i = 1; $i < 32; $i++){
						echo('<option value="' . $i . '" >' . $i . '</option>');
					}
					?>
				</select>
				<b><font face="Arial" size="2" color="#5383B3"> /</font></b>
				<select name="evento_mes">
					<option value=""> Mês </option>
					<option value="1" >Janeiro</option>
					<option value="2" >Fevereiro</option>
					<option value="3" >Março</option>
					<option value="4" >Abril</option>
					<option value="5" >Maio</option>
					<option value="6" >Junho</option>
					<option value="7" >Julho</option>
					<option value="8" >Agosto</option>
					<option value="9" >Setembro</option>
					<option value="10" >Outubro</option>
					<option value="11" >Novembro</option>
					<option value="12" >Dezembro</option>
				</select>
				<b><font face="Arial" size="2" color="#5383B3"> /</font></b>
				<select name="evento_ano">
					<option value=""> Ano </option>
					<option value="2004" >2004</option>
					<option value="2005" >2005</option>
					<option value="2006" >2006</option>
					<option value="2007" >2007</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="label">
				<br>
				<input type="hidden" value="2" name="passo">
				<input type="button" value="Enviar Dados" onClick="valida_form();">
				<input type="reset" value="Limpar Dados">
			</td>
		</tr>
		</form>
	</table>
<?
}

#############################################################################################

function registra_internauta(){
	$nome = $_POST["nome"];
	$sobrenome = $_POST["sobrenome"];
	$nome_para_cartao = $_POST["nome_para_cartao"];
	$email = $_POST["email"];
	$data_nascimento = mktime(0,0,0,$_POST["nascimento_mes"],$_POST["nascimento_dia"],$_POST["nascimento_ano"]);
	$sexo = $_POST["sexo"];
	$rg = $_POST["rg"];
	$endereco = $_POST["endereco"];
	$complemento = $_POST["complemento"];
	$bairro = $_POST["bairro"];
	$cidade = $_POST["cidade"];
	$estado = $_POST["estado"];
	$cep = $_POST["cep1"] . $_POST["cep2"];
	$telefone = $_POST["telefone"];
	$data_evento = mktime(0,0,0,$_POST["evento_mes"],$_POST["evento_dia"],$_POST["evento_ano"]);
	
	$destino = retorna_config("email");
	
	require("includes/conectar_mysql.php");
		$query = "INSERT INTO internautas (nome, sobrenome, nome_para_cartao, email, data_nascimento, sexo, rg, endereco, complemento, bairro, cidade, estado, cep, telefone, data_evento) VALUES ('";
		$query .= $nome ."', '";
		$query .= $sobrenome ."', '";
		$query .= $nome_para_cartao ."', '";
		$query .= $email ."', '";
		$query .= $data_nascimento ."', '";
		$query .= $sexo ."', '";
		$query .= $rg ."', '";
		$query .= $endereco ."', '";
		$query .= $complemento ."', '";
		$query .= $bairro ."', '";
		$query .= $cidade ."', '";
		$query .= $estado ."', '";
		$query .= $cep ."', '";
		$query .= $telefone ."', '";
		$query .= $data_evento ."')";
		

		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	require("includes/desconectar_mysql.php");
	
	$mensagem = "Cartão Fidelidade\n\n\Nome: " . $nome;
	$mensagem .= "\nSobrenome: " . $sobrenome;
	$mensagem .= "\nNome para Cartão: " . $nome_para_cartao;
	$mensagem .= "\nEmail: " . $email;
	$mensagem .= "\nData de Nascimento: " . $_POST["nascimento_dia"] . "/" . $_POST["nascimento_mes"] . "/" . $_POST["nascimento_ano"];
	$mensagem .= "\nSexo: " . $sexo;
	$mensagem .= "\nRG: " . $rg;
	$mensagem .= "\nEndereço: " . $endereco . " - " . $complemento;
	$mensagem .= "\nBairro: " . $bairro;
	$mensagem .= "\nCidade: " . $cidade;
	$mensagem .= "\nEstado: " . $estado;
	$mensagem .= "\nCEP: " . $cep;
	$mensagem .= "\nTelefone: " . $telefone;
	$mensagem .= "\nData do Evento: " . $_POST["evento_dia"] . "/" . $_POST["evento_mes"] . "/" . $_POST["evento_ano"];
	
	
	if($result) mail($destino, "CARTÃO FIDELIDADE SULEVENTOS.COM.BR", $mensagem, "From: <suleventos@suleventos.com.br>");
	
	$mensagem = '<table width="100%" border="0" class="conteudo"><tr><td>';
	$mensagem .= "<b>Informações Enviadas Com Sucesso!</b><br><br>";
	$mensagem .= "As informações estão sendo analizadas e em breve você terá um retorno sobre o seu cadastro. ";
	$mensagem .= "Verifique seu email em breve para novas instruções.<br><br>";
	$mensagem .= "Felicidades,<br><br>Equipe suleventos.com.br";
	$mensagem .= '</td></tr></table>';
	
	echo($mensagem);
}
?>
<?php
//a sua fun��o � de gerar um menu select com o nome dos cursos e tamb�m gerar vari�veis em javascript com o conte�do
//de um menu select mostrando as turmas de cada curso.


$selects = ""; //Inicializa��o da variavel
function constroi_select_turmas($eventos){ //Esta fun�ao pode receber como parametro qualquer texto em html para ser inserido dentro da tag <select>
	global $selects; //Informa que vai querer utilizar a variavel do escopo global $selects.
	require("includes/conectar_mysql.php"); //conecta ao banco
		$query = "SELECT DISTINCT curso FROM turma_curso order by curso"; //Busca todos os cursos que est�o na tabela turma_curso (todos os cursos que j� tem turma cadastrada)
		$result = mysql_query($query) or die("Erro ao acessar registros no Banco de dados: " . mysql_error()); //Executa a busca
		while($curso = mysql_fetch_array($result, MYSQL_ASSOC)){ //Enquanto tiver resultados (cursos)	
			$query = "SELECT turma FROM turma_curso where curso='" . $curso["curso"] . "'"; //Busca todas as turmas do curso
			$result2 = mysql_query($query) or die("Erro ao acessar registros no Banco de dados: " . mysql_error()); //Executa a busca
			//O codigo abaixo guarda na variavel $select o c�digo em javascript para declarar uma vari�vel com o nome do curso.
			// O ponto "." une duas strings. 
			$select = 'var ' . str_replace(" ", "_", $curso["curso"]) . ' = "<select name=\\"turma\\" style=\\"width: 100%;\\" ' . $eventos . '><option value=\\"\\"></option>';
			while($turma = mysql_fetch_array($result2, MYSQL_ASSOC)){
				$select .= '<option value=\"' . $turma["turma"] . '\">' . $turma["turma"] . '</option>'; //Insere cada op��o do menu select com as turmas encontradas no banco.
			}
			$select .= '</select>";';
			if (is_array($selects)){ //Se a variavel $selects for um array
				array_push($selects, $select); //Adiciona mais um elemento a este array
			}
			else $selects = array($select); //sen�o, cria o array.
		}
	require("includes/desconectar_mysql.php");
	return $selects;
}

function constroi_select_curso(){ //Esta � bem mais simples. Para cada curso encontrado no banco de dados � criada uma op��o para o mesmo no select.
	global $CURSO, $modo;

	$saida = 	'<select name="curso" style="width: 100%" onChange="muda_turma();">';
	$saida .= 	'<option value=""></option>';

	require("includes/conectar_mysql.php");
	$query = "SELECT DISTINCT curso FROM turma_curso order by curso";
	$result = mysql_query($query) or die("Erro ao acessar registros no Banco de dados: " . mysql_error());
	while($curso = mysql_fetch_array($result, MYSQL_ASSOC)){
		if (($modo == "update") && ($CURSO == $curso["curso"])) $saida .= "<option value=\"" . $curso["curso"] . "\" selected>" . $curso["curso"] . "</option>";
		else  $saida .= "<option value=\"" . $curso["curso"] . "\">" . $curso["curso"] . "</option>";
	}
	$saida .= "</select>";
	return $saida;
}
?>
/* 
Estas funçoes e códigos são para o funcionamento do menu horizontal.
*/

var saiu = 0;	//Variável que indica se o mouse está em cima do menu ou já saiu.
var intervalo;	//Intervalo retornado pela função setInterval() serve para depois usar a função clearInterval();

function start(){ //Quando o mouse passar em cima do menu que apareceu então será executada esta função.
	//Esta função seta um intervalo de meio segundo 500 milisegundos para a execução da função checamouse() ou seja,
	//a função checamouse() será executada neste intervalo de tempo até que seja executada o Clear interval.
	saiu = 0;
	intervalo = setInterval(checamouse, 500);
}

function checamouse(){
	if (saiu != 0){//Quando o mouse sai de cima do menu a variavel saiu fica iqual a 1 então:
		escondemenu(); //O menu é escondido 
		clearInterval(intervalo); //Para a repetição da execução desta função.
		saiu = 0;
	}
}

function escondeselect(){ //Codigo que procura dentro de um formulário a existência de um menu select. Caso ele exista este ficará escondido.
	if (document.forms[0]){
		for (i = 0; i < document.forms[0].elements.length; i++){
			if (document.forms[0].elements(i).type == "select-one"){
				if (document.forms[0].elements(i).style.visibility == "") document.forms[0].elements(i).style.visibility = "hidden";
				else if (document.forms[0].elements(i).style.visibility == "visible") document.forms[0].elements(i).style.visibility = "hidden";
			}
		}
	}
}

function mostramenu_agenda(){ //Insere dentro do <div> menuagenda a tabela abaixo:
	escondemenu();
	escondeselect();
	var html = 		"<table width=\"110\" cellpadding=\"3\" cellspacing=\"0\" class=\"menu2\">"
				+	"<tr><td style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" onClick=\"go(18);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Visualizar</font></td></tr>"
				+	"<tr><td style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" onClick=\"go(20);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Fechar</font></td></tr>"
				+	"</table>";
	document.all["menuagenda"].innerHTML = html;
	document.all["menuagenda"].style.position = "absolute";
	document.all["menuagenda"].style.visibility = "visible";
	document.all["menuagenda"].style.width = "100%";
}


function mostramenu_cursos(){ //Insere dentro do <div> menucursos a tabela abaixo:
	escondemenu();
	escondeselect();
	var html = 		"<table width=\"110\" cellpadding=\"3\" cellspacing=\"0\" class=\"menu2\">"
				+	"<tr><td style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" onClick=\"go(0);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Alunos</font></td></tr>"
				+	"<tr><td style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" onClick=\"go(1);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Novo Aluno</font></td></tr>"
				+	"<tr><td style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" onClick=\"go(14);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Professores</font></td></tr>"
				+	"<tr><td style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" onClick=\"go(2);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Novo Professor</font></td></tr>"
				+	"<tr><td style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" onClick=\"go(12);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Cursos</font></td></tr>"
				+	"<tr><td style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" onClick=\"go(13);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Turmas</font></td></tr>"
				+	"</table>";
	document.all["menucursos"].innerHTML = html;
	document.all["menucursos"].style.position = "absolute";
	document.all["menucursos"].style.visibility = "visible";
	document.all["menucursos"].style.width = "100%";
}
function mostramenu_grupos(){ //Insere dentro do <div> menugrupos a tabela abaixo:
	escondemenu();
	escondeselect();
	var html = 		"<table width=\"100\" cellpadding=\"3\" cellspacing=\"0\" class=\"menu2\">"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(3);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Visualizar</font></td></tr>"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(4);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Novo Grupo</font></td></tr>"
				+	"</table>";
	document.all["menugrupos"].innerHTML = html;
	document.all["menugrupos"].style.position = "absolute";
	document.all["menugrupos"].style.visibility = "visible";
	document.all["menugrupos"].style.width = "100%";
}
function mostramenu_atividades(){ //Insere dentro do <div> menuatividades a tabela abaixo:
	escondemenu();
	escondeselect();
	var html = 		"<table width=\"100\" cellpadding=\"3\" cellspacing=\"0\" class=\"menu2\">"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(5);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Compromisso</font></td></tr>"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(6);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Tarefa</font></td></tr>"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(7);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Evento</font></td></tr>"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(8);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Mensagem</font></td></tr>"
				+	"</table>";
	document.all["menuatividades"].innerHTML = html;
	document.all["menuatividades"].style.position = "absolute";
	document.all["menuatividades"].style.visibility = "visible";
	document.all["menuatividades"].style.width = "100%";
}
function mostramenu_dadospessoais(){ //Insere dentro do <div> menudadospessoais a tabela abaixo:
	escondemenu();
	escondeselect();
	var html = 		"<table width=\"100\" cellpadding=\"3\" cellspacing=\"0\" class=\"menu2\">"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(9);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Visualizar</font></td></tr>"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(15);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Alterar Senha</font></td></tr>"
				+	"</table>";
	document.all["menudadospessoais"].innerHTML = html;
	document.all["menudadospessoais"].style.position = "absolute";
	document.all["menudadospessoais"].style.visibility = "visible";
	document.all["menudadospessoais"].style.width = "100%";
}
function mostramenu_contatos(){ //Insere dentro do <div> menucontatos a tabela abaixo:
	escondemenu();
	escondeselect();
	var html = 		"<table width=\"100\" cellpadding=\"3\" cellspacing=\"0\" class=\"menu2\">"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(16);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Visualizar</font></td></tr>"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(17);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Novo Contato</font></td></tr>"
				+	"</table>";
	document.all["menucontatos"].innerHTML = html;
	document.all["menucontatos"].style.position = "absolute";
	document.all["menucontatos"].style.visibility = "visible";
	document.all["menucontatos"].style.width = "100%";
}
function mostramenu_links(){ //Insere dentro do <div> menulinks a tabela abaixo:
	escondemenu();
	escondeselect();
	var html = 		"<table width=\"100\" cellpadding=\"3\" cellspacing=\"0\" class=\"menu2\">"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(10);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Visualizar</font></td></tr>"
				+	"<tr><td onMouseOver=\"style.fontWeight = 'bold';\" onMouseOut=\"style.fontWeight = 'normal';\" style=\"cursor: hand; border-bottom: solid 1px #3399FF;\" onClick=\"go(11);\" align=\"center\" bgcolor=\"#3366FF\"><font color=\"#FFFFFF\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">Novo Link</font></td></tr>"
				+	"</table>";
	document.all["menulinks"].innerHTML = html;
	document.all["menulinks"].style.position = "absolute";
	document.all["menulinks"].style.visibility = "visible";
	document.all["menulinks"].style.width = "100%";
}
function escondemenu(){ //Faz qualquer menu que está sendo mostrado seja escondido.
	document.all["menuagenda"].innerHTML = "";
	document.all["menuagenda"].style.visibility = "hidden";
	document.all["menucursos"].innerHTML = "";
	document.all["menucursos"].style.visibility = "hidden";
	document.all["menugrupos"].innerHTML = "";
	document.all["menugrupos"].style.visibility = "hidden";
	document.all["menuatividades"].innerHTML = "";
	document.all["menuatividades"].style.visibility = "hidden";
	document.all["menudadospessoais"].innerHTML = "";
	document.all["menudadospessoais"].style.visibility = "hidden";
	document.all["menulinks"].innerHTML = "";
	document.all["menulinks"].style.visibility = "hidden";
	document.all["menucontatos"].innerHTML = "";
	document.all["menucontatos"].style.visibility = "hidden";
	if (document.forms[0]){ //Codigo que procura dentro de um formulário a existência de um menu select. Caso ele exista este será reamostrado.
		for (i = 0; i < document.forms[0].elements.length; i++){
			if (document.forms[0].elements(i).type == "select-one"){
				if (document.forms[0].elements(i).style.visibility == "hidden") document.forms[0].elements(i).style.visibility = "visible";
			}
		}
	}
}
function go(opcao){ //redireciona o browser para as páginas selecionadas.
	switch (opcao){
		case 0:
			self.location = "visualizar_alunos.php";
			break;
		case 1:
			self.location = "cadastro_alunos.php";
			break;
		case 2:
			self.location = "cadastro_professores.php";
			break;
		case 3:
			self.location = "visualizar_grupos.php";
			break;
		case 4:
			self.location = "cadastro_grupo.php";
			break;
		case 5:
			self.location = "compromisso.php";
			break;
		case 6:
			self.location = "tarefa.php";
			break;
		case 7:
			self.location = "evento.php";
			break;
		case 8:
			self.location = "mensagem.php";
			break;
		case 9:
			self.location = "dados_pessoais.php";
			break;
		case 10:
			self.location = "visualizar_links.php";
			break;
		case 11:
			self.location = "form_link.php";
			break;
		case 12:
			self.location = "cadastro_cursos.php";
			break;
		case 13:
			self.location = "cadastro_turmas.php";
			break;
		case 14:
			self.location = "visualizar_professores.php";
			break;
		case 15:
			self.location = "form_senha2.php";
			break;
		case 16:
			self.location = "visualizar_contatos.php";
			break;
		case 17:
			self.location = "form_contato.php";
			break;
		case 18:
			self.location = "agenda.php";
			break;
		case 19:
			self.location = "duvidas.php";
			break;
		case 20:
			if (confirm("Deseja Sair do Programa?")) location = "logout.php";
			break;
	}
}
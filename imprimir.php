<?php //declaramos uma variavel para monstarmos a tabela

  $dadosXls = "";
  $dadosXls .= " <table border='1' >";
  $dadosXls .= " <tr>";
  $dadosXls .= " <th>Id</th>";
  $dadosXls .= " <th>Nome</th>"; 
  $dadosXls .= " <th>idade</th>";
  $dadosXls .= " </tr>"; 
	 //incluimos nossa conexão 
	 include_once('Conexao.class.php');
	  //instanciamos 
	  $pdo = new Conexao(); 
	  //mandamos nossa query para nosso método dentro de conexao dando um return $stmt->fetchAll(PDO::FETCH_ASSOC);
	    $result = $pdo->select("SELECT id,nome,idade FROM usuario"); 
		//varremos o array com o foreach para pegar os dados 
		foreach($result as $res)
		{
			$dadosXls .= " <tr>";
			$dadosXls .= " <td>".$res['id']."</td>";
			$dadosXls .= " <td>".$res['nome']."</td>";
			$dadosXls .= " <td>".$res['idade']."</td>";
			$dadosXls .= " </tr>"; 
		} 

	$dadosXls .= " </table>";
	// Definimos o nome do arquivo que será exportado
	 $arquivo = "MinhaPlanilha.xls"; 
	// Configurações header para forçar o download 
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$arquivo.'"');
	header('Cache-Control: max-age=0');
	// Se for o IE9, isso talvez seja necessário 
	header('Cache-Control: max-age=1');
	// Envia o conteúdo do arquivo 
    echo $dadosXls; exit; 
?>
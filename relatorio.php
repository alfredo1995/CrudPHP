<?php
include ('verifica_sessao.php');
include ('./funcoes/Utils.php');
include ('classes/ConnectionFactory.php');


$conn = new Conexao();
if (gettype($conn->getConnection()) == 'string') {
    echo $conn->getConnection();
} else {
    $conexao = $conn->getConnection();
}

$query = "SELECT contato.id, contato.nome, contato.email, contato.telefone, contato.data_nascimento "
        . "FROM contato "
        . "INNER JOIN usuario "
        . "ON contato.id_usuario = usuario.id "
        . "ORDER BY contato.nome ASC";


$stmt = $conexao->prepare($query);
$stmt->execute();

//PEGA O RETORNO DO BANCO E ABASTECE A VARIAVEL $CONTATOS
$contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$html = '
<table cellspacing="0" width="100%" border="1">
        <thead>
		<tr>
		<h2> relatorio de contatos <h2>
		</tr>
          <tr>
            <td width="17%" class="tc">ID</td>
            <td width="13%" class="tc">Nome</td>
            <td width="9%" class="tc">E-mail</td>
            <td width="15%" class="tc">Telefone</td>
            <td width="15%" class="tc">Data</td>  

          </tr>
        </thead>
	<tbody>';
	 foreach ($contatos as $contato) { 
		 $html .= '<tr>';
         $html .= '<td>'.$contato['id'].'</td>';
		   $html .= '<td>'.$contato['nome'].'</td>';
		     $html .= '<td>'.$contato['email'].'</td>';
			   $html .= '<td>'.$contato['telefone'].'</td>';
			   $html .= '<td>'.$contato['data_nascimento'].'</td>';
		 $html .= '</tr>'; 
		 }		
	     $html .= '</tbody>		
         </table>';
		 
    include('PDF/mpdf.php');	
	$mpdf=new mPDF('c','A4','','',10,10,27,25,16,13); 
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0;	
	$stylesheet = file_get_contents('mpdfstyletables.css');
	$mpdf->WriteHTML($stylesheet,1);	
	$mpdf->WriteHTML($html,2);
	$mpdf->Output('mpdf.pdf','I');
	exit;
?>
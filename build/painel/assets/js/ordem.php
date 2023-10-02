<?
session_start();
include('../includes/class.banco.php');
$emp = new conect();


	
$list = $_GET["usuarioId"];
$page = $_GET["page"];

$list = explode(',',$list);

$count = 0;
foreach($list as $tira) {
	$tira = explode('_',$tira);
	//foreach($tira as $usuarioId) {
	if($tira[1]){
		$post['id'] = $tira[1];
		$post['ordem'] = $count;
		//echo "UPDATE `".$page."` SET `ordem` = '".$count."' WHERE id = '".$tira[1]."'";
		$emp->cadastros($post, $page);
		//echo mysqli_query( $emp->getConnection(), "UPDATE `".$page."` SET `ordem` = '".$count."' WHERE id = '".$tira[1]."'");
                
	}
	//}
$count++;
}



//$stringUsuarioId   = str_replace("&", "", $_GET["usuarioId"]);
//$arrayUsuarioId     = array_slice(explode("usuarioId[]=", $stringUsuarioId), 0);
//$count = 0;
//foreach($stringUsuarioId as $usuarioId) {
	//mysql_query("UPDATE `cecan`.`profissoes` SET `ordem` = '".$count."' WHERE id = '".$usuarioId."'");
	



//$count++;

//}




/*



			$Host = 'localhost';		//servidor
			$User = 'root';				//usuario
			$senha = 'qweasd';				//senha
			$Banco = 'cecan'; 
		
		
 		$conn = @mysql_connect($Host, $User, $senha) or die("Não foi possível a conexão com o Banco!");
		mysql_query("SET character_set_results=utf8", $conn);
		mb_language('uni'); 
		mb_internal_encoding('UTF-8');
		mysql_select_db($Banco, $conn);

*/
?>
<? session_start();


include('../../includes/class.banco.php');
$emp = new connect();
$token = $_REQUEST['toke'];

$SqlVer = "SELECT * FROM ".$_REQUEST['pag']."imagens WHERE id = '".$_POST['id']."' LIMIT 1";
$QueryVer = mysqli_query($emp->getConnection(), $SqlVer);

			while($totalimg = mysqli_fetch_array($QueryVer)){
				 //unlink('../../arquivos/'.$_SESSION['pagina'].'/'.$totalimg['img']);
				 $tb = substr($totalimg['img'],0,32);
				 $tbext = substr($totalimg['img'],-4,4);
				 
				 $aa = scandir('../../arquivos/'.$_REQUEST['pag'].'/');
				 foreach($aa as $lis){
					if(strripos($lis,$tb) === 0){
						unlink('../../arquivos/'.$_REQUEST['pag'].'/'.$lis);
						
					}
				}
			}
				
				


//if(unlink("painel/arquivos/equipe/".$TotalVer['nome']))
//{
	$Sql = "DELETE FROM ".$_REQUEST['pag']."imagens WHERE id = '".$_POST['id']."' LIMIT 1";
	$Query = mysqli_query($emp->getConnection(), $Sql);
//}




?>

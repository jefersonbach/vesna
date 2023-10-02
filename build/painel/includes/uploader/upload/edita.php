<? session_start();

include('../../includes/class.banco.php');
$emp = new connect();
$token = $_REQUEST['toke'];
if($_POST['val'] == 'legenda'){
	$SqlVer = "UPDATE ".$_REQUEST['pag']."imagens SET legenda = '".$_POST['legenda']."' WHERE id = '".$_POST['id']."'";
}elseif($_POST['val'] == 'principal'){

	
	
	
	
	$sql = "SELECT * from ".$_REQUEST['pag']."imagens WHERE token = '".$token."' AND principal = '1'";
	$QueryMuda = mysqli_query($emp->getConnection(), $sql);
	while($est = mysqli_fetch_array($QueryMuda)){
		$sqlss = "UPDATE ".$_REQUEST['pag']."imagens SET principal = '0' WHERE id = '".$est['id']."'";
		$QueryMudass = mysqli_query($emp->getConnection(), $sqlss);
		
	}
	
	
	
	
	
	
	$SqlVer = "UPDATE ".$_REQUEST['pag']."imagens SET principal = '".$_POST['principal']."' WHERE id = '".$_POST['id']."'";
	
	
	
	
}elseif($_POST['val'] == 'tecnico'){
	$sql = "SELECT * from ".$_REQUEST['pag']."imagens WHERE token = '".$token."' AND principal = 'tec'";
	$QueryMuda = mysqli_query($emp->getConnection(), $sql);
	while($tec = mysqli_fetch_array($QueryMuda)){
		$sqls = "UPDATE ".$_REQUEST['pag']."imagens SET principal = '0' WHERE id = '".$tec['id']."'";
		$QueryMudas = mysqli_query($emp->getConnection(), $sqls);
		
	}
	
	
	
	$SqlVer = "UPDATE ".$_REQUEST['pag']."imagens SET principal = 'tec' WHERE id = '".$_POST['id']."'";
	
	
	
	
}


$QueryVer = mysqli_query($emp->getConnection(), $SqlVer);

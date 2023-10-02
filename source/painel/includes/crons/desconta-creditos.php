<?
include ('../class.banco.php');
?>
<?
echo '<hr /><h2>Descontou créditos</h2><br />';
$emp = new connect();
$banco = $emp;

$clientes = $banco->listaDebug('lojas','creditos IS NOT NULL and creditos > -3');
//print_r($clientes);
$intervalDias = 0;


foreach($clientes as $cliente){
    if($cliente['creditos'] > -3){

        
        echo $cliente['nome'].'-'.$cliente['data'].'- <strong>'.$cliente['creditos'].'</strong><br />';

        $post['id'] = $cliente['id'];
        $post['creditos'] = $cliente['creditos'] - 1;
        if($post['creditos'] < 0){

        }

        $cadastroFinanceiro = $banco->cadastro($post,'lojas');
    }

}



?>
<?
session_start();
include('../../../../painel/includes/class.banco.php');
$banco = new connect();
$globals = $banco->lista('seo', "id = '1'");
$globals = $globals[0];
   
//print_r($_GET);
//print_r($_POST);
//echo $_GET['id'];

//cria carrinho
if($_GET['produto']){
    $post['data'] = Date('d-m-Y H:i:s');
    $post['loja'] = $_GET['loja'];
   
        $carrin = $banco->lista('carrinhos',"id = '".$_GET['carrinhoId']."'");
            if($carrin[0]['produtos'] != NULL){
                $carProd = unserialize($carrin[0]['produtos']);
            }
            $carProd[$_GET['produto']]['id'] = $_GET['produto'];
            $carProd[$_GET['produto']]['preco'] = $_GET['produtoPreco'];
            $carProd[$_GET['produto']]['precoOriginal'] = $_GET['produtoPrecoOriginal'];
            $carProd[$_GET['produto']]['cor'] = '1';
            $carProd[$_GET['produto']]['tamanho'] = '1';
            $carProd[$_GET['produto']]['quantidade'] = '1';
            $carProd[$_GET['produto']]['peso'] = '1';
             $post['produtos'] = serialize($carProd);


             //print_r($carProd);


    if($carrin[0]['id'] and $carrin[0]['id'] != 'e'){
        $post['id'] = $carrin[0]['id'];
    }
   
    
    $cart = $banco->cadastro($post,'carrinhos');    
    $cart = $cart[0];

    
    $carrinho = $banco->lista('carrinhos',"id = '".$post['id']."'");
    $carrinho = $carrinho[0];
    //print_r($carrinho);

}else{
    $carrinho = $banco->lista('carrinhos',"md5(id) = '".$_GET['carrinhoId']."'");
   // $carrinho = $carrinho[0];
}

if($carrinho['produtos']){
    $produtosAll = unserialize($carrinho['produtos']);
   // print_r($produtosAll);
}
?>
<div class="cart-header">
    <h2 data-cart-count="<?=count($produtosAll)?>">
        <img src="/assets/images/ico-shopping-cart.svg" alt="Meu carrinho">
        Meu Carrinho
    </h2>
    <span class="cart-close" data-cart-close>
        <i class="fa fa-times"></i>
    </span>
</div>
<form action="/identificacao" method="post">
    <input type="hidden" name="id" value="<?=$_GET['carrinhoId']?>" />
    <div class="cart-body">
        <?php
        //print_r($produtosAll);
            foreach ($produtosAll as $produto) {
                //$banco->lista('produtos',"id = '".$produto['id']."'");

                $produtos = $banco->lista('produtos, lojas_produtos', "lojas_produtos.EAN = '".$produto['id']."' and lojas_produtos.id_lj = '".$carrinho['loja']."' and produtos.EAN = lojas_produtos.EAN",'',' lojas_produtos.id desc');
                //foreach ($produtos as $produto) {
                    $imgProd[0] = NULL;
                    $imgProd = unserialize($produtos[0]['Imagens']);
                    $imgProd = $imgProd['produtoimagem'];
    $prec = str_replace('.','',$produtos[0]['price_original']);
                    $precos[] = str_replace(',','.',$prec);

        ?>
            <div class="cart-item" data-cart-item="<?php echo $key; ?>">
                <div class="cart-item-img">
                    <img src="<?php echo $imgProd[0]['Url']; ?>" alt="<?php echo $produtos[0]['Nome']; ?>">
                </div>
                <div class="cart-item-info">
                    <h4><?php echo $produtos[0]['Nome']; ?></h4>
                    <p>
                        <? if($produtos[0]['cor']){?>
                            Cor: <strong><?=$produtos[0]['cor']?></strong><br />
                        <?}?>
                        <? if($produtos[0]['tamanho']){?>
                            Tamanho: <strong><?=$produtos[0]['tamanho']?></strong><br />
                        <?}?>
                        <? if($produtos[0]['marca']){?>
                            Marca: <strong><?=$produtos[0]['marca']?></strong>
                        <?}?>
                    </p>
                </div>
                <div class="cart-item-qty">
                    <select name="qty[<?php echo $key; ?>]">
                        <?php for($i = 1; $i <= 10; $i++) { ?>
                            <option value="<?php echo $i; ?>" <? if($produtos[0]['qty'] == $i){echo 'selected';}?>><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="cart-item-price">
                    <div class="price">R$<?php echo $produtos[0]['price_original']; ?></div>
                </div>
                <div class="cart-item-delete" data-cart-item="<?php echo $key; ?>" data-cart-item-ean="<?php echo $produtos[0]['EAN']; ?>">
                    <i class="fa fa-times"></i>
                </div>
            </div>
        <?php
            }//}
        ?>
        
    </div>
    <div class="cart-footer">
        <div class="cart-footer-details">
            <h3>Resumo da compra</h3>
            <?
            //print_r($precos);
            $fret = str_replace(',','.',$globals['freteGlobal']);
            $subtotal = number_format(array_sum($precos),2,",",".");
            
            $total = number_format(array_sum($precos) + $fret,2,",",".");
            $ate = number_format($total / $globals['maxParcelas'],2,",",".") ;
            ?>
            <ul>
                <!-- foreach cart items -->
                <li>
                    <span>Subtotal</span>
                    <span>R$ <?=$subtotal?></span>
                </li>
                <!-- end foreach -->
                <li>
                    <span>Frete</span>
                    <span>R$ <?=$globals['freteGlobal']?></span>
                </li>
                <!-- Total -->
                <li class="cart-total">
                    <strong>Total</strong>
                    <strong>
                        R$ <?=$total?><br>
                        <span>Em até <?=$globals['maxParcelas']?>x de R$<?=$ate?></span>
                    </strong>
                </li>
            </ul>
        </div>
        <div class="cart-footer-btn">
            <input type="submit" class="btn-checkout" name="finalizar" value="Finalizar compra" />
        </div>
    </div>
</form>
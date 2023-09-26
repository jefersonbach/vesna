<?
session_start();
include('../../../../painel/includes/class.banco.php');
$banco = new connect();

if($_GET['produto'] and $_GET['carrinhoId']){
        $carrin = $banco->lista('carrinhos',"id = '".$_GET['carrinhoId']."'");
        if($carrin[0]['produtos'] != NULL){
            $carProd = unserialize($carrin[0]['produtos']);
            //print_r($carProd);
        }
        unset($carProd[$_GET['produto']]);
        //echo '<br /><br /><br />'.$_GET['produto'].'<br /><br /><br />';
        //print_r($carProd);
        $post['produtos'] = serialize($carProd);


             


    if($carrin[0]['id'] and $carrin[0]['id'] != 'e'){
        $post['id'] = $carrin[0]['id'];
    }
   
    
    $cart = $banco->cadastro($post,'carrinhos');    
    $cart = $cart[0];

    
    $carrinho = $banco->lista('carrinhos',"id = '".$carrin[0]['id']."'");
    $carrinho = $carrinho[0];
    //print_r($carrinho);
    $produtosAll = unserialize($carrinho['produtos']);



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
<div class="cart-body">
    <?php
       //print_r($produtosAll);
        foreach ($produtosAll as $produto) {
            //$banco->lista('produtos',"id = '".$produto['id']."'");

            $produtos = $banco->lista('produtos, lojas_produtos', "produtos.EAN = '".$produto['id']."' and lojas_produtos.id_lj = '".$carrinho['loja']."' and produtos.EAN = lojas_produtos.EAN",'',' lojas_produtos.id desc');
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
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
        $subtotal = number_format(array_sum($precos),2,",",".");
        $ate = number_format(array_sum($precos) / 6,2,",",".") ;
        $total = number_format(array_sum($precos) + 25.00,2,",",".") ;
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
                <span>R$ 25,00</span>
            </li>
            <!-- Total -->
            <li class="cart-total">
                <strong>Total</strong>
                <strong>
                    R$ <?=$total?><br>
                    <span>Em até 6x de R$<?=$ate?></span>
                </strong>
            </li>
        </ul>
    </div>
    <div class="cart-footer-btn">
        <a class="btn-checkout" href="/identificacao">Finalizar compra</a>
    </div>
</div>

<? } ?>
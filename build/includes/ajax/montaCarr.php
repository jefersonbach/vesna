
<div class="cart-header">
            <h2 data-cart-count="<?=count($produtosAll)?>">
                <img src="/assets/images/ico-shopping-cart.svg" alt="Meu carrinho">
                Meu Carrinhoasdasd
            </h2>
            <span class="cart-close" data-cart-close>
                <i class="fa fa-times"></i>
            </span>
        </div>
        <div class="cart-body">
            <?php
               
                foreach ($produtosAll as $produto) {
                    //$banco->lista('produtos',"id = '".$produto['id']."'");

                    $produtos = $banco->lista('produtos, lojas_produtos', "lojas_produtos.EAN = '".$produto['id']."' and lojas_produtos.id_lj = '".$store['id_lj']."' and produtos.EAN = lojas_produtos.EAN",'',' lojas_produtos.id desc');
                    foreach ($produtos as $produto) {
                        $imgProd[0] = NULL;
                        $imgProd = unserialize($produto['Imagens']);
                        $imgProd = $imgProd['produtoimagem'];

            ?>
                <div class="cart-item" data-cart-item="<?php echo $key; ?>">
                    <div class="cart-item-img">
                        <img src="<?php echo $imgProd[0]['Url']; ?>" alt="<?php echo $produto['Nome']; ?>">
                    </div>
                    <div class="cart-item-info">
                        <h4><?php echo $produto['Nome']; ?></h4>
                        <p>
                            Cor: Teste<br>
                            Tamanho: Teste<br>
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
                        <div class="price">R$<?php echo $produto['price_original']; ?></div>
                    </div>
                    <div class="cart-item-delete" data-cart-item="<?php echo $key; ?>">
                        <i class="fa fa-times"></i>
                    </div>
                </div>
            <?php
                }}
            ?>
            
        </div>
        <div class="cart-footer">
            <div class="cart-footer-details">
                <div class="cart-shipping">
                    <span>Cálcule o frete</span>
                    <input type="text" class="mask-cep" name="cep" placeholder="Informe seu CEP" maxlength="9">
                </div>
                <h3>Resumo da compra</h3>
                <ul>
                    <!-- foreach cart items -->
                    <li>
                        <span>Subtotal</span>
                        <span>R$ 99,00</span>
                    </li>
                    <!-- end foreach -->
                    <li>
                        <span>Frete</span>
                        <span>R$ 15,00</span>
                    </li>
                    <!-- Total -->
                    <li class="cart-total">
                        <strong>Total</strong>
                        <strong>
                            R$ 114,00<br>
                            <span>Em até 10x de R$14,40</span>
                        </strong>
                    </li>
                </ul>
            </div>
            <div class="cart-footer-btn">
                <a class="btn-checkout" href="/checkout">Finalizar compra</a>
            </div>
        </div>
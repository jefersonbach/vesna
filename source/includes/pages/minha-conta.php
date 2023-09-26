<div class="contentHome" style="background: #97E9C5; width:100%; min-height:500px; text-align:center">
    <div class="wrapperContent">
        <hr style="border: none; border-top:1px solid #fff; max-width:300px; margin:20px auto 10px" />


        <form action="" method="GET" style="line-height:30px">

        <div style="background: #fff; border-radius:25px; margin: 20PX 0 0; width:100%; padding: 0px 0px 40px;  box-shadow: 0 5px 10px rgba(0,0,0,0.15), 0 10px 200px rgba(0,0,0,0.15); position: relative; transform: translateZ(42px); ">

            <?
                $cliente = $banco->lista('parceiros', "id = '".$_COOKIE['cliente_empresa']."'");
            ?>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?=$cliente['id']?>" />
                    <div class="checkout-page">
                    <!-- User data -->
                    <div class="checkout-blocks">
                        <div class="fields-wrap">
                            <div class="fields-wrap on boxF lbl-1-2">
                                <div style="margin:0 auto; max-width: 500px; padding:0 30px; width:100%">
                                    <h3>Seus dados</h3><br />
                                    <label class="lbl lbl-1-2" style="font-size:20px">
                                        <span style="margin:0; padding:0">Nome completo</span>
                                        <?=$empe[0]['nome']?>
                                    </label>
                                    <label class="lbl lbl-1-2" style="font-size:20px">
                                        <span style="margin:0; padding:0">E-mail</span>
                                        <?=$_COOKIE['cliente_email']?>
                                    </label>
                                    <br /><br />
                                    <hr style="opacity:0.2" />
                                    <div class="controle"></div>
                                    <div style="text-align:center; width:100%">
                                        <span style="margin:0 auto; padding:0; line-height:14px; color:#999; font-size:12px">Logado na empresa</span>
                                        <h2 style="width:100%; margin:0"><?=$empe[0]['nome']?></h2>
                                        <a href="<?=$empe[0]['site']?>"><?=$empe[0]['site']?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="fields-wrap on boxF lbl-1-2">
                                <div style="margin:0 auto; max-width:500px; padding:0 30px">
                                    <h3>Alterar a minha senha</h3>
                                    <label class="lbl-1-1">
                                        <span>Digite a nova senha</span>
                                        <input class="text fields" type="password" name="cep"  maxlength="30" required>
                                    </label>
                                    <label class="lbl-1-1" >
                                        <span>Digite a nova senha mais uma vez</span>
                                        <input class="text fields" type="password" name="rua" maxlength="30" required>
                                    </label>
                                    <div class="controle"></div>
                                    <div class="btn-wrap">
                                        <input type="submit" class="btn-form btn-login" name="meus-dados" value="Alterar a minha senha" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
    
    </div></div>

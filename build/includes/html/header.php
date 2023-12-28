<header>
    <div class="wrap">
        <div class="header-items">
            <a <? if( $pg[1] != 'home' and $pg[1] != 'minha-conta' and $pg[1] != 'dashboard'){?>class="logohome" href="/"<? }else{?>class="logotipo" href="/home"<?}?> title="Vesna">
                <img src="/assets/images/favico.jpeg" alt="Vesna" style="max-width:120px; width:100%; border-radius:14px; overflow:hidden;  box-shadow: 0 10px 20px rgba(0,0,0,0.1)">
                <h1>vesna.partners</h1>
            </a>

        <?
        $empe = $banco->lista('parceiros', "id = '".$_COOKIE['cliente_empresa']."'");
            if( $pg[1] == 'home' or $pg[1] == 'minha-conta' or $pg[1] == 'dashboard'){?>

            <div class="header-titulo">
                <? if( $pg[1] == 'minha-conta'){?>
                        <h2 class="titulo">Minha<strong> Conta</strong>
                    <?}elseif( $pg[1] == 'dashboard'){?>
                        <h2 class="titulo"><strong> Dashboard</strong>
                    <?}else{?>
                        <h2 class="titulo">Relatório <strong> de vendas</strong>
                    <?}?>
                </div>
                <div class="header-icons">
                    <div class="minha-conta">
                        <p style="float:right; text-align:left; margin: 18px 0 0 10px">
                            <strong style="font: 600 17px/17px 'Nunito'"><?
                             echo $empe[0]['nome'];
                            ?></strong><br />
                            <span style="font: 300 14px/14px 'Nunito'; color:#666"> <?=$_COOKIE['cliente_nome']?></span> <br />
                            
                            <a href="/login/sair" style="text-decoration:none; background: rgba(255,255,255,0.6); border-radius:30px; padding:5px 10px; display:inline-block; font-size:12px">
                                <i class="fa fa-arrow-left"></i>
                                Sair
                            </a>
                        </p>
                        
                        <a href="/minha-conta" class="aIco">
                            <span class="ico" style="float:none; font-size:35px; margin:0 0px 0; display:block">
                                <i class="fa fa-user-circle-o"></i>
                            </span>
                            <span class="mobileHidden" style="text-align:center; border-radius:30px; padding:5px 0px;  font-size:13px; color:#fff; line-height:11px; text-transform:uppercase">Minha<br />conta</span>
                            
                        </a>
                        <a href="/dashboard" class="aIco">
                            <span class="ico" style="float:none; font-size:35px; margin:0 0px 0; display:block">
                                <i class="fa fa-dashboard"></i>
                            </span>
                            <span class="mobileHidden" style="text-align:center; border-radius:30px; padding:5px 0px;  font-size:11px; color:#fff; line-height:11px; text-transform:uppercase">Dashboard</span>
                            
                        </a>
                    </div>
                
            </div>
            <? } ?>
        </div>
    </div>
    <nav>
        <span class="btn-mob-fechar">
            <i class="fa fa-arrow-left"></i> Fechar
        </span>
        <div class="login-box">
            <a class="login-box-login" href="/login">
                <i class="fa fa-user-circle-o"></i>
                Olá, visitante.<br>
                Faça o seu login ou cadastre-se
            </a>
        </div>
    </nav>
</header>

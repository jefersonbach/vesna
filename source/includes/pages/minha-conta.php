<div class="contentHome" style="background: #97E9C5; width:100%; min-height:500px; text-align:center">
    <div class="wrapperContent">
        <hr style="border: none; border-top:1px solid #fff; max-width:300px; margin:20px auto 10px" />


        <form action="" method="GET" style="line-height:30px">

        <div style="background: #fff; border-radius:25px; margin: 70px 0 0; width:100%; padding: 0px 0px 40px;  box-shadow: 0 5px 10px rgba(0,0,0,0.15), 0 10px 200px rgba(0,0,0,0.15); position: relative; transform: translateZ(42px); ">

        <div style="width: <?=$widCas?>px; position: absolute; top:-50px; left: 50%; margin-left: -300px; height:50px;">
                <? 
                
                if($pgGet[0] == 'seus-dados'){
                    $stl1 = "margin:0 1px; box-shadow: 0 -10px 10px rgba(0,0,0,0.15);height:60px;  transform: translateZ(-50px); background-size:80% auto; opacity:1; ";
                }
                if($pgGet[0] == 'empresa'){
                    $stl2 = "margin:0 1px; box-shadow: 0 -10px 10px rgba(0,0,0,0.15);height:60px;  transform: translateZ(-50px); background-size:80% auto; opacity:1; ";
                }
                if($pgGet[0] == 'regras'){
                    $stl3 = "margin:0 1px; box-shadow: 0 -10px 10px rgba(0,0,0,0.15);height:60px;  transform: translateZ(-50px); background-size:80% auto; opacity:1; ";
                }
                if($pgGet[0] == 'links'){
                    $stl4 = "margin:0 1px; box-shadow: 0 -10px 10px rgba(0,0,0,0.15);height:60px;  transform: translateZ(-50px); background-size:80% auto; opacity:1; ";
                }
                ?>
                <a onclick="window.location='/minha-conta/seus-dados'+window.location.search;" style="text-decoration:none; cursor:pointer; float:left; margin:5px 1px 0; height:45px; width: 130px;max-width:140px; opacity:0.7; background:#fff ; background-size:70% auto; border-radius: 15px 15px 0 0;<?=$stl1?>">
                    Seus dados
                </a>
                <a onclick="window.location='/minha-conta/empresa'+window.location.search;" style="text-decoration:none; cursor:pointer; float:left; margin:5px 1px 0; height:45px; width: 130px;max-width:140px; opacity:0.7; background:#fff ; background-size:70% auto; border-radius: 15px 15px 0 0;<?=$stl2?>">
                    Empresa
                </a>
                <a onclick="window.location='/minha-conta/regras'+window.location.search;" style="text-decoration:none; cursor:pointer; float:left; margin:5px 1px 0; height:45px; width: 130px;max-width:140px; opacity:0.7; background:#fff ; background-size:70% auto; border-radius: 15px 15px 0 0;<?=$stl3?>">
                    Acordos
                </a>
                <a  onclick="window.location='/minha-conta/links'+window.location.search;" style="text-decoration:none; cursor:pointer; float:left; margin:5px 1px 0; height:45px; width: 130px;max-width:140px; opacity:0.7; background:#fff ; background-size:70% auto; border-radius: 15px 15px 0 0;<?=$stl4?>">
                    Links Úteis
                </a>
                <div class="controle"></div>
            </div>





            <?
                $cliente = $banco->lista('parceiros', "id = '".$_COOKIE['cliente_empresa']."'");
            ?>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?=$cliente['id']?>" />
                    <div class="checkout-page">
                    <!-- User data -->
                    <div class="checkout-blocks">
                        <div class="fields-wrap" style="<? if($pgGet[0] == 'seus-dados' or $pgGet[0] == ''){ echo "display: flex";}else{ echo "display: none";}?>">
                            <div class="fields-wrap on boxF lbl-1-2">
                                <div style="margin:0 auto; max-width: 500px; padding:0 30px; width:100%">
                                    <h3>Seus dados</h3><br />
                                    <label class="lbl lbl-1-2" style="font-size:20px">
                                        <span style="margin:0; padding:0">Nome completo</span>
                                        <?=$_COOKIE['cliente_nome']?>
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



                        <div class="fields-wrap" style="<? if($pgGet[0] == 'empresa'){ echo "display: flex";}else{ echo "display: none";}?>">
                        <div class="fields-wrap on boxF lbl-1-2">
                                <div style="margin:0 auto; max-width: 500px; padding:0 30px; width:100%">
                                    <h3>Informacões da empresa</h3><br />
                                    <h3><?=$empe[0]['nome']?></h3>

                                    <label class="lbl lbl-1-1" style="font-size:20px">
                                    <span style="margin:0 auto; padding:0; line-height:14px; color:#999; font-size:14px">Responsável</span>
                                       <?=$empe[0]['responsavel']?>
                                    </label>
                                    <label class="lbl lbl-1-1" style="font-size:20px">
                                        <span style="margin:0 auto; padding:0; line-height:14px; color:#999; font-size:14px">Telefone</span>
                                       <?=$empe[0]['telefone']?>
                                    </label>
                                    <label class="lbl lbl-1-1" style="font-size:20px">
                                        <span style="margin:0 auto; padding:0; line-height:14px; color:#999; font-size:14px">CNPJ</span>
                                        <?=$empe[0]['cnpj']?>
                                    </label>
                                    <label class="lbl lbl-1-1" style="font-size:20px">
                                        <span style="margin:0 auto; padding:0; line-height:14px; color:#999; font-size:14px">E-mail</span>
                                        <a href="mailto:<?=$empe[0]['email']?>"><?=$empe[0]['email']?></a>
                                    </label>
                                   

                                </div>
                            </div>
                            <div class="fields-wrap on boxF lbl-1-2">
                                <div style="margin:0 auto; max-width:500px; padding:0 30px">
                                <label class="lbl lbl-1-1" style="font-size:20px">
                                        <span style="margin:0 auto; padding:0; line-height:14px; color:#999; font-size:14px">Site</span>
                                        <a href="<?=$empe[0]['site']?>"><?=$empe[0]['site']?></a>
                                    </label>
                                    <label class="lbl lbl-1-1" style="font-size:20px">
                                        <span style="margin:0 auto; padding:0; line-height:14px; color:#999; font-size:14px; margin-top:15px">Endereco</span>
                                        <br />
                                        <?=$empe[0]['rua']?>, <?=$empe[0]['numero']?><br />
                                        <?=$empe[0]['bairro']?> <?=$empe[0]['cep']?><br />
                                        <?=$empe[0]['cidade']?> - <?=$empe[0]['estado']?><br />
                                        <?=$empe[0]['complemento']?>
                                    </label>
                                    
                                </div>
                                <div class="controle"></div>
                            </div>
                            
                        </div>




                        <div class="fields-wrap" style="<? if($pgGet[0] == 'regras'){ echo "display: flex";}else{ echo "display: none";}?>">
                            <div class="fields-wrap on boxF lbl-1-1">
                                <div style="margin:0 auto; max-width: 700px; padding:0 30px; width:100%">
                                <br />
                                <h2 style="text-align:center; margin: 0px auto 0; width:100%">Regras</h2><br />
                                    <div style="text-align:left; width:100%">
                                        <?=$empe[0]['regrasDesc']?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fields-wrap" style="<? if($pgGet[0] == 'links'){ echo "display: flex";}else{ echo "display: none";}?>">
                            <div class="fields-wrap on boxF lbl-1-1">
                                <div style="margin:0 auto; max-width: 700px; padding:0 30px; width:100%">
                                <br />
                                <h2 style="text-align:center; margin: 0px auto 0; width:100%">Links Úteis</h2><br />
                                    <div style="text-align:left; width:100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        



                    </div>
                </form>
            </div>
    
    </div></div>

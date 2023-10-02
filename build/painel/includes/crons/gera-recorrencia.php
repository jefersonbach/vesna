<?
ini_set('max_execution_time', 300);
ini_set('proxy_connect_timeout', 600);
ini_set('proxy_send_timeout', 600);
ini_set('proxy_read_timeout', 600);
ini_set('send_timeout', 600);
include ('../class.banco.php');
$emp = new connect();
$banco = $emp;
echo '<hr /><h2>Gerou cobrancas</h2><br />';

$clientes = $banco->lista('lojas','card_token is not null and (creditos = 0 OR creditos = -1 OR creditos = -2 OR creditos = -3)','','','limit '.$_GET['de'].','.$_GET['ate'].'');
//print_r($clientes);
$intervalDias = 0;
foreach($clientes as $cliente){

    //echo $cliente['nome'].' - '.date('m').' - '.$cliente['ultimoMesPago'].'<BR />';
    echo $cliente['nome'].'-'.$cliente['data'].'-'.$cliente['card_token'].'<br /><br />';
    echo $cliente['plano'].'<br />';
    print_r(unserialize($cliente['plano']));

    $plan = unserialize($cliente['plano']);
    //print_r($plano);
       // die;
    if($cliente['card_token']){
        
        if($plan['preco']){echo $plan['preco'].'<br /><br />';}


        $clientePlano = unserialize($cliente['plano']);
        


        $interv = strtotime("now") - $cliente['dataTime'];

        $expiraTeste = strtotime('+14 days',$cliente['dataCadastroTime']);
        $diferenca = $expiraTeste - strtotime('now');
        $diasFaltando = floor($diferenca / (60 * 60 * 24));
        

        $intervalDias = date("d", $interv);

       
            $_POST = $cliente;
            
           

            $AUTHH = false;
            $type = "CreditCard";
            $Installments = $_POST['installments'];

            $preco = str_replace('.','',$clientePlano['preco']);

            $brandCard = $_POST['bandeiraCartao'];
            if($brandCard == 'mastercard'){$brandCard = 'Master';}
                //$brandCard = 'Master';
                //echo '<br />123123123';
                echo trim(str_replace(' ','',str_replace(',','',$preco))).'<br />';

                $cardValidade = $cliente['card_validate'];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
                $corpo = array (
                    "MerchantOrderId" => "2775868864",
                    "setReturnUrl" => "https://www.trazpracaclub.com.br/checkout-identificacao",
                    "IsCryptoCurrencyNegotiation" => true,
                    "Customer" => array(
                        "Name" => $_POST['nome'],
                        "Email" => $_POST['email'],
                        "Identity" => $_POST['cpf'],
                        "IdentityType" => "cpf",
                        "Address" => array(
                            "Street" => $_POST['endereco'],
                            "Number" => $_POST['numero'],
                            "Complement" => $_POST['complemento'],
                            "ZipCode" => $_POST['cep'],
                            "City" => $_POST['cidade'],
                            "State" => $_POST['estado'],
                            "Country" => 'BRA'
                        )
                        ),
                    "Payment" => array(
                        "Type" => $type,
                        "Installments" => '1',
                        "Amount" => trim(str_replace(' ','',str_replace(',','',$preco))),
                        "Currency" => "BRL",
                        "Country" => "BRA",
                        "ServiceTaxAmount" => 0,
                        "ReturnUrl" => "https://www.trazpracaclub.com.br/cliente/compras/sucesso",
                        "SoftDescriptor" => 'TClub '.$clientePlano['nome'],
                    "Capture" => true,
                    "Authenticate" => $AUTHH,
                    "Recurrent" => true,
                        $type => array(
                            "CardToken" => $cliente['card_token'],
                            "SecurityCode" => $cliente['card_cvv'],
                            "Brand" => $brandCard
                        )
                    )
                );		
            $cabecalhos = array(
                "Accept: *",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "Cookie: ARRAffinity=3a02babc0cc38eeb801c631c2f295f1ec0118e81e96f7e9299bba265af2f446d",
                "Host: api.cieloecommerce.cielo.com.br",
                "MerchantId: 8b5ba8e3-9fdb-480b-a072-1681b2f84aea",
                "MerchantKey: CTBiTnbA7cmMR1HZEPPErphSkWfDOahaE4fnT2H8",
                "Postman-Token: e89852c0-9275-4a96-8ba8-e5aaee436b62,8034a67b-7d50-41cd-af9b-672a3b837389",
                "User-Agent: PostmanRuntime/7.18.0",
                "cache-control: no-cache"
            );
            
            //print_r($corpo);		
            //die;
            curl_setopt_array($curl, array(
                
            CURLOPT_URL => "https://api.cieloecommerce.cielo.com.br/1/sales",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($corpo),
            CURLOPT_HTTPHEADER => $cabecalhos
            ));

            $response = curl_exec($curl);

                    echo $response;
            $responses = json_decode($response);
                    
            print_r($responses);
            $err = curl_error($curl);

            curl_close($curl);


        

            unset($post['installments']);
            unset($post['card_btn']);
            unset($post['nome']);
            unset($post['email']);
            unset($post['cpf']);

            // apaga cartao
            unset($post['card_number']);
            unset($post['card_holder']);
            unset($post['card_cvv']);
            unset($post['card_validate']);

            

            $post['id_lj'] = $store['id_lj'];
            $post['data'] = strftime("%A, %d de %B de %Y");
            $post['dataTime'] = strftime("%Y-%m-%d %h:%m:%S");

            if($responses->Payment->ReturnCode == '00'){
                $post['status'] = 'aprovado';
            }else{
                $post['status'] = 'recusado';
            }
            
            

            $post['valorTotal'] = $preco;
            $post['total'] = $_POST['total'];

            
            $cadastroFinanceiro = $banco->cadastro($post,'lojas_financeiro');
            
            $post['endereco'] = $post2['endereco'];
            //print_r( $responses);
            // salva em pedidos
            $post['ip'] = getIPAddress();
            $post['retornoPagamento'] = serialize($responses);



            $plano = $banco->lista('lojas_planos',"loja = '".$cliente['id']."'",'','id desc','limit 1');
            //print_r($plano);
            $post['loja'] = $cliente['id'];
            $post['valor'] = $clientePlano['preco'];
            $post['idPlano'] = $clientePlano['id'];
            $post['nomePlano'] = $clientePlano['nome'];
            $post['data'] = date('d/m/Y');
            $post['mes'] = date('m');
            $post['situacao'] = 'ativo';


            //if($cliente['card_number']){
                // tenta cobrar, caso não consiga, tenta novamente no dia seguinte + envia email
                $mensal = $banco->cadastro($post,'planos_mensalidades');
                //if($responses[0]['Payment']['ReturnCode'] == '00'){
                    
                    if($mensal != 'erro'){
                        $pll['id'] = $cliente['id'];
                        $pll['ultimoMesPago'] = $post['mes'];
                        if($responses->Payment->Status == '2'){
                            $pll['creditos'] = 30;
                            $mensal = $banco->cadastro($pll,'lojas');
                        }
                        

                        //$mensal = $banco->cadastro($pll,'lojas_planos');
                    }
                //}
            //}
    
}
}



?>
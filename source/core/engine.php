<?
	// Clear Vars
	foreach($_POST as $key => $val){
		if(!is_array($_POST[$key])){
			$_POST[$key] = cleanuserinput($val, $connect);
		}
	}
	foreach($_GET as $key => $val){
		if(!is_array($_GET[$key])){
			$_GET[$key] = cleanuserinput($val, $connect);
		}
	}
	foreach($_REQUEST as $key => $val){
		if(!is_array($_REQUEST[$key])){
			$_REQUEST[$key] = cleanuserinput($val, $connect);
		}
	}

	if(!isset($_REQUEST['pg'])){
		$_REQUEST['pg'] = 'home';
	}

	$host = 'http://'.$_SERVER['HTTP_HOST'];
	$retorno = explode('/', $_REQUEST['pg']);
	$pag = $retorno[0];
	unset($retorno[0]);

	// Define Website Host / Cookie Host
	$website_host = str_replace('www', '', $_SERVER['HTTP_HOST']);
	$cookie_host = str_replace('app', '', $_SERVER['HTTP_HOST']);

	// Define Subdomain Rules and Directories
	$subdomain = explode('.', $_SERVER['HTTP_HOST']);
	$subdomain = $subdomain[0];

	// URLS: URL Vars/Parms
	$i = 0;
	foreach ( $retorno as $val ){
		if ( $i % 2 == 0 ){
			$minds[] = $val;
		}else{
			$mvals[] = $val;
		}
		 $i++;
	}
	if(isset($minds)) {
		for($i=0; $i < count($minds); $i++) {
			${$minds[$i]} = $mvals[$i];
		}
	}

	// App: Logout
	if($pag=='sair'){
		setcookie(md5('pr_id'), '', -3600, '/', $cookie_host);
		setcookie(md5('pr_id_usuario'), '', -3600, '/', $cookie_host);
		setcookie(md5('pr_nome'), '', -3600, '/', $cookie_host);
		setcookie(md5('pr_email'), '', -3600, '/', $cookie_host);

		unset($_COOKIE[md5('pr_id')]);
		unset($_COOKIE[md5('pr_id_usuario')]);
		unset($_COOKIE[md5('pr_nome')]);
		unset($_COOKIE[md5('pr_email')]);

		session_destroy();
		$pag = 'login';
	}

	// App: Login
	if(isset($_REQUEST['login']) && $_REQUEST['login'] == 'Logar'){

		if(isset($_REQUEST['email']) && isset($_REQUEST['senha'])){

			// Verificação de cadastro
			$verificacao_login = mysqli_query($connect, 'SELECT * FROM pr_usuario WHERE senha = md5("'.$_REQUEST['senha'].'") AND email = "'.$_REQUEST['email'].'"');
			if($verificacao_login && mysqli_num_rows($verificacao_login) > 0) {
				$user = mysqli_fetch_assoc($verificacao_login);

				setcookie(md5('pr_id'), md5($user['id']), 0, '/', $cookie_host);
				setcookie(md5('pr_nome'), md5($user['nome']), 0, '/', $cookie_host);
				setcookie(md5('pr_email'), md5($user['email']), 0, '/', $cookie_host);

				// Logs: Insere data
				$log = mysqli_query($connect, 'UPDATE pr_usuario SET data_login = NOW() WHERE id = "'.$user['id'].'"');
			}

			// Redirect
			$address_host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
			header('location:http://'.$address_host);
		}
	}
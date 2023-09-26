<?php

	function cleanuserinput($dirty, $connection){
		if (get_magic_quotes_gpc()) {
			$clean = mysqli_real_escape_string($connection, stripslashes($dirty));
		} else {
			$clean = mysqli_real_escape_string($connection, $dirty);
		}
		return $clean;
	}

	function slug($string){
		return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}

	function toAscii($str) {
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
		return $clean;
	}

	function datetimetostr($valor){
		if( trim($valor) != '' ) {
			return substr($valor,8,2).'/'.substr($valor,5,2).'/'.substr($valor,0,4).' às '.substr($valor,10);
		}
	}

	function datetostr($valor){
		if( trim($valor) != '' ) {
			return substr($valor,8,2).'/'.substr($valor,5,2).'/'.substr($valor,0,4);
		}
	}

	function datetimetostrd($valor){
		if( trim($valor) != '' ) {
			return substr($valor,8,2).'/'.substr($valor,5,2).'/'.substr($valor,0,4).((trim(substr($valor,10))=='00:00:00') ? '' : substr($valor,10) );
		}
	}

	function datetimetostrx($valor){
		if( trim($valor) != '' ) {
			setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
			date_default_timezone_set( 'America/Sao_Paulo' );
			
			return substr($valor,8,2).' de '.date('M', strtotime($valor));
		}
	}

	function strtodate($valor){
		if( trim($valor) != '' ) {
			return substr($valor,6,4).'-'.substr($valor,3,2).'-'.substr($valor,0,2);
		}
	}

	function valor_BR( $valor ) {
		if($valor > 0) {
			return number_format( $valor , 2 ,',','.');
		} else {
			return '0,00';
		}
	}

	function valor_USA( $valor ) {
		return number_format( $valor , 2 ,'.',',');
	}

	function valor_US( $valor ) {
		$valor = str_replace('.','',$valor);
		$valor = str_replace(',','.',$valor);
		return $valor;
	}

	function sqlinsert($tabela, $dados, $connection){
            $campos = implode(", ", array_keys($dados));
            $valores = "'".implode("','", array_values($dados))."'";
			echo " INSERT INTO `{$tabela}` ({$campos}) VALUES ({$valores}) ";
            return exesql($connection, "INSERT INTO `{$tabela}` ({$campos}) VALUES ({$valores}) ");
	}

	function datames($valor){
		if( trim($valor) != '' ) {
			return substr($valor,8,2).'/'.substr($valor,5,2);
		}
	}

    function sqlselect($tabela, $where = null, $limit = null, $offset = null, $orderby = null, $connection){
            $where = ($where != null ? "WHERE {$where}" : "");
            $limit = ($limit != null ? "LIMIT {$limit}" : "");
            $offset = ($offset != null ? "OFFSET {$offset}" : "");
            $orderby = ($orderby != null ? "ORDER BY {$orderby}" : "");
			//echo " SELECT * FROM `{$tabela}` {$where} {$orderby} {$limit} {$offset} ";
            $sqlrs = exesql($connection, " SELECT * FROM `{$tabela}` {$where} {$orderby} {$limit} {$offset} ");
			return $sqlrs;
	}

	function sqlexecutar($comsql){
		$sqlrs = exesql($comsql);
		if( $sqlrs ) {
			$ret['resultado'] = 'OK';
			$ret['mensagem'] = 'Registro excluído com sucesso';
			$ret['classe'] = 'c-success';
			$ret['registros'] = $sqlrs;
		} else {
			$ret['resultado'] = 'ERRO';
			$ret['mensagem'] = 'Erro ao excluir registro';
			$ret['classe'] = 'c-error';
		}
		return $ret;
	}

	function sqltraz1valor($comsql){
		$sqlrs = exesql($comsql);
		if( $sqlrs && mysqli_num_rows($sqlrs) > 0 ) {
			$rowrs = mysqli_fetch_array($sqlrs);
			return $rowrs[0];
		} else {
			return null;
		}
		return $ret;
	}

    function sqlupdate($tabela, Array $dados, $where, $connection){
		foreach ( $dados as $ind => $val ){
			$campos[] = "{$ind} = '{$val}'";
		}
		$campos = implode(", ", $campos);
		echo " UPDATE `{$tabela}` SET {$campos} WHERE {$where} ";
		$sqlrs = exesql($connection, " UPDATE `{$tabela}` SET {$campos} WHERE {$where} ");
		if( $sqlrs ) {
			$ret['resultado'] = 'OK';
			$ret['mensagem'] = 'Registro excluído com sucesso';
			$ret['classe'] = 'c-success';
		} else {
			$ret['resultado'] = 'ERRO';
			$ret['mensagem'] = 'Erro ao excluir registro';
			$ret['classe'] = 'c-error';
		}
		return $ret;
	}

    function sqldelete( $tabela, $where, $connection){
		//echo " DELETE FROM `{$tabela}` WHERE {$where} ";
        if( exesql($connection, " DELETE FROM `{$tabela}` WHERE {$where} ")) {
			$ret['resultado'] = 'OK';
			$ret['mensagem'] = 'Registro excluído com sucesso';
			$ret['classe'] = 'c-success';
		} else {
			$ret['resultado'] = 'ERRO';
			$ret['mensagem'] = 'Erro ao excluir registro';
			$ret['classe'] = 'c-error';
		}
		return $ret;
	}

	function salvar_campos( $tabela, $var_salvar, $filtro, $id = NULL, $connection) {
		//echo '-'.$transacao;
		//$var_salvar = 'S';
		if($var_salvar == 'S') {

			//---SQL SELECT
			$sql_select = 'SELECT * FROM '.$tabela.' WHERE '.$filtro;
			//echo $sql_select;
			//echo '<br><br>sql_select: '.$sql_select.'<br><br>';

			//---SQL INSERT
			$sql_insert = 'INSERT INTO '.$tabela.' VALUES ( ';

			//---GERA VALOR A PARTIR DO POST
			foreach($_POST as $chave => $valor) {
				$vetor_post[$chave] = $valor;
			}

			$rs = exesql($connection, ' DESCRIBE '.$tabela);
			while($dados_db = mysqli_fetch_assoc($rs)) {
				//print_r($dados_db);
				//echo '<br>'.$dados_db['Type'].'|'.$vetor_post[$dados_db['Field']];
				if( substr($dados_db['Type'],0,3) == 'int' ) {
					if( trim($vetor_post[$dados_db['Field']]) == '' ) {
						$sql_insert .= " 0, ";
					} else {
						$sql_insert .= $vetor_post[$dados_db['Field']].", ";
					}
				} else if( substr($dados_db['Type'],0,7) == 'varchar' || substr($dados_db['Type'],0,4) == 'char' ) {
					$vetor_post[$dados_db['Field']] = str_replace('"','&quot;',$vetor_post[$dados_db['Field']]);
					if( trim($vetor_post[$dados_db['Field']]) == '' ) {
						$sql_insert .= ' "", ';
					} else {
						$sql_insert .= '"'.strip_tags($vetor_post[$dados_db['Field']]).'", ';
					}
				} else if( substr($dados_db['Type'],0,4) == 'text' ) {
					//$vetor_post[$dados_db['Field']] = str_replace('"','&quot;',$vetor_post[$dados_db['Field']]);
					if( trim($vetor_post[$dados_db['Field']]) == '' ) {
						$sql_insert .= ' "", ';
					} else {
						$sql_insert .= '"'.($vetor_post[$dados_db['Field']]).'", '; //strip_tags
					}
				} else if( substr($dados_db['Type'],0,4) == 'enum' ) {
					if( trim($vetor_post[$dados_db['Field']]) == '' ) {
						$sql_insert .= ' NULL, ';
						//$sql_insert .= ' "Não", ';
					} else {
						if( trim($vetor_post[$dados_db['Field']]) == 'on' ) {
							$sql_insert .= '"Sim", ';
						} else {
							$sql_insert .= '"'.$vetor_post[$dados_db['Field']].'", ';
						}
					}
				} else if( substr($dados_db['Type'],0,6) == 'double' || substr($dados_db['Type'],0,5) == 'float' || substr($dados_db['Type'],0,7) == 'decimal' ) {
					if( trim($vetor_post[$dados_db['Field']]) == '' ) {
						$sql_insert .= " 0, ";
					} else {
						//---PEGA NUMERO DE DECIMAIS
						$xtam = 2;
						if(substr($tipo_campos[$chave],0,5) == 'float' || substr($tipo_campos[$chave],0,6) == 'double' || substr($tipo_campos[$chave],0,7) == 'decimal'){
							$xtam = substr($tipo_campos[$chave],(strpos($tipo_campos[$chave],',')+1),1);
						}
						$valor = $vetor_post[$dados_db['Field']];
						if( strpos($valor,',') > 0 ) {
							$valor = str_replace('.','',$valor);
							$valor = str_replace(',','.',$valor);
								//echo ' - '.$valor;
							$sql_insert .= number_format($valor,$xtam,'.','').", ";
						} else {
							$sql_insert .= number_format($valor,$xtam,'.','').", ";
						}
						//$sql_insert .= number_format($vetor_post[$dados_db['Field']],2,'.','').", ";
					}
				} else if( substr($dados_db['Type'],0,4) == 'date' || substr($dados_db['Type'],0,8) == 'datetime' ) {
					if( trim($vetor_post[$dados_db['Field']]) == '' ) {
						$sql_insert .= ' NULL, ';
					} else {
						if( $vetor_post[$dados_db['Field']] == 'NOW()' ) {
							$sql_insert .= 'NOW(), ';
						} else {
							if( strpos($vetor_post[$dados_db['Field']],'/') > 0 ) {
								$sql_insert .= '"'.strtodate($vetor_post[$dados_db['Field']]).'", ';
							} else {
								$sql_insert .= '"'.($vetor_post[$dados_db['Field']]).'", ';
							}
						}
					}
				} else {
					echo $dados_db['Field'].'|'.$dados_db['Type'];
				}

				$tipo_campos[$dados_db['Field']] = $dados_db['Type'];
			}
			$sql_insert = substr($sql_insert,0,(strlen($sql_insert)-2));
			$sql_insert .= ')';


			//---SQL UPDATE
			$sql_update = 'UPDATE '.$tabela.' SET ';

			foreach($_POST as $chave => $valor) {
				if( $chave != 'salvar' ) {
					if( substr($tipo_campos[$chave],0,3) == 'int' ) {
						if( trim($valor) == '' ) {
							$sql_update .= $chave." = 0, ";
						} else {
							$sql_update .= $chave." = ".$valor.", ";
						}
					} else if( substr($tipo_campos[$chave],0,7) == 'varchar' || substr($tipo_campos[$chave],0,4) == 'char' ) {
						$valor = str_replace('"','&quot;',$valor);
						if( trim($valor) == '' ) {
							$sql_update .= $chave.' = "", ';
						} else {
							$sql_update .= $chave.' = "'.strip_tags($valor).'", ';
						}
					} else if( substr($tipo_campos[$chave],0,4) == 'text' ) {
						//$valor = str_replace('"','&quot;',$valor);
						if( trim($valor) == '' ) {
							$sql_update .= $chave.' = "", ';
						} else {
							$sql_update .= $chave.' = "'.($valor).'", '; //$dados_tela['banco']
						}
					} else if( substr($tipo_campos[$chave],0,4) == 'enum' ) {
						if( trim($valor) == '' ) {
							$sql_update .= $chave.' = "", ';
						} else {
							$sql_update .= $chave.' = "'.$valor.'", ';
						}
					} else if( substr($tipo_campos[$chave],0,4) == 'date' || substr($tipo_campos[$chave],0,8) == 'datetime' ) {
						if( trim($valor) == '' ) {
							$sql_update .= $chave.' = NULL, ';
						} else {
							if( $valor == 'NOW()' ) {
								$sql_update .= $chave.' = NOW(), ';
							} else {
								if( strpos($valor,'/') > 0 ) {
									$sql_update .= $chave.' = "'.strtodate($valor).'", ';
								} else {
									$sql_update .= $chave.' = "'.$valor.'", ';
								}
							}
						}
					} else if( substr($tipo_campos[$chave],0,6) == 'double' || substr($tipo_campos[$chave],0,5) == 'float' || substr($tipo_campos[$chave],0,7) == 'decimal' ) {
						if( trim($valor) == '' ) {
							$sql_update .= $chave.' = 0, ';
						} else {
							//---PEGA NUMERO DE DECIMAIS
							$xtam = 2;
							if(substr($tipo_campos[$chave],0,5) == 'float' || substr($tipo_campos[$chave],0,6) == 'double' || substr($tipo_campos[$chave],0,7) == 'decimal'){
								$xtam = substr($tipo_campos[$chave],(strpos($tipo_campos[$chave],',')+1),1);
							}
							if( strpos($tipo_campos[$chave],',') > 0 ) {
								$valor = str_replace('.','',$valor);
								$valor = str_replace(',','.',$valor);
								$sql_update .= $chave.' = '.number_format($valor,$xtam,'.','').', ';
							} else {
								$sql_update .= $chave.' = '.number_format($valor,$xtam,'.','').', ';
							}
						}
					} else {
						echo $tipo_campos[$chave];
					}
				}
			}
			$sql_update = substr($sql_update,0,(strlen($sql_update)-2));
			$sql_update .= ' WHERE '.$filtro;

			/*$sql_select .= $chave_select;
			$sql_insert .= $chave_insert;
			$sql_update .= $chave_update; */

			//$sql_select .= " WHERE id_item = ".$item;
			//$sql_update .= " data_alteracao = NOW(), usuario_alteracao = ".$_SESSION['usuario']['dados']['ID_USUARIO'];
			//$sql_update .= " WHERE id_item = ".$item;
			//$sql_insert .= " NOW(), ".$_SESSION['usuario']['dados']['ID_USUARIO'].',NULL,0)';

			$rs = exesql($connection, $sql_select);

			//echo '<br>'.$sql_select;
			if( $rs && mysqli_num_rows($rs) > 0 ) {
				//echo '<br><br>Atualiza<br><br>';
				$rs = exesql($connection, $sql_update);
				//echo '<br>'.$sql_update;
				$_SESSION['insert_id'] = NULL;
				$_SESSION['sql'] = $sql_update;
				//---GERA LOG
				//gera_log('alterar', $area, $projeto, $item);
				//------------
			} else {
				//echo '<br><br>Adiciona<br><br>';
				$rs = exesql($connection, $sql_insert);
				//echo '<br>'.$sql_insert;
				$_SESSION['insert_id'] = mysqli_insert_id($connection);
				$_SESSION['sql'] = $sql_insert;
				//---GERA LOG
				//gera_log('inserir', $area, $projeto, $item);
				//------------
			}
			if( $rs ) {
				$ret['resultado'] = 'OK';
				$ret['mensagem'] = 'O seu registro foi salvo com sucesso!';
				$ret['classe'] = 'c-success';
			} else {
				$ret['resultado'] = 'ERRO';
				$ret['mensagem'] = 'Erro ao salvar o seu registro!';
				$ret['classe'] = 'c-error';
			}
			return $ret;
		}
	}

	function listArrayRecursive($array_name, $ident = 0){
		if (is_array($array_name)){
			foreach ($array_name as $k => $v){
				if (is_array($v)){
					for ($i=0; $i < $ident * 10; $i++){ echo "&nbsp;"; }
					echo $k . " : " . "<br>";
					listArrayRecursive($v, $ident + 1);
				}else{
					for ($i=0; $i < $ident * 10; $i++){ echo "&nbsp;"; }
					echo $k . " : " . $v . "<br>";
				}
			}
		}else{
			echo "Variable = " . $array_name;
		}
	}

	function categorias_ordenadas($parent='0',$spacer ='') {
		$sqlcat = 'SELECT * FROM produtos_categorias WHERE id_pai='.$parent.' ORDER BY categoria ASC ';
		$rscat = exesql($sqlcat);
		if($rscat && mysqli_num_rows($rscat) > 0) {
			$num = mysqli_num_rows($rscat);
			$spacer .= '&nbsp;&nbsp;&nbsp;';
			//echo '<ul>';
			while(FALSE !== ($row = mysqli_fetch_assoc($rscat))){
				if($num==0 || $row['id_pai']=='0') {
					$spacer = '';
				}
				//echo '<li>';
				echo '<option value="'.$row['id'].'">'.$spacer.$row['categoria'].'</option>';
				categorias_ordenadas($row['id'],$spacer);
				//echo '</li>';
			}
			//echo '</ul>';
		}
	}

	function getCategoryThree($category, $connection) {
		$result = '';
		
		$categories = mysqli_query($connection, 'SELECT pr_produto_categorias.categoria, pr_produto_categorias.id_pai FROM pr_produto_categorias WHERE pr_produto_categorias.id = "'.$category.'"');
		if($categories && mysqli_num_rows($categories) > 0) {
			$category = mysqli_fetch_assoc($categories);

			$result = $category['categoria'];

			if($category['id_pai'] > 0) {
				$categories = mysqli_query($connection, 'SELECT pr_produto_categorias.categoria FROM pr_produto_categorias WHERE pr_produto_categorias.id = "'.$category['id_pai'].'"');
				if($categories && mysqli_num_rows($categories) > 0) {
					$category = mysqli_fetch_assoc($categories);

					$result = ' &rsaquo; '.$result;
				}
			}
		}

		return $result;
	}

	function categorias_emarvore($selected, $parent='0',$spacer ='') {
		$sqlcat = 'SELECT * FROM produtos_categorias WHERE id_pai='.$parent.' ORDER BY categoria ASC ';
		$rscat = exesql($sqlcat);
		if($rscat && mysqli_num_rows($rscat) > 0) {
			$num = mysqli_num_rows($rscat);
			$spacer .= '&nbsp;&nbsp;&nbsp;';
			//echo '<ul>';
			while(FALSE !== ($row = mysqli_fetch_assoc($rscat))){
				if($num==0 || $row['id_pai']=='0') {
					$spacer = '';
				}
				//echo '<li>';
				echo '<option value="'.$row['id'].'" '.(($row['id']==$selected) ? 'selected' : '').'>'.$spacer.$row['categoria'].'</option>';
				categorias_emarvore($selected, $row['id'],$spacer);
				//echo '</li>';
			}
			//echo '</ul>';
		}
	}

	function categorias_listagem($selected, $parent='0',$spacer ='') {
		$sqlcat = 'SELECT * FROM produtos_categorias WHERE id_pai='.$parent.' ORDER BY categoria ASC ';
		$rscat = exesql($sqlcat);
		if($rscat && mysqli_num_rows($rscat) > 0) {
			$num = mysqli_num_rows($rscat);
			$spacer .= '&nbsp;&nbsp;&nbsp;';
			echo '<ul>';
			while(FALSE !== ($row = mysqli_fetch_assoc($rscat))){
				if($num==0 || $row['id_pai']=='0') {
					$spacer = '';
				}
				echo '<li>';
				echo $spacer.'<a href="/produtos/categoria/'.$row['id'].'" '.(($row['id']==$selected) ? 'selected' : '').'>'.$row['categoria'].'</a>';
				echo '</li>';
				categorias_listagem($selected, $row['id'],$spacer);
			}
			echo '</ul>';
		}
	}

	function categorias_lista($selected, $categoria, $parent='0',$spacer ='') {
		$sqlcat = 'SELECT * FROM produtos_categorias WHERE id_pai='.$parent.' ORDER BY categoria ASC ';
		$rscat = exesql($sqlcat);
		if($rscat && mysqli_num_rows($rscat) > 0) {
			$num = mysqli_num_rows($rscat);
			$spacer .= '&nbsp;&nbsp;&nbsp;';
			echo '<ul>';
			while(FALSE !== ($row = mysqli_fetch_assoc($rscat))){
				if($num==0 || $row['id_pai']=='0') {
					$spacer = '';
				}
				echo '<li>';
				echo $spacer.'<a href="/'.$row['clean_url'].'" '.(($row['id']==$selected) ? 'selected' : '').'>'.$row['categoria'].'</a>';
				echo '</li>';
				categorias_lista($selected,$categoria, $row['id'],$spacer);
			}
			echo '</ul>';
		}
	}

	function cats_childs($parent='0',$spacer ='') {
		$sqlcat = 'SELECT * FROM produtos_categorias WHERE id_pai='.$parent.' ORDER BY categoria ASC ';
		$rscat = exesql($sqlcat);
		if($rscat && mysqli_num_rows($rscat) > 0) {
			$mcatss = '';
			while(FALSE !== ($row = mysqli_fetch_assoc($rscat))){
				//$mcatss[] = $row['id'];
				$_SESSION['xfiltro'] .= $row['id'].',';
				cats_childs($row['id'],$spacer);
			}
			//print_r($mcatss);
			//return implode(',',$mcatss);
		}
	}

	function upload($arq, $dir, $prefixo=''){
		if(!empty($arq["tmp_name"])){
			$ext = explode('.',$arq['name']);
			if(!$prefixo) {
				//$temp = slug(str_replace(end($ext), '', $arq['name'])).'.'.end($ext);
				$temp = slug(str_replace(end($ext), '', $arq['name']).date('YmdHis')).'.'.end($ext);
			} else {
				$temp = slug(str_replace(end($ext), '', $arq['name']).date('YmdHis')).'.'.end($ext);
			}
			if( !move_uploaded_file( $arq["tmp_name"], $dir.$temp ) ) {
				$ret['resultado'] = false;
				$ret['mensagem'] = 'Erro ao enviar arquivo';
				$ret['classe'] = 'c-error';
			} else {
				$ret['resultado'] = true;
				$ret['mensagem'] = 'Arquivo enviado com sucesso';
				$ret['classe'] = 'c-success';
				$ret['arquivo'] = $temp;
			}
			return $ret;
		}
	}

	function uploads($arq, $dir, $prefixo=''){
        if(gettype($arq["tmp_name"]) == 'array'){
            foreach($arq["tmp_name"] as $key => $val) {
                if(!empty($val)){
                    $ext = explode('.',$arq['name'][$key]);
                    $temp = slug(str_replace(end($ext), '', $arq['name'][$key]).date('YmdHis')).'.'.end($ext);
                    if( !move_uploaded_file( $val, $dir.$temp ) ) {
                        $ret[$key]['resultado'] = false;
                        $ret[$key]['mensagem'] = 'Erro ao enviar arquivo';
                        $ret[$key]['classe'] = 'erro';
                    } else {
                        $ret[$key]['resultado'] = true;
                        $ret[$key]['mensagem'] = 'Arquivo enviado com sucesso';
                        $ret[$key]['classe'] = 'sucesso';
                        $ret[$key]['arquivo'] = $temp;
                    }
                }
            }
            return $ret;
        } else {
            echo '1';
            if(!empty($arq["tmp_name"])){
                $ext = explode('.',$arq['name']);
                $temp = slug(str_replace(end($ext), '', $arq['name']).date('YmdHis')).'.'.end($ext);
                if( !move_uploaded_file( $arq["tmp_name"], $dir.$temp ) ) {
                    $ret['resultado'] = false;
                    $ret['mensagem'] = 'Erro ao enviar arquivo';
                    $ret['classe'] = 'erro';
                } else {
                    $ret['resultado'] = true;
                    $ret['mensagem'] = 'Arquivo enviado com sucesso';
                    $ret['classe'] = 'sucesso';
                    $ret['arquivo'] = $temp;
                }
                return $ret;
            }
        }
    }

	function delete_files($target) {
		if(is_dir($target)){
			$files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

			foreach( $files as $file ){
				delete_files( $file );
			}

			rmdir( $target );
		} elseif(is_file($target)) {
			unlink( $target );
		}
	}

	//FUNÇÃO PARA COPIAR ARQUIVOS
	function copiaArquivo($arquivo, $dir, $ext = '', $renomear = '', $modo = 0777) {

		if($arquivo != '') {
			if($ext == '')
				$extencoes = array('php','php3');
			else
				$extencoes = explode(',', strtolower($ext));

			$arqExt = explode('.', $arquivo['name']);

			//Verifica se a extenção do arquivo está contido no array
			if(!in_array(strtolower(end($arqExt)), $extencoes)) {
				//Cria o diretório caso não exista
				$erro = criaDiretorio($dir, $modo);
				if($erro)
					return $erro;

				//Se quer renomear o arquivo
				if($renomear)
					$nome = date('dmyhis_').CleanMakerImg($renomear);
				else
					$nome = date('dmyhis_').CleanMakerImg($arquivo['name']);

				if(move_uploaded_file($arquivo['tmp_name'], $dir.$nome)) {
					//resizeImage($dir.$nome, strtolower(end($arqExt)), 800, 600);
					chmod($dir.$nome, $modo);

					return $nome;
				}

				return 1;
			} else
				return 2;
		} else
			return 3;
	}

	function encrypt($string, $key) {
		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}

		return base64_encode($result);
	}

	function decrypt($string, $key) {
		$result = '';
		$string = base64_decode($string);

		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}

		return $result;
	}

	function gravalog($pstr){
		$novoarquivo = fopen("erro_sql.txt",'a+');
		fwrite($novoarquivo, $pstr.' | '.$_SERVER['QUERY_STRING'].' | '.chr(13).chr(10));
		fclose($novoarquivo);
	}

	function exesql($connection, $psql, $pline='', $pfile=''){
		$xrs = mysqli_query($connection, $psql);
		if($xrs){
			return $xrs;
		} else {
			gravalog($psql.' | ARQUIVO: '.$pfile.' | LINHA: '.$pline.' | '.mysqli_error($connection));
		}
	}


	function envia_email($para, $assunto, $mensagem, $userinfo, $file = '', $captcha){

		if($captcha != '') {
			$secretKey = '6LdIVrsUAAAAAAANAxn0Wd5S1V3Wud91dqzVvrSU';
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($ch);
			curl_close($ch);

			$responseKeys = json_decode($response,true);
			if(!$responseKeys['success'] || $responseKeys['score'] < '0.5') {
				$ret['classe'] = 'c-error';
		        $ret['mensagem'] = "Não foi possível enviar sua mensagem! ReCaptcha Error.";
		        $ret['resultado'] = false;
		        return $ret;
			}
		}

		$cor = 'blue';

	    if(file_exists('assets/libs/phpmailer/class.phpmailer.php')){
	        require_once('assets/libs/phpmailer/class.phpmailer.php');
	        require_once('assets/libs/phpmailer/class.smtp.php');
	    } elseif(file_exists('./assets/libs/phpmailer/class.phpmailer.php')){
	        require_once('./assets/libs/phpmailer/class.phpmailer.php');
	        require_once('./assets/libs/phpmailer/class.smtp.php');
	    } elseif(file_exists('../assets/libs/phpmailer/class.phpmailer.php')){
	        require_once('../assets/libs/phpmailer/class.phpmailer.php');
	        require_once('../assets/libs/phpmailer/class.smtp.php');
	    } elseif(file_exists('../../assets/libs/phpmailer/class.phpmailer.php')){
	        require_once('../../assets/libs/phpmailer/class.phpmailer.php');
	        require_once('../../assets/libs/phpmailer/class.smtp.php');
	    }

	    if($userinfo == '') {
	    	$userinfo = array(
		    	'email_host' => "ftp.sorvetesurca.com.br",
				'email_port' => 466,
				'email_user' => "sorvetesurca\sorvetesurca",
				'email_password' => "sunrise.2011@35",
				'title' => "Sorvetes Urca",
				'email_contato' => "sorvetesurca@sorvetesurca.com.br"
			);
		}

	    $mail = new PHPMailer(true);
	    $mail->IsSMTP();

	    $xmsg = '
	        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	        <html xmlns="http://www.w3.org/1999/xhtml">
	        <head>
	            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	            <title>'.$assunto.' | Sorvetes Urca</title>
	        </head>
	        <body bgcolor="#f0f0f0" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">
	            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
	                <tr>
	                    <td>
	                        <br>
	                        <!-- Wrapper -->
	                        <table bgcolor="#fff" width="600" cellpadding="30" cellspacing="0" align="center" style="border: 1px solid #eee; border-radius: 2px;">
	                            <!-- Cabeçalho -->
	                            <tr>
	                                <td bgcolor="#fafafa" style="background: #fafafa; border-bottom: 1px solid #fafafa; text-align: center;">
	                                    <img src="http://'.$_SERVER['HTTP_HOST'].'/assets/images/logotipo-sorvetesurca.png" alt="Sorvetes Urca">
	                                </td>
	                            </tr>
	                            <!-- Conteúdo -->
	                            <tr>
	                                <td>
	                                    <h1 style="color: #252525; font-size: 1.5em; line-height: 1.4em; font-family: sans-serif; font-weight: 300; margin: 0.5em 0 1em; padding: 0;">
	                                        '.$assunto.'
	                                    </h1>
	                                    <div style="color: #757575; font-size: 0.9em; line-height: 2em; font-family: sans-serif; margin: 0; padding: 0;">
	                                        '.$mensagem.'
	                                    </div>
	                                </td>
	                            </tr>
	                            <!-- Rodapé -->
	                            <tr>
	                                <td bgcolor="#fafafa" style="border-top: 1px solid #eee;">
	                                    <div style="color: #757575; font-size: 0.75em; line-height: 2em; font-family: sans-serif; margin: 0; padding: 0;">
	                                        <p style="margin: 0; padding: 0;">
	                                            <a style="color: '.$cor.'; text-decoration: none;" href="http://'.$_SERVER['HTTP_HOST'].'">
	                                                <strong>Enviado por Sorvetes Urca</strong>
	                                            </a>
	                                            <br>
	                                            Se tiver alguma dúvida ou sugestão entre em contato através do email '.$userinfo['email_contato'].'
	                                        </p>
	                                    </div>
	                                </td>
	                            </tr>
	                        </table>
	                        <!-- End: Wrapper -->
	                        <br>
	                    </td>
	                </tr>
	            </table>
	        </body>
	        </html>
	    ';

	    if($file != '') {
	    	$mail->addAttachment($file['tmp_name'], $file['name']);
		}

	    try {
	        //$mail->SMTPDebug  = 2;
	        $mail->SMTPAuth   = true;
	        if($userinfo['email_secure'] != '') {
	        	$mail->SMTPSecure = $userinfo['email_secure'];
	        }
	        $mail->Host       = $userinfo['email_host'];
	        $mail->Port       = $userinfo['email_port'];
	        $mail->Username   = $userinfo['email_user'];
	        $mail->Password   = $userinfo['email_password'];
	        $mail->SetFrom($userinfo['email_contato'], $userinfo['title']);
	        $mail->Sender     = $userinfo['email_contato'];
	        $mail->IsHTML(true);
	        $mail->CharSet = 'UTF-8';
	        $mail->AddAddress($para);
	        $mail->AddBCC('marcomborges@gmail.com');
	        $mail->Subject = $assunto;
	        $mail->Body = $xmsg;

	        $mail->Send();

	        $ret['classe'] = 'c-success';
	        $ret['mensagem'] = "Formulário enviado com sucesso.";
	        $ret['resultado'] = true;
	        unset($_POST);

	    } catch (phpmailerException $e) {

	        echo $e->errorMessage();
	        $ret['classe'] = 'c-error';
	        $ret['mensagem'] = "Não foi possível enviar sua mensagem.";
	        $ret['resultado'] = false;

	    } catch (Exception $e) {

	        echo $e->getMessage();
	        $ret['classe'] = 'c-error';
	        $ret['mensagem'] = "Não foi possível enviar sua mensagem.";
	        $ret['resultado'] = false;

	    }
	    return $ret;
	}

	// Status do registro
    function status($val){
        if(strtoupper($val) == 'S' || strtoupper($val) == 'SIM' || strtoupper($val) == 'Sim' || strtoupper($val) == '1' || strtoupper($val) == 'YES'){
            return '<span class="lbl c-success">Ativo</span>';
        } elseif(strtoupper($val) == 'P' || strtoupper($val) == '1'){
            return '<span class="lbl c-alert">Pendente</span>';
        } elseif(strtoupper($val) == 'N' || strtoupper($val) == 'NÃO' || strtoupper($val) == 'Não' || strtoupper($val) == '0' || strtoupper($val) == 'NO'){
            return '<span class="lbl c-error">Inativo</span>';
        }
    }

	// Verifica se está no painel
	function isPanel($pag) {
		$uri = explode('/', $pag);
		if($uri[0] == 'painel') {
			return true;
		} else {
			return false;
		}
	}

	// Verifica se está na página inicial
	function isHome($pag) {
		$uri = explode('/', $pag);
		if($uri[0] == 'home') {
			return true;
		} else {
			return false;
		}
	}

	// Verifica módulo atual
	function isMod($pag) {
		$uri = explode('/', $pag);
		$mod = explode('-', $uri[0]);

		return $mod[0];
	}

	// Imprimi requisições em formato de código
	function xprint($vars) {
		echo '<pre><code>';
		print_r($vars);
		echo '</code></pre>';
	}

	function formatbytes($file, $type) {
	   switch($type){
	      case "KB":
	         $filesize = filesize($file) * .0009765625; // bytes to KB
	      break;
	      case "MB":
	         $filesize = (filesize($file) * .0009765625) * .0009765625; // bytes to MB
	      break;
	      case "GB":
	         $filesize = ((filesize($file) * .0009765625) * .0009765625) * .0009765625; // bytes to GB
	      break;
	   }
	   if($filesize <= 0){
	      return $filesize = 'unknown file size';
	   } else {
	   		return round($filesize, 2).' '.$type;
	   }
	}

	// Verifica permissões
    function permission($pag, $user, $redir = '', $connection) {
        $rsp = mysqli_query($connection, "SELECT pr_usuario.modulos, pr_usuario.administrador FROM pr_usuario WHERE md5(pr_usuario.id) = '$user'");
        if($rsp && mysqli_num_rows($rsp) > 0) {
            $permissoes = mysqli_fetch_assoc($rsp);

			xprint($permissoes);

            if($permissoes['administrador'] != 'S') {
                if(strpos($permissoes['modulos'], $pag) !== false) {
                    return true;
                } else {
                    if(($pag != 'dashboard' && $pag != 'alterar') && $redir == 'yes') {
                        //echo '<script type="text/javascript">window.location="/dashboard?teste=1"</script>';
                    }

                    return false;
                }
            } else {
                return true;
            }

        } else {
			if($pag != 'dashboard' && $redir == 'yes') {
                //echo '<script type="text/javascript">window.location="/dashboard?teste=2"</script>';
            }

            return false;
        }
    }

	function readingTime($content) {
		$word = str_word_count(strip_tags($content));
		$m = floor($word / 200);
		$est = $m . ' minuto'.($m == 1 ? '' : 's').' de leitura';

		return $est;
	}

	function stringToColorCode($str) {
		$code = dechex(crc32($str));
		$code = substr($code, 0, 6);
		return $code;
	  }

	// Avatar Letter
	// Create Avatar Circle with Initial Letters
	function avatarLetter($name, $color = false) {
		$avatar = substr($name,0,1);

		$name = explode(' ', trim($name));
		if(count($name) > 1) {
			$avatar = substr(trim($name[0]),0,1).substr(end($name),0,1);
		}

		if($color != '') {
			$avatar = '<span class="avatar-circle" style="background-color: #'.stringToColorCode($color).';">'.$avatar.'</span>';
		}

		return $avatar;
	}

	// Short Name
	// Get First and Last Name
	function shortName($name) {
		$name = explode(' ', trim($name));
		return trim($name[0]).' '.end($name);
	}
?>
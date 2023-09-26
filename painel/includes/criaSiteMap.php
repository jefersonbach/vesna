<?
set_time_limit(99999);
ini_set('max_execution_time', 300);
ini_set('odbc.defaultlrl', 999999);
header("Content-type: text/xml");


 if($_GET['export'] == 'sim'){
$carr = $resulSeo->lista($_SESSION['pagina']);

$xml='<urlset>\n\t\t';
//foreach($carr as $lis){

    $xml .="<url>\n\t\t";
    $xml .= "<loc>http://www.cecanrs.com.br/</loc>\n\t\t";
    $xml .= "<changefreq>always</changefreq>\n\t\t";
    $xml .= "<priority>1.00</priority>\n\t\t";
	
	
    $xml.="</url>\n\t";
//}
$xml.="</urlset>\n\r";

$xmlobj=new SimpleXMLElement("<?xml version='1.0' encoding='utf-8' standalone='no'?>".$xml);
$xmlobj->asXML("sitemapa.xml");

}

?>
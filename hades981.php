<?php
  $page_title = 'Telegram';
  require_once('includes/load.php');
include_once('layouts/header.php');

$directorio=directorio();



$botToken = "1088204480:AAGPg0Ov4JR4b4YUgftzbYrDkg-2LYGfk50";
 
$website = "https://api.telegram.org/bot".$botToken;
 
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$modo = 0;
 
$chatId = $update["message"]["chat"]["id"];
$chatType = $update["message"]["chat"]["type"];
$userId = $update["message"]['from']['id'];
$firstname = $update["message"]['from']['username'];
if ($firstname=="") {
    $modo=1;
    $firstname = $update["message"]['from']['first_name'];
}
 
if ($modo == 0) {
    $firstname = "@".$firstname;
}
 
$message = $update["message"]["text"];
 
$agg = json_encode($update, JSON_PRETTY_PRINT);
 
 
 
 
//Extraemos el Comando
$arr = explode(' ',trim($message));
$command = $arr[0];
 
$message = substr(strstr($message," "), 1);
 
//No requieren variables del usuario.
switch ($command) {
    case '/ayuda':
        $response = "Tranquilo, estoy contigo.";
        sendMessage($chatId, $response);
        break;
    case '/ayuda2':
        $response = "Tranquilo, estoy contigo.";
        $keyboard = '["Gracias"],["Pos Ok"]';
        sendMessage($chatId, $response,$keyboard);
        break;
    case '/noticias':
        getNoticias($chatId);
        break;
    case '/participar': case '/participar@VazCell_bot':
        getSorteos($chatId, $message, $userId, $firstname, $agg);
        break;
    case '/youtube':
        sendMessage($chatId, "Mi canal de YouTube es <a href='https://www.youtube.com/channel/UCGArCE3vmQkFpu_o_6axt1g'>SrVazquez</a>");
    break;
		case '/correos':
		  correos_telegram($chatId);
		 break;
 
}
 
 
 
function sendMessage($chatId, $response, $keyboard = NULL){
    if (isset($keyboard)) {
        $teclado = '&reply_markup={"keyboard":['.$keyboard.'], "resize_keyboard":true, "one_time_keyboard":true}';
    }
    $url = $GLOBALS[website].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&text='.urlencode($response).$teclado;
    file_get_contents($url);
}
 
function getNoticias($chatId){
 
    //include("simple_html_dom.php");
 
    $context = stream_context_create(array('http' =>  array('header' => 'Accept: application/xml')));
    $url = "http://www.europapress.es/rss/rss.aspx";
 
    $xmlstring = file_get_contents($url, false, $context);
 
    $xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
    $json = json_encode($xml);
    $array = json_decode($json, TRUE);
 
    for ($i=0; $i < 9; $i++) {
        $titulos = $titulos."\n\n".$array['channel']['item'][$i]['title']."<a href='".$array['channel']['item'][$i]['link']."'> +info</a>";
    }
 
    sendMessage($chatId, $titulos);
 
 
 
}



function correos_telegram($chatId){
 
    //include("simple_html_dom.php");
 
   		
			 foreach ($directorio as  $direc):
 /*
    for ($i=0; $i < 9; $i++) {
        $titulos = $titulos."\n\n".$array['channel']['item'][$i]['title']."<a href='".$array['channel']['item'][$i]['link']."'> +info</a>";
    }*/
 $titulos=$direc["nombre"].$direc["email"];
    sendMessage($chatId, $titulos);
 
 endforeach;
 echo $titulos;
}








// Definimos la función cURL
/*   function curl($url) {
        $ch = curl_init($url); // Inicia sesión cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Configura cURL para devolver el resultado como cadena
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Configura cURL para que no verifique el peer del certificado dado que nuestra URL utiliza el protocolo HTTPS
        $info = curl_exec($ch); // Establece una sesión cURL y asigna la información a la variable $info
        curl_close($ch); // Cierra sesión cURL
        return $info; // Devuelve la información de la función
    }

    $sitioweb = curl("https://devcode.la");  // Ejecuta la función curl escrapeando el sitio web https://devcode.la and regresa el valor a la variable $sitioweb
    echo $sitioweb;*/





















/*$request = file_get_contents("php://input");

$date = date('Y-m-d H:i:s');

$content = "$date\n$request\n\n";

file_put_contents("webhook.log", $content, FILE_APPEND);

//if($request =='/fecha'){
function sendMessage($text) 
{
  $TOKEN = "1088204480:AAGPg0Ov4JR4b4YUgftzbYrDkg-2LYGfk50";
  $TELEGRAM = "https://api.telegram.org:443/bot$TOKEN"; 

  $query = http_build_query(array(
    'chat_id'=> "798478967",
    'text'=> $text,
    'parse_mode'=> "Markdown", // Optional: Markdown | HTML
  ));

  $response = file_get_contents("$TELEGRAM/sendMessage?$query");
  return $response;
}*/
//}






	//sendMessage($request);


/*
function mensage($msj){
	
	
	$queryArray=[
		'chat_id'=>CHAT_ID,
		'text'=>$msj,
	];
	$url='https://api.telegram.org/bot'.BOT_TOKEN.'/sendMessage?'.http_build_query($queryArray);
	//$result=file_get_contents($url);
} 
*/








/*$request = file_get_contents("php://input");

$date = date('Y-m-d H:i:s');

$content = "$date\n$request\n\n";

file_put_contents("webhook.log", $content, FILE_APPEND);


function sendMessage($chatId, $text) 
{
  $TOKEN = "1088204480:AAGPg0Ov4JR4b4YUgftzbYrDkg-2LYGfk50";
  $TELEGRAM = "https://api.telegram.org:443/bot$TOKEN"; 

  $query = http_build_query(array(
    'chat_id'=> $chatId,
    'text'=> $text,
    'parse_mode'=> "Markdown", // Optional: Markdown | HTML
  ));

  $response = file_get_contents("$TELEGRAM/sendMessage?$query");
  return $response;*/
//}
/*$text="texto de prueba";


function sendMessage($chatId, $text) 
{
  $TOKEN = "1088204480:AAGPg0Ov4JR4b4YUgftzbYrDkg-2LYGfk50";
  $TELEGRAM = "https://api.telegram.org:443/bot$TOKEN"; 

  $query = http_build_query(array(
    'chat_id'=> $chatId,
    'text'=> $text,
    'parse_mode'=> "Markdown", // Optional: Markdown | HTML
  ));

  $response = file_get_contents("$TELEGRAM/sendMessage?$query");
  return $response;
}



$json = file_get_contents("php://input");
$request = json_decode($json, $assoc=false);
$chatId = $request->message->chat->id;
$text = $request->message->text;
sendMessage($chatId, $text);
*/

/*$request = file_get_contents("php://input");

$date = date('Y-m-d H:i:s');

$content = "$date\n$request\n\n";

file_put_contents("webhook.log", $content, FILE_APPEND);
*/
/*
$TOKEN = "1088204480:AAGPg0Ov4JR4b4YUgftzbYrDkg-2LYGfk50";
$TELEGRAM = "https://api.telegram.org:443/bot$TOKEN"; 

if (checkToken()) 
{
  $request = receiveRequest();
  $chatId = $request->message->chat->id;
  $text = $request->message->text;
  sendMessage($chatId, $text);
}

function checkToken() 
{
  global $TOKEN;
  $pathInfo = ltrim($_SERVER['PATH_INFO'] ?? '', '/');
  return $pathInfo == $TOKEN;
}

function receiveRequest() 
{
  $json = file_get_contents("php://input");
  $request = json_decode($json, $assoc=false);
  return $request;
}

function sendMessage($chatId, $text) 
{
  global $TELEGRAM;	

  $query = http_build_query([
    'chat_id'=> $chatId,
    'text'=> $text,
    'parse_mode'=> "Markdown", 
  ]);

  $response = file_get_contents("$TELEGRAM/sendMessage?$query");
  return $response;
}
*/








/*https://api.telegram.org:443/bot<TOKEN>/setwebhook?url=<WEBHOOK>
$token = "1088204480:AAGPg0Ov4JR4b4YUgftzbYrDkg-2LYGfk50";
$id = "1088204480";
$urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
$msg = "Tu mensaje aqui";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlMsg);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
$server_output = curl_exec($ch);
curl_close($ch);

https://api.telegram.org:443/bot1088204480:AAGPg0Ov4JR4b4YUgftzbYrDkg-2LYGfk50/setwebhook?url=https://sci.envipaq.com.mx/login/hades981.php
*/
/*$TOKEN = "1088204480:AAGPg0Ov4JR4b4YUgftzbYrDkg-2LYGfk50";


define('BOT_TOKEN','1088204480:AAGPg0Ov4JR4b4YUgftzbYrDkg-2LYGfk50');
define('CHAT_ID','1088204480');
define('API_URL','https://api.telegram.org/bot'.BOT_TOKEN.'/');
	mensage("esto es una prueba");



function mensage($msj){
	
	
	$queryArray=[
		'chat_id'=>CHAT_ID,
		'text'=>$msj,
	];
	$url='https://api.telegram.org/bot'.BOT_TOKEN.'/sendMessage?'.http_build_query($queryArray);
	//$result=file_get_contents($url);
} */

  /*require_once('includes/load.php');
 include_once('layouts/header.php');

	
	echo "<br><br><br><br><br><br><br><br>".$_SESSION['ULTIMA_ACTIVIDAD']."<br><br>".MAX_SESSION_TIEMPO;
	


$_SESSION[ 'ULTIMA_ACTIVIDAD' ] = time();

    /*ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "fbi@fbi.com";
    $to = "hades981@outlook.com";
    $subject = "test de email";
    $message = "prueba de email con chronos";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);*/
    
	/*include_once('layouts/footer.php'); */
	?>



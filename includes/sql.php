<?php
  //require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* funcion para traer todo de la tabla que se pace como parametro
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}
/*--------------------------------------------------------------*/
/* funcion qe ejecuta la sentencia sql
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  retorna el id de la tabla que se pace como parametro
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* elimina por id de la tabla que se pace como parametro
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* contador  id por tabla que se pace como parametro
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* verifica que una tabla existe
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* logueo de usuarios
 
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,username,password,user_level,status FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
       if($user['status']==1){
		  
		  return $user['id'];
      }
	  }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* autenticacion de inicio, es una version que no se esta usando, era para el logueo de otros usuarios
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* establece la session
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* selecciona todos lo usuarios y el nivel de usuario
    /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.user_level ";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* guarda en bd la fecha de la ultima vez que ingreso al sistema cada usuario
  /*--------------------------------------------------------------*/
function updateLastLogIn($user_id){
   global $db;
	$date = make_date();
   $sql   = " INSERT INTO logueos (id_user, fecha) VALUES ('{$user_id}', '{$date}');";
    $result = $db->query($sql);
	 if($result && $db->affected_rows() === 1){
                 $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
               }	
    return ($result && $db->affected_rows() === 1 ? true : false);
 }


 

  /*--------------------------------------------------------------*/
  /* retorna el nombre de grupo, pero comprueba si el grupop esta dado de alta
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* comprueba el nivel de grupo si esta dado de alta
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }




/*--------------------------------------------------------------*/
  /* selecciona todos los usuarios que se encuentre en estatus 1 (activos en el sistema)
  /*--------------------------------------------------------------*/
function users_tareas(){
      global $db;
      $results = array();
      $sql = "SELECT * from users WHERE status=1";
      $result = find_by_sql($sql);
      return $result;
  }



  /*--------------------------------------------------------------*/
  /* comprueba si el usuario tiene los permisos para visializar la pagina 
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('index.php', false);
      //if Group status Deactive
     elseif($login_level['group_status'] === '0'):
           $session->msg('d','Este nivel de usuario esta inactivo!');
           redirect('home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('home.php', false);
        endif;

     }

 

/*--------------------------------------------------------------*/
  /* selecciona el valor maximo de la tabla odometro valor fecha
  /*--------------------------------------------------------------*/
function find_ultima_fecha($table)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT MAX(fecha_actualizacion) AS ultima_fecha FROM {$db->escape($table)} LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}


/*--------------------------------------------------------------*/
  /* selecciona la ultima fecha del odometro 
  /*--------------------------------------------------------------*/
function find_ultima_fecha_odometro($table)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT MAX(fecha) AS ultima_fecha_ingreso FROM {$db->escape($table)} LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}


/*--------------------------------------------------------------*/
  /* cuenta cuantos documentos han subido y faltan de validar
  /*--------------------------------------------------------------*/
function contador_documentos($table)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_documentos FROM contacto c WHERE (c.ganado_perdido = 3) AND(
        
            c.acta_constitutiva = 1 
         OR(
            c.sit_fiscar = 1 OR c.sit_fiscar = 0
        ) OR(
            c.cumplimiento = 1 OR c.cumplimiento = 0
        ) OR(
            c.identificacion = 1 OR c.identificacion = 0
        ) OR(
            c.comp_domicilio = 1 OR c.comp_domicilio = 0
        ) OR(
            c.estado_cuenta = 1 OR c.estado_cuenta = 0
        ) OR(
            c.preanalisis = 1 OR c.preanalisis = 0
        ) OR(
            c.preanalisis_excel = 1 OR c.preanalisis_excel = 0
        ) OR(
            c.presta_serv = 1 OR c.presta_serv = 0
        ) OR(
            c.alta_envi = 1 OR c.alta_envi = 0
        ) OR(
            c.tarifario = 1 OR c.tarifario = 0
        ) OR(
            c.alta_envi_excel = 1 OR c.alta_envi_excel = 0
        ) OR(
            c.propuesta = 1 OR c.propuesta = 0
        )
    )");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}



/*--------------------------------------------------------------*/
  /* hace un conteo de cuantos pendientes tenemos activos
  /*--------------------------------------------------------------*/
function contador_pendientes($table, $id_user)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_pendientes FROM tareas_p WHERE id_usuario='{$id_user}' && estatus=0");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}




	/*--------------------------------------------------------------*/
  /* hace un conteo de los clientes que se encuentrar bloqueados
  /*--------------------------------------------------------------*/
	function contador_bloqueados($table)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_bloqueados FROM clientes WHERE estatus !=0");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}





/*--------------------------------------------------------------*/
  /* hace un conteo de las cotizaciones que ha registrado el usuario 
  /*--------------------------------------------------------------*/
	function contador_mis_cotizaciones($table, $id_user)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_cotizacion FROM logistica_cot WHERE estatus =0  AND id_user='{$id_user}' ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}



	/*--------------------------------------------------------------*/
  /* hace un conteo de los tickets de las incidencias, que ha registrado en el sistema 
  /*--------------------------------------------------------------*/
	function contador_tickets_poruser($table, $id_user)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_tickets FROM ticket WHERE (estatus =0 OR estatus =2) AND id_quien_genera='{$id_user}' ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}


/*--------------------------------------------------------------*/
  /* hace un conteo de los tickets que estan pendientes de cerrar
  /*--------------------------------------------------------------*/
function contador_tickets_resueltos($table, $id_user)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_tickets FROM ticket WHERE estatus =1 AND id_quien_genera='{$id_user}' ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
  /* hace un conteo de las cotizaciones dadas de alta y las selecciona por usuario, de las que el cliente si acepto
  /*--------------------------------------------------------------*/
function contador_cotizaciones_mias_aceptadas($table, $id_user)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_aceptdas FROM logistica_cot WHERE estatus =1 AND id_user='{$id_user}' ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
  /* hace un conteo de las cotizaciones dadas de alta y las selecciona por usuario, de las que el cliente no acepto
  /*--------------------------------------------------------------*/
function contador_cotizaciones_mias_no_aceptadas($table, $id_user)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_no_aceptdas FROM logistica_cot WHERE estatus =2 AND id_user='{$id_user}' ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}


/*--------------------------------------------------------------*/
  /* hace un conteo de los tickets, que no se han resuelto ( 0 ) y de los que no tienen solucion por el momento ( 2 )
  /*--------------------------------------------------------------*/
function contador_tickets_todos($table)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_tickets FROM ticket WHERE (estatus =0 OR estatus =2) ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
  /* hace un conteo de las cotizaciones dadas de alta de todos los usuarios
  /*--------------------------------------------------------------*/
function contador_log_cotiza_todos($table)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_cotizaciones FROM logistica_cot WHERE estatus =0 ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}




/*--------------------------------------------------------------*/
  /* consulta todos los tickets con estatus 1 (resueltos)
  /*--------------------------------------------------------------*/
function contador_tickets_resueltos_todos($table)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_tickets FROM ticket WHERE estatus =1 ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}


/*--------------------------------------------------------------*/
  /* consulta todas las cotizaciones aceptadas (estatus=1 ) por los clientes
  /*--------------------------------------------------------------*/
function contador_aceptadas_todas($table)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_aceptadas_todas FROM logistica_cot WHERE estatus =1 ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
  /* consulta todas las cotizaciones no aceptadas (estatus=2 ) por los clientes
  /*--------------------------------------------------------------*/
function contador_no_aceptadas_todas($table)
{
  global $db;
	if(tableExists($table)){
          $sql = $db->query("SELECT COUNT(id) AS contador_no_aceptadas_todas FROM logistica_cot WHERE estatus =2 ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}





/*--------------------------------------------------------------*/
  /* consulta todos los usuarios con nivel 7 gte de ventas y nivel 9 ventas
  /*--------------------------------------------------------------*/
function find_all_vendedor() {
   global $db;
     return find_by_sql("SELECT u.id, u.name, u.username, u.user_level, COUNT(c.contacto) AS contacto FROM users u LEFT JOIN contacto c ON c.id_vendedor = u.id WHERE (u.user_level = '7' OR u.user_level = '9') AND status=1 GROUP BY u.id ORDER BY u.username ASC ");//
   
}

/*--------------------------------------------------------------*/
  /* consulta toda la informacion con id de la base de tickets
  /*--------------------------------------------------------------*/
function folio($id) {
   global $db;
     return find_by_sql("SELECT * FROM ticket WHERE id='{$id}' ");//
   
}

/*--------------------------------------------------------------*/
  /* consulta toda la informacion con id de la base de cotizacion
  /*--------------------------------------------------------------*/
function cotizacion($id) {
   global $db;
     return find_by_sql("SELECT * FROM logistica_cot WHERE id='{$id}' ");//
   
}



function tiempo_ingreso() {
   global $db;
     return find_by_sql("SELECT contacto,empresa, gana_per_fecha, fecha FROM contacto ORDER BY fecha ASC");//
   
}


/*--------------------------------------------------------------*/
  /* consulta las tareas pendientes por usuario
  /*--------------------------------------------------------------*/
function todolist($id) {
   global $db;
     return find_by_sql("SELECT t.id, t.nombre, t.descripcion, t.fecha_inicio, t.fecha_fin, t.id_proyecto, t.prioridad, t.estatus, t.id_usuario , t.de, u.name FROM tareas_p t LEFT JOIN users u ON t.de = u.id WHERE id_usuario='{$id}' && (estatus=1 OR estatus=0)");//
   
}

function todolist_despues($nombre, $fecha) {
   global $db;
     return find_by_sql("SELECT * FROM tareas_p WHERE nombre='{$nombre}' && fecha_inicio='{$fecha}'");//
   
}

/*--------------------------------------------------------------*/
  /* consulta las tareas pendientes despues de hacer una actualizacion de tarea pendiente realizada
  /*--------------------------------------------------------------*/
function todolist_despues_tachado($id) {
   global $db;
     return find_by_sql("SELECT * FROM tareas_p WHERE id='{$id}'");//
   
}

/*--------------------------------------------------------------*/
  /* consulta todas las altas de contactos dados de alta en el modulo de pipedrive
  /*--------------------------------------------------------------*/
function todas_altas() {
   global $db;
     return find_by_sql("SELECT * FROM contacto ORDER BY contacto ASC");//
   
}




/*--------------------------------------------------------------*/
  /* extrae la infomacion de contacto y de documentacion del contacto  que falta por validar
  /*--------------------------------------------------------------*/
function valida(){
   global $db;
   $sql   = " SELECT c.id, c.contacto, c.ganado_perdido,  c.id_vendedor, c.telefono, c.empresa, c.acta_constitutiva, c.rfc, c.sit_fiscar, c.cumplimiento, c.identificacion, c.comp_domicilio, c.estado_cuenta, c.tarifario, c.tarifario_excel, c.preanalisis, c.preanalisis_excel, c.presta_serv, c.alta_envi, c.alta_envi_excel, c.propuesta, c.fecha_acta, c.fecha_fiscal, c.fecha_cumplimiento, c.fecha_identificacion, c.fecha_comprobante, c.fecha_cuenta, c.fecha_preanalisis, c.fecha_presta_serv, c.fecha_alta_envi, c.fecha_propuesta, c.fecha_preanalisis_excel, c.fecha_alta_envi_excel, c.fecha_tarifario, c.fecha_tarifario_excel, c.user_biis, c.fecha_biis,  u.id AS users_id, u.name
   FROM contacto c 
   LEFT JOIN users u ON c.id_vendedor = u.id 
   WHERE (c.ganado_perdido = 3 OR c.ganado_perdido = 1) AND(
        
            (c.acta_constitutiva = 1 OR c.acta_constitutiva = 2 OR c.acta_constitutiva = 3) OR
            (c.sit_fiscar = 1 OR c.sit_fiscar = 2 OR c.sit_fiscar = 3) OR
            (c.identificacion = 1 OR c.identificacion = 2 OR c.identificacion = 3) OR
            (c.comp_domicilio = 1 OR c.comp_domicilio = 2 OR c.comp_domicilio = 3) OR 
            (c.estado_cuenta = 1 OR c.estado_cuenta = 2 OR c.estado_cuenta = 3) OR
             (c.presta_serv = 1 OR c.presta_serv = 2 OR c.presta_serv =3 ) OR 
            (c.alta_envi = 1 OR c.alta_envi = 2 OR c.alta_envi = 3) OR  
            (c.alta_envi_excel = 1 OR c.alta_envi_excel = 2 OR c.alta_envi_excel = 3) OR  
            (c.propuesta = 1 OR c.propuesta = 2 OR c.propuesta = 3) OR   
            (c.tarifario_excel = 1 OR c.tarifario_excel = 2 OR c.tarifario_excel = 3) OR
			(c.user_biis = 1 OR c.user_biis = 2 OR c.user_biis = 3)
    )
GROUP BY
    c.id";
	return find_by_sql($sql);
   
}

/*--------------------------------------------------------------*/
  /*consulta los clientes y la documentacion que esta correcta y esta es estatus de historico para consulta
  /*--------------------------------------------------------------*/
function valida_hist(){
   global $db;
   $sql   = " SELECT c.id, c.contacto, c.id_vendedor, c.ganado_perdido, c.telefono, c.empresa, c.tarifario_excel, c.acta_constitutiva, c.sit_fiscar, c.identificacion, c.comp_domicilio, c.estado_cuenta, c.presta_serv, c.alta_envi, c.alta_envi_excel, c.propuesta, u.id AS users_id, u.name FROM contacto c LEFT JOIN users u ON c.id_vendedor = u.id WHERE c.ganado_perdido = 4  AND ( c.sit_fiscar = 2 AND c.identificacion = 2 AND c.comp_domicilio = 2 AND c.estado_cuenta = 2 AND c.presta_serv = 2 AND c.alta_envi = 2 AND c.alta_envi_excel = 2 AND c.propuesta = 2 AND c.tarifario_excel = 2 AND( c.acta_constitutiva = 0 OR c.acta_constitutiva = 2 ) ) GROUP BY c.id";
	return find_by_sql($sql);
   
}




/*--------------------------------------------------------------*/
  /* consulta todo el catalogo de clienyes que se encuentran dados de alta
  /*--------------------------------------------------------------*/
function catalogo(){
   global $db;
   $sql   = " SELECT id, nombre from clientes";
	return find_by_sql($sql);
   
}

function operador_catalogo(){
   global $db;
   $sql   = " SELECT id, name, user_level from users WHERE user_level=3 ORDER BY name ASC";
	return find_by_sql($sql);
   
}


/*--------------------------------------------------------------*/
  /* seleccion las primeras 6 letras de las fechas registradas en los correos, los correos que se importan del whm para estadisticas
  /*--------------------------------------------------------------*/
function fechas_de_correos(){
   global $db;
   $sql   = " SELECT DISTINCT(LEFT(enviado_hora,6)) AS fecha FROM correos";
	return find_by_sql($sql);
   
}

/*--------------------------------------------------------------*/
  /*consulta la informacion detallada de un correo en especifico de envipaq
  /*--------------------------------------------------------------*/
function por_correos($correo){
   global $db;
   $sql   = " SELECT * FROM `correos` WHERE de='{$correo}' ORDER BY id DESC ";
	return find_by_sql($sql);
   
}




/*--------------------------------------------------------------*/
  /* muestra informacion de una cita cargada 
  /*--------------------------------------------------------------*/
function citas_id($id){
   global $db;
   $sql   = " SELECT c.id, c.contacto, c.telefono, c.domicilio, c.cp, c.delegacion, c.id_vendedor, c.empresa, ci.fecha_hora, ci.tiempo, ci.id_vendedor, ci.notas FROM contacto c LEFT JOIN citas ci ON c.id_vendedor = ci.id_vendedor WHERE c.id = ci.id_contacto AND ci.id= '{$id}' ";
	return find_by_sql($sql);
   
}

/*--------------------------------------------------------------*/
  /* extrae la informacion de contacto y direccion y nombre del vendedor que le esta dando seguimiento
  /*--------------------------------------------------------------*/
function documentos_users($id){
   global $db;
   $sql   = " SELECT c.id, c.contacto, c.telefono, c.domicilio, c.cp, c.delegacion, c.id_vendedor, c.empresa, u.name, u.id FROM contacto c
   LEFT JOIN users u ON u.id=c.id_vendedor ";//WHERE c.id = ci.id_contacto
	return find_by_sql($sql);
   
}





/*--------------------------------------------------------------*/
  /* selecciona toda la infromacion del  contacto por id
  /*--------------------------------------------------------------*/
function contactos_pdf($id){
   global $db;
   $sql   = " SELECT * from contacto WHERE id = '{$id}'";
	return find_by_sql($sql);
   
}

/*--------------------------------------------------------------*/
  /* consulta las acciones a realizar (llamadas, reuniones, envios de correo), por contacto pasado como parametro, 
  /*--------------------------------------------------------------*/
function acciones($id){
   global $db;
   $sql   = " SELECT c.id, c.id_contacto, c.fecha_hora, c.resumen, c.cerrada,  c.id_vendedor, c.fecha_alta, c.notas, co.fecha, c.tiempo, c.tipo, co.id, co.contacto, co.telefono, co.domicilio, co.id_vendedor from citas c 
   LEFT JOIN contacto co ON co.id = c.id_contacto WHERE c.id_contacto='{$id}' ORDER by c.fecha_hora DESC";
   
  
	return find_by_sql($sql);
   
}






	/*--------------------------------------------------------------*/
  /* muestra informacion de los  contactos y los agrupa por vendedor , pasado como parametro
  /*--------------------------------------------------------------*/
function contactos($id){
   global $db;
   $sql   = " SELECT c.id, c.contacto, c.telefono, c.domicilio, c.cp, c.delegacion, c.id_vendedor, c.empresa, c.ganado_perdido, ci.fecha_hora, ci.id_vendedor, ci.notas FROM contacto c LEFT JOIN citas ci ON c.id = ci.id_vendedor WHERE c.id = '{$id}' GROUP BY c.contacto";
	return find_by_sql($sql);
   
}

/*--------------------------------------------------------------*/
  /* consulta toda la informacion del contacto pasado por id 
  /*--------------------------------------------------------------*/
function todo_contactos($id){
   global $db;
   $sql   = " SELECT * FROM contacto WHERE id = '{$id}'";
	return find_by_sql($sql);
   
}
/*--------------------------------------------------------------*/
  /* muestra informacion de un archivo cargado lo busca por id
  /*--------------------------------------------------------------*/
function descarga($id){
   global $db;
   $sql   = " SELECT * FROM file WHERE id = '{$id}'";
	return find_by_sql($sql);
   
}

/*--------------------------------------------------------------*/
  /* muestra informacion de las ultimas citas que estan proximas y que no se encuentran en estus de cerradas y/o cumplidas. 
  /*--------------------------------------------------------------*/
function ultimas_citas($user){
   global $db;
   $sql   = " SELECT c.id AS id_cita, c.id_contacto, c.fecha_hora, c.fecha_cierre, c.resumen, c.notas, c.id_vendedor, c.tiempo, c.tiempo_fin, c.tipo, c.color, c.cerrada, co.id, co.contacto, co.telefono, co.empresa
   
   from citas c
   LEFT JOIN contacto co ON co.id=c.id_contacto
   WHERE c.id_vendedor = '{$user}' AND c.cerrada=0 ORDER BY c.fecha_hora ASC";
   
   /*c.id, ci.id AS id_cita, c.contacto, c.telefono, c.empresa, c.id_vendedor, ci.tiempo, ci.fecha_hora, ci.id_vendedor FROM contacto c LEFT JOIN citas ci ON c.id = ci.id_contacto WHERE ci.id_vendedor = '{$user}' AND tipo=1 AND cerrada=0 ORDER BY ci.fecha_hora ASC";*/
   return find_by_sql($sql);
   
   
   
   
   /*SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
   $sql  .= "m.file_name AS image FROM products p";
   $sql  .= " LEFT JOIN categories c ON c.id = p.categorie_id";
   $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);*/
 }


/*--------------------------------------------------------------*/
  /* muestra todas las citas proximas en un calendario,(c.tipo=1   <- son las citas tipo=2 <- son las llamadas tipo=3 <-son los correos) 
  /*--------------------------------------------------------------*/
function ultimas_citas_calendario_todas(){
   global $db;
   $sql   = "  SELECT c.id AS id_cita, c.id_contacto, c.fecha_hora, c.fecha_cierre, c.notas, c.id_vendedor, c.tiempo, c.tiempo_fin, c.color,   co.contacto, co.empresa, u.name
   from citas c
   LEFT JOIN contacto co ON co.id=c.id_contacto 
   LEFT JOIN users u ON u.id=c.id_vendedor WHERE c.tipo=1
   
    ";
   return find_by_sql($sql);
 }//WHERE MONTH(c.fecha_hora) =MONTH(NOW())-1    DATE(fecha_hora) = DATE(NOW())-1  c.id=553


/*--------------------------------------------------------------*/
  /* muestra informacion de las citas en un calendario y las agrupa en citas por vendedor
  /*--------------------------------------------------------------*/
function ultimas_citas_calendario($user){
   global $db;
   $sql   = " SELECT c.id AS id_cita, c.id_contacto, c.fecha_hora, c.fecha_cierre, c.notas, c.id_vendedor, c.tiempo, c.tiempo_fin, c.color,   co.contacto, co.empresa, c.tipo, c.resumen
   
   from citas c
   LEFT JOIN contacto co ON co.id=c.id_contacto

   WHERE c.id_vendedor = '{$user}' ";
   
   /*c.id, ci.id AS id_cita, c.contacto, c.telefono, c.empresa, c.id_vendedor, ci.tiempo, ci.fecha_hora, ci.id_vendedor FROM contacto c LEFT JOIN citas ci ON c.id = ci.id_contacto WHERE ci.id_vendedor = '{$user}' AND tipo=1 AND cerrada=0 ORDER BY ci.fecha_hora ASC";*/
   return find_by_sql($sql);
   
   
   
   
   /*SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
   $sql  .= "m.file_name AS image FROM products p";
   $sql  .= " LEFT JOIN categories c ON c.id = p.categorie_id";
   $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);*/
 }
/*--------------------------------------------------------------*/
  /* consulta la informacion de las guias de envipaq las consulta por id
  /*--------------------------------------------------------------*/
function guia_pdf($id){
   global $db;
   $sql   = " SELECT id,remitente, direccion, colonia, cp, nombre_destinatario, direccion_des, colonia_des, cp_des, telefono_des, correo, fecha, producto ";
 $sql  .= " FROM entrega";
 $sql  .= " WHERE id ='{$id}' LIMIT 1 ";
   return find_by_sql($sql);
 }

/*--------------------------------------------------------------*/
  /* consulta la informacion basica de contacto que se tenga relacionado con el id de vendedor
  /*--------------------------------------------------------------*/
function ultimos_contactos($user){
   global $db;
   $sql   = " SELECT id, empresa, domicilio, contacto FROM contacto WHERE id_vendedor='{$user}'";
   $sql  .= " ORDER BY id DESC ";
   return find_by_sql($sql);
 }
/*--------------------------------------------------------------*/
  /* consulta la informacion basica de contacto que se tenga relacionado con el id de vendedor pero esta muestra el nombre de vendor y muestra todos los contactos   
  /*--------------------------------------------------------------*/
function ultimos_contactos_todos(){
   global $db;
   $sql   = " SELECT c.id, c.empresa, c.domicilio, c.contacto, u.name FROM contacto c LEFT JOIN users u ON u.id=c.id_vendedor ORDER BY id DESC ";
   return find_by_sql($sql);
 }

/*--------------------------------------------------------------*/
  /* consulta los contactos marcados como ganados por vendedor, (ganados=1 <- ganados), (ganados=3 <- subiendo documentacion), (ganados=4 <- documentacion completa)
  /*--------------------------------------------------------------*/
function c_ganados($user){
   global $db;
   $sql   = " SELECT * FROM contacto WHERE id_vendedor='{$user}' AND (ganado_perdido=1 OR ganado_perdido=3 OR ganado_perdido=4)";
   $sql  .= " ORDER BY id DESC ";
   return find_by_sql($sql);
 }

/*--------------------------------------------------------------*/
  /* consulta los contactos marcados como ganados por todos los vendedores, (ganados=1 <- ganados), (ganados=3 <- subiendo documentacion), (ganados=4 <- documentacion completa)
  /*--------------------------------------------------------------*/
function c_ganados_todos(){
   global $db;
   $sql   = " SELECT * FROM contacto WHERE (ganado_perdido=1 OR ganado_perdido=3 OR ganado_perdido=4)";
   $sql  .= " ORDER BY id DESC ";
   return find_by_sql($sql);
 }

/*--------------------------------------------------------------*/
  /* consulta los contactos marcados como perdidos  (ganados=2 <- perdidos)
  /*--------------------------------------------------------------*/
function c_ganados_todos_perdido(){
   global $db;
   $sql   = " SELECT * FROM contacto WHERE ganado_perdido=2";
   $sql  .= " ORDER BY id DESC ";
   return find_by_sql($sql);
 }


/*--------------------------------------------------------------*/
  /* consulta el id maximo de cualquier tabla que se pase como parametro
  /*--------------------------------------------------------------*/
 function ultima($table){
   global $db;
     $sql= "SELECT MAX(id) FROM ".$db->escape($table);
      return find_by_sql($sql);
}


/*--------------------------------------------------------------*/
  /* modulo no utilizado,   consultaba las recolecciones que todavia no se encontraran asignadas, se reenplazo por biis
  /*--------------------------------------------------------------*/
function  recoleccion_diaria(){
  global $db;
  $sql  = "SELECT id, direccion, colonia, delegacion, cp, totalp, alto, ancho, largo, peso, nombre, id_empresa, fechaprogramar, fechasolicitud, notas, medida, id_operador, telefono, correo, alianza ,cp_des, paqueteria
  FROM recolecta WHERE asignado=0";
  //$sql  = "AND DATE(fechaprogramar) = DATE(NOW())";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
  /* modulo no utilizado,   consultaba las recolecciones que todavia no se encontraran asignadas, se reenplazo por biis
  /*--------------------------------------------------------------*/
function  asigna_entrega(){
  global $db;
  $sql  = "SELECT * FROM entrega WHERE asignado=0";
  //$sql  = "AND DATE(fechaprogramar) = DATE(NOW())";
  return find_by_sql($sql);
}





function  recoleccion_diaria_reporte(){
  global $db;
  $sql  = "SELECT r.id, r.direccion, r.numero, r.colonia, r.delegacion, r.cp, r.totalp, r.alto, r.ancho, r.largo, r.peso, r.nombre, r.id_empresa, r.fechaprogramar, r.fechasolicitud, r.notas, r.medida, r.id_operador, r.telefono, r.correo, r.alianza, r.cp_des, r.asignado, r.estatus, r.paqueteria, p.id_recolecta, p.quien_entrega, p.envipaq, p.fedex, p.estafeta, p.redpack, p.express, p.especial, p.notas AS notas_recoleccion, p.fecha AS fecha_queserecolecto, p.total AS total_recolectado, m.file_name, m.file_type, m.fecha, m.id_recoleccion
  FROM recolecta r 
  LEFT JOIN paqueteria p ON p.id_recolecta=r.id
  LEFT JOIN media m ON m.id_recoleccion=r.id
  ";
  $sql  .= " WHERE DATE(fechaprogramar) = DATE(NOW()) OR r.estatus=0";
  return find_by_sql($sql);
}


function directorio() {
   global $db;
     return find_by_sql("SELECT * FROM directorio ORDER BY extencion ASC ");//
   
}


function logistica_cot_agregados($id) {
   global $db;
     return find_by_sql("SELECT * FROM logistica_cot WHERE id_user='{$id}' AND estatus=0 ORDER BY fecha_creacion DESC ");//
   
}

function mias_no_aceptdas($id) {
   global $db;
     return find_by_sql("SELECT * FROM logistica_cot WHERE id_user='{$id}' AND estatus=2 ORDER BY fecha_creacion DESC ");//
   
}



function logistica_cot_todos() {
   global $db;
     return find_by_sql("SELECT l.id, l.cliente, l.tel, l.correo, l.servicio, l.empresa, l.tipo_mercancia, l.valor_mercancia, l.fraccion_arancelaria, l.id_user, l.fecha_creacion, l.aduana, l.bodega, l.tramite, l.aereo, l.terrestre, l.maritimo, u.name FROM logistica_cot l LEFT JOIN users u ON u.id=l.id_user WHERE estatus=0 ORDER BY l.fecha_creacion DESC");//
   
}





function sin_resolver($id) {
   global $db;
     return find_by_sql("SELECT * FROM ticket WHERE id_quien_genera='{$id}' AND estatus!=1 ORDER BY prioridad DESC ");//
   
}

function resueltos_user($id) {
   global $db;
     return find_by_sql("SELECT * FROM ticket WHERE id_quien_genera='{$id}' AND estatus=1 ");//
   
}
function logistica_cot_aceptadas($id) {
   global $db;
     return find_by_sql("SELECT * FROM logistica_cot WHERE id_user='{$id}' AND estatus=1 ");//
   
}

function sin_resolver_todos() {
   global $db;
     return find_by_sql("SELECT t.id, t.empresa, t.quien_reporta, t.correo, t.fecha_inicio, t.fecha_cierre, t.motivo, t.prioridad, t.n_deguia, t.estatus, t.id_quien_genera , t.paqueteria, t.folio_reporte, u.name FROM ticket t LEFT JOIN users u ON u.id=t.id_quien_genera WHERE estatus!=1 ORDER BY t.prioridad DESC ");//
   
}

function ticket_detalles($id) {
   global $db;
     return find_by_sql("SELECT t.id, t.empresa, t.quien_reporta, t.correo, t.fecha_inicio, t.fecha_cierre, t.motivo, t.prioridad, t.n_deguia, t.estatus, t.id_quien_genera, d.archivo, d.fecha_carga,  u.name, u.image, d.id AS id_detalles, d.detalles, d.id_user, d.id_ticket, d.fecha_entrada FROM ticket t LEFT JOIN ticket_detalles d ON d.id_ticket = t.id LEFT JOIN users u ON u.id = d.id_user WHERE t.id = '{$id}' ORDER BY d.fecha_entrada DESC ");//
   
}


function cot_detalles($id) {
   global $db;
     return find_by_sql("SELECT l.id, l.detalles, l.id_user, l.id_cot, l.fecha, l.archivo, u.name, u.image FROM logistica_cot_detalles l LEFT JOIN users u ON u.id = l.id_user WHERE l.id_cot = '{$id}' ORDER BY l.fecha DESC ");//
   
}

function detalles_final_tarifa($id) {
   global $db;
     return find_by_sql("SELECT l.fecha_fin, l.estatus, l.aduana, l.adu_compra, l.adu_venta, l.adu_proveedor, l.bodega, l.bod_compra, l.bod_venta, l.bod_proveedor, l.tramite, l.tra_venta, l.tra_compra, l.tra_proveedor, l.aereo, l.ae_compra, l.ae_venta, l.ae_proveedor, l.maritimo, l.ma_venta, l.ma_compra, l.ma_proveedor, l.terrestre, l.te_venta, l.te_compra, l.te_proveedor, u.name, u.image
     FROM logistica_cot l 
     LEFT JOIN users u ON u.id = l.id_user
     WHERE l.id= '{$id}' ");//
   
}


function resueltos_todos() {
   global $db;
     return find_by_sql("SELECT t.id, t.empresa, t.quien_reporta, t.correo, t.fecha_inicio, t.fecha_cierre, t.motivo, t.prioridad, t.n_deguia, t.estatus, t.id_quien_genera , t.paqueteria, t.folio_reporte, u.name FROM ticket t LEFT JOIN users u ON u.id=t.id_quien_genera WHERE estatus=1 ");//
   
}




function resueltos_todos_cotizacion() {
   global $db;
     return find_by_sql("SELECT l.id, l.cliente, l.tel, l.correo, l.servicio, l.empresa, l.tipo_mercancia, l.valor_mercancia, l.fraccion_arancelaria, l.id_user, l.fecha_creacion, l.aduana, l.bodega, l.tramite, l.aereo, l.terrestre, l.maritimo, u.name FROM logistica_cot l LEFT JOIN users u ON u.id=l.id_user WHERE estatus=1 ORDER BY l.fecha_creacion DESC ");//
   
}



function no_aceptados_todos_cotizacion() {
   global $db;
     return find_by_sql("SELECT l.id, l.cliente, l.tel, l.correo, l.servicio, l.empresa, l.tipo_mercancia, l.valor_mercancia, l.fraccion_arancelaria, l.id_user, l.fecha_creacion, l.aduana, l.bodega, l.tramite, l.aereo, l.terrestre, l.maritimo, u.name FROM logistica_cot l LEFT JOIN users u ON u.id=l.id_user WHERE estatus=2 ORDER BY l.fecha_creacion DESC ");//
   
}




function  incidencias(){
  global $db;
  $sql  = "SELECT * 
  FROM excel WHERE estatus=0";
 // $sql  .= " GROUP BY r.id_folio ORDER BY i.id_folio DESC";
  return find_by_sql($sql);
}
function  incidencias_historico(){
  global $db;
  $sql  = "SELECT * 
  FROM excel WHERE estatus=1 ORDER BY fecha_solucion ASC";
	
	
	
	
	//SELECT *  FROM excel WHERE estatus=1 AND MONTH(fecha_solucion) =MONTH(NOW())

	// $sql  .= " GROUP BY r.id_folio ORDER BY i.id_folio DESC";
  return find_by_sql($sql);
}




function  recoleccion_diaria_reporte_rango($fecha,$fecha2){//esta
  global $db;
  $sql  = "SELECT r.id, r.direccion, r.numero, r.colonia, r.delegacion, r.cp, r.totalp, r.alto, r.ancho, r.largo, r.peso, r.nombre, r.id_empresa, r.fechaprogramar, r.fechasolicitud, r.notas, r.medida, r.id_operador, r.telefono, r.correo, r.alianza, r.cp_des, r.asignado, r.estatus, r.paqueteria, p.id_recolecta, p.quien_entrega, p.envipaq, p.fedex, p.estafeta, p.redpack, p.express, p.especial, p.notas AS notas_recoleccion, p.fecha AS fecha_queserecolecto, p.total AS total_recolectado, m.file_name, m.file_type, m.fecha, m.id_recoleccion
  FROM recolecta r 
  LEFT JOIN paqueteria p ON p.id_recolecta=r.id
  LEFT JOIN media m ON m.id_recoleccion=r.id
  ";
  $sql  .= " WHERE r.fechasolicitud BETWEEN '{$fecha}' AND  '{$fecha2}'";
  return find_by_sql($sql);
}


	
	
function  recoleccion_diaria_reporte_busqueda($id){
  global $db;
  $sql  = "SELECT r.id, r.direccion, r.numero, r.colonia, r.delegacion, r.cp, r.totalp, r.alto, r.ancho, r.largo, r.peso, r.nombre, r.id_empresa, r.fechaprogramar, r.fechasolicitud, r.notas, r.medida, r.id_operador, r.telefono, r.correo, r.alianza, r.cp_des, r.asignado, r.estatus, r.paqueteria, p.id_recolecta, p.quien_entrega, p.envipaq, p.fedex, p.estafeta, p.redpack, p.express, p.especial, p.notas AS notas_recoleccion, p.fecha AS fecha_queserecolecto, p.total AS total_recolectado, m.file_name, m.file_type, m.fecha, m.id_recoleccion
  FROM recolecta r 
  LEFT JOIN paqueteria p ON p.id_recolecta=r.id
  LEFT JOIN media m ON m.id_recoleccion=r.id
  ";
  $sql  .= " WHERE r.id='{$id}'";
  return find_by_sql($sql);
}




function  llamadas(){
  global $db;
  $sql  = "SELECT COUNT(id) AS llamadas FROM citas WHERE MONTH(fecha_hora) =MONTH(NOW()) AND tipo=2";
    return find_by_sql($sql);
}

function  correos(){
  global $db;
  $sql  = "SELECT COUNT(id) AS correos FROM citas WHERE MONTH(fecha_hora) =MONTH(NOW()) AND tipo=3";
    return find_by_sql($sql);
}

function  reunion(){
  global $db;
  $sql  = "SELECT COUNT(id) AS reunion FROM citas WHERE MONTH(fecha_hora) =MONTH(NOW()) AND tipo=1";
    return find_by_sql($sql);
}


function  llamadas_user($user){
  global $db;
  $sql  = "SELECT COUNT(id) AS llamadas FROM citas WHERE MONTH(fecha_hora) =MONTH(NOW()) AND tipo=2 AND id_vendedor='{$user}'";
    return find_by_sql($sql);
}

function  correos_user($user){
  global $db;
  $sql  = "SELECT COUNT(id) AS correos FROM citas WHERE MONTH(fecha_hora) =MONTH(NOW()) AND tipo=3 AND id_vendedor='{$user}'";
    return find_by_sql($sql);
}

function  reunion_user($user){
  global $db;
  $sql  = "SELECT COUNT(id) AS reunion FROM citas WHERE MONTH(fecha_hora) =MONTH(NOW()) AND tipo=1 AND id_vendedor='{$user}'";
    return find_by_sql($sql);
}


function  llamadas_user_his($user){
  global $db;
  $sql  = "SELECT COUNT(id) AS llamadas FROM citas WHERE tipo=2 AND id_vendedor='{$user}'";
    return find_by_sql($sql);
}

function  correos_user_his($user){
  global $db;
  $sql  = "SELECT COUNT(id) AS correos FROM citas WHERE tipo=3 AND id_vendedor='{$user}'";
    return find_by_sql($sql);
}

function  reunion_user_his($user){
  global $db;
  $sql  = "SELECT COUNT(id) AS reunion FROM citas WHERE tipo=1 AND id_vendedor='{$user}'";
    return find_by_sql($sql);
}





















function  reporte_pdf(){
  global $db;
  $sql  = "SELECT * FROM entrega WHERE estatus=0 ORDER BY id DESC";
    return find_by_sql($sql);
}

function  ganados(){
  global $db;
  $sql  = "SELECT COUNT(ganado_perdido) AS ganado FROM contacto WHERE MONTH(fecha) =MONTH(NOW()) AND (ganado_perdido='1' OR ganado_perdido='3')";
    return find_by_sql($sql);
}
function  perdidos(){
  global $db;
  $sql  = "SELECT COUNT(ganado_perdido) AS perdido FROM contacto WHERE MONTH(fecha) =MONTH(NOW()) AND  ganado_perdido='2' ";
    return find_by_sql($sql);
}

function  ganados_meses(){
  global $db;
  $sql  = "SELECT COUNT(ganado_perdido) AS ganado, MONTH(fecha) AS fecha FROM contacto WHERE (ganado_perdido='1' OR ganado_perdido='3') GROUP BY MONTH(fecha) ";
    return find_by_sql($sql);
}
function  perdidos_meses(){
  global $db;
  $sql  = "SELECT COUNT(ganado_perdido) AS perdido, MONTH(fecha) AS fecha FROM contacto WHERE ganado_perdido='2'  GROUP BY MONTH(fecha) ";
    return find_by_sql($sql);
}

function  ganados_user_meses($user){
  global $db;
  $sql  = "SELECT COUNT(ganado_perdido) AS ganado, MONTH(fecha) AS fecha FROM contacto WHERE (ganado_perdido='1' OR ganado_perdido='3') AND id_vendedor='{$user}'";
    return find_by_sql($sql);
}
function  perdidos_user_meses($user){
  global $db;
  $sql  = "SELECT COUNT(ganado_perdido) AS perdido, MONTH(fecha) AS fecha FROM contacto WHERE ganado_perdido='2' AND id_vendedor='{$user}'";
    return find_by_sql($sql);
}





function  ganados_user($user){
  global $db;
  $sql  = "SELECT COUNT(ganado_perdido) AS ganado FROM contacto WHERE MONTH(fecha) =MONTH(NOW()) AND (ganado_perdido='1' OR ganado_perdido='3') AND id_vendedor='{$user}' ";
    return find_by_sql($sql);
}
function  perdidos_user($user){
  global $db;
  $sql  = "SELECT COUNT(ganado_perdido) AS perdido FROM contacto WHERE MONTH(fecha) =MONTH(NOW()) AND  ganado_perdido='2' AND id_vendedor='{$user}' ";
    return find_by_sql($sql);
}


function  dados_de_alta_user($user){
  global $db;
  $sql  = "SELECT COUNT(contacto) AS contacto, MONTH(fecha) AS fecha FROM contacto WHERE MONTH(fecha) =MONTH(NOW()) AND id_vendedor='{$user}'  ";//WHERE MONTH(fecha) =MONTH(NOW())
    return find_by_sql($sql);
}
	
	
	
	
function  dados_de_alta(){
  global $db;
  $sql  = "SELECT COUNT(contacto) AS contacto, MONTH(fecha) AS fecha FROM contacto WHERE MONTH(fecha) =MONTH(NOW())  ";//WHERE MONTH(fecha) =MONTH(NOW())
    return find_by_sql($sql);
}

function  dados_de_alta_meses(){
  global $db;
  $sql  = " SELECT COUNT(contacto) AS contacto, MONTH(fecha) AS fecha FROM contacto GROUP BY MONTH(fecha) ";//WHERE MONTH(fecha) =MONTH(NOW())
    return find_by_sql($sql);
}
function  dados_de_alta_user_meses($user){
  global $db;
  $sql  = " SELECT COUNT(contacto) AS contacto, MONTH(fecha) AS fecha FROM contacto WHERE id_vendedor='{$user}' GROUP BY MONTH(fecha) ORDER BY fecha DESC ";//WHERE MONTH(fecha) =MONTH(NOW())
    return find_by_sql($sql);
}

function  reporte_pdf_historico($quien_genera){
  global $db;
  $sql  = "SELECT e.id, e.guia, e.razon_social, e.remitente, e.direccion, e.colonia, e.cp, e.telefono, e.razonsocial_des, e.estatus, e.nombre_destinatario, e.direccion_des, e.colonia_des, e.cp_des, e.telefono_des, e.id_operador, e.fecha, e.correo, e.seguro, e.estatus, e.fecha_entrega, e.recibido, e.asignado, e.primera, e.primera_fecha, e.segunda, e.segunda_fecha, e.tercera, e.tercera_fecha, e.producto, e.notas_entrega, e.notas_entrega2, e.notas_entrega3, e.entrega_final, e.carga, e.puerto, e.despacho, e.compra, e.venta, e.quien_genera, e.detalles, e.comer_compra, e.comer_venta, e.arance_compra, e.arance_venta, e.servicios, e.almacen, e.palet, e.proveedor, e.uva_compra, e.uva_venta, c.id AS id_clientes, c.nombre FROM entrega e
  LEFT JOIN clientes c ON c.id=e.razon_social
  WHERE e.quien_genera='{$quien_genera}' ORDER BY e.id DESC";
    return find_by_sql($sql);
}






function  guias_asignacion_andres(){
  global $db;
  $sql  = "SELECT e.id, e.guia, e.razon_social, e.remitente, e.direccion, e.colonia, e.cp, e.telefono, e.razonsocial_des, e.estatus, e.nombre_destinatario, e.direccion_des, e.colonia_des, e.cp_des, e.telefono_des, e.id_operador, e.fecha, e.correo, e.seguro, e.estatus, e.fecha_entrega, e.recibido, e.asignado, e.primera, e.primera_fecha, e.segunda, e.segunda_fecha, e.tercera, e.tercera_fecha, e.producto, e.notas_entrega, e.notas_entrega2, e.notas_entrega3, e.entrega_final, e.carga, e.puerto, e.despacho, e.compra, e.venta, e.quien_genera, e.detalles, e.comer_compra, e.comer_venta, e.arance_compra, e.arance_venta, e.servicios, e.almacen, e.palet, e.proveedor, e.uva_compra, e.uva_venta, c.id AS id_clientes, c.nombre FROM entrega e
  LEFT JOIN clientes c ON c.id=e.razon_social WHERE e.estatus='0' ORDER BY e.id DESC";
    return find_by_sql($sql);
}
function  estatus_guias($id){
  global $db;
  $sql  = "SELECT e.id, e.guia, e.razon_social, e.remitente, e.direccion, e.colonia, e.cp, e.telefono, e.razonsocial_des, e.estatus, e.nombre_destinatario, e.direccion_des, e.colonia_des, e.cp_des, e.telefono_des, e.id_operador, e.fecha, e.correo, e.seguro, e.estatus, e.fecha_entrega, e.recibido, e.asignado, e.primera, e.primera_fecha, e.segunda, e.segunda_fecha, e.tercera, e.tercera_fecha, e.producto, e.notas_entrega, e.notas_entrega2, e.notas_entrega3, e.entrega_final, e.carga, e.puerto, e.despacho, e.compra, e.venta, e.quien_genera, e.detalles, e.comer_compra, e.comer_venta, e.arance_compra, e.arance_venta, e.servicios, e.almacen, e.fecha_cancelacion, e.en_ruta,  e.palet, e.proveedor, e.uva_compra, e.uva_venta, e.fecha_asignacion, c.id AS id_clientes, c.nombre, m.quien_recibe AS quien_recibe_bien, m.fecha AS fecha_entrega_bien, m.file_name FROM entrega e LEFT JOIN clientes c ON c.id=e.razon_social LEFT JOIN media m ON m.id_entrega=e.id WHERE e.id='{$id}' GROUP BY e.id";
    return find_by_sql($sql);
}


function  reporte_guias_todas(){
  global $db;
  $sql  = "SELECT e.id, e.guia, e.razon_social, e.remitente, e.direccion, e.colonia, e.cp, e.telefono, e.razonsocial_des, e.estatus, e.nombre_destinatario, e.direccion_des, e.colonia_des, e.cp_des, e.telefono_des, e.id_operador, e.fecha, e.correo, e.seguro, e.estatus, e.fecha_entrega, e.recibido, e.asignado, e.primera, e.primera_fecha, e.segunda, e.segunda_fecha, e.tercera, e.tercera_fecha, e.producto, e.notas_entrega, e.notas_entrega2, e.notas_entrega3, e.entrega_final, e.carga, e.puerto, e.despacho, e.compra, e.venta, e.quien_genera, e.detalles, e.comer_compra, e.comer_venta, e.arance_compra, e.arance_venta, e.servicios, e.almacen, e.palet, e.proveedor, e.uva_compra, e.uva_venta, c.id AS id_clientes, c.nombre FROM entrega e
  LEFT JOIN clientes c ON c.id=e.razon_social
  WHERE (e.estatus=1 OR e.estatus=55) ORDER BY e.id DESC";
    return find_by_sql($sql);
}



function  guia_historico(){
  global $db;
  $sql  = "SELECT e.id, e.guia, e.razon_social, e.remitente, e.direccion, e.colonia, e.cp, e.telefono, e.razonsocial_des, e.estatus, e.nombre_destinatario, e.direccion_des, e.colonia_des, e.cp_des, e.telefono_des, e.id_operador, e.fecha, e.correo, e.seguro, e.estatus, e.fecha_entrega, e.recibido, e.asignado, e.primera, e.primera_fecha, e.segunda, e.segunda_fecha, e.tercera, e.tercera_fecha, e.producto, e.notas_entrega, e.notas_entrega2, e.notas_entrega3, e.entrega_final, e.carga, e.puerto, e.despacho, e.compra, e.venta, e.quien_genera, e.detalles, e.comer_compra, e.comer_venta, e.arance_compra, e.arance_venta, e.servicios, e.almacen, e.palet, e.proveedor, e.uva_compra, e.uva_venta, e.precio, c.id AS id_clientes, c.nombre FROM entrega e
  LEFT JOIN clientes c ON c.id=e.razon_social
  WHERE (e.estatus=50 OR e.estatus=99) ORDER BY e.fecha_factura DESC";
    return find_by_sql($sql);
}




function  t_proyectos($id_usuario){
  global $db;
  $sql  = "SELECT t.id AS id_tarea, t.nombre  AS tarea_nombre, t.descripcion, t.fecha_inicio, t.fecha_fin, t.id_proyecto, t.prioridad, t.estatus, t.id_usuario, p.id, p.nombre, p.descripcion, p.id_user, p.fecha FROM tareas_p t LEFT JOIN t_proyecto p ON p.id = t.id_proyecto WHERE id_user ='{$id_usuario}'";
    return find_by_sql($sql);
}







function  entregas_reporte(){
  global $db;
  $sql  = "SELECT r.id, r.guia, r.razon_social, r.remitente, r.direccion, r.colonia, r.cp, r.telefono, r.razonsocial_des, r.nombre_destinatario, r.direccion_des, r.colonia_des, r.cp_des, r.telefono_des, r.id_operador, r.fecha, r.correo, r.seguro, r.estatus, r.fecha_entrega, r.recibido
  , r.asignado, r.primera, r.primera_fecha, r.segunda, r.segunda_fecha, r.tercera, r.tercera_fecha, r.producto, r.notas_entrega,  m.file_name, m.file_type, m.fecha, m.id_entrega
  FROM entrega r 
    LEFT JOIN media m ON m.id_entrega=r.id
  ";
    return find_by_sql($sql);
}


function  entregas_reporte_busqueda($id){
  global $db;
  $sql  = "SELECT r.id, r.guia, r.razon_social, r.remitente, r.direccion, r.colonia, r.cp, r.telefono, r.razonsocial_des, r.nombre_destinatario, r.direccion_des, r.colonia_des, r.cp_des, r.telefono_des, r.id_operador, r.fecha, r.correo, r.seguro, r.estatus, r.fecha_entrega, r.recibido
  , r.asignado, r.primera, r.primera_fecha, r.segunda, r.segunda_fecha, r.tercera, r.tercera_fecha, r.producto, r.notas_entrega,  m.file_name, m.file_type, m.fecha, m.id_entrega
  FROM entrega r 
    LEFT JOIN media m ON m.id_entrega=r.id WHERE r.id='{$id}' LIMIT 1
  ";
    return find_by_sql($sql);
}



function  clientes_envi_bloq(){
  global $db;
  $sql  = "SELECT * FROM clientes WHERE estatus !=0";
    return find_by_sql($sql);
}

function  clientes_envi(){
  global $db;
  $sql  = "SELECT * FROM clientes WHERE estatus =0";
    return find_by_sql($sql);
}
	
	
	
function  entrega_rango_fecha($fecha,$fecha2){
  global $db;
  $sql  = "SELECT r.id, r.guia, r.razon_social, r.remitente, r.direccion, r.colonia, r.cp, r.telefono, r.razonsocial_des, r.nombre_destinatario, r.direccion_des, r.colonia_des, r.cp_des, r.telefono_des, r.id_operador, r.fecha, r.correo, r.seguro, r.estatus, r.fecha_entrega, r.recibido
  , r.asignado, r.primera, r.primera_fecha, r.segunda, r.segunda_fecha, r.tercera, r.tercera_fecha, r.producto, r.notas_entrega,  m.file_name, m.file_type, m.fecha, m.id_entrega
  FROM entrega r 
    LEFT JOIN media m ON m.id_entrega=r.id WHERE r.fecha BETWEEN '{$fecha}' AND  '{$fecha2}'
  ";
    return find_by_sql($sql);
}



function  recoleccion_diaria_odometro($ruta){
  global $db;
  $sql  = "SELECT
    *
FROM
    recolecta,
    odometro
WHERE
    odometro.id_ruta = '{$ruta}' AND recolecta.id=odometro.id_recoleccion AND DATE(fechaprogramar) = DATE(NOW())
ORDER BY
    odometro.fecha
ASC";
  return find_by_sql($sql);
}



function  odometro_fecha($ruta,$fecha){
  global $db;
  $sql  = "SELECT
    *
FROM
     odometro
WHERE
    placas= '{$ruta}' AND DATE(fecha) = '{$fecha}'
";
  return find_by_sql($sql);
}//




function  odometro_total_fecha($ruta,$fecha){
  global $db;
  $sql  = "SELECT MAX(odometro) - MIN(odometro) AS total_odometro FROM odometro WHERE DATE(fecha) = '{$fecha}' AND id_ruta='{$ruta}'";

	    $result = $db->query($sql);
     return($db->fetch_assoc($result));

	//return find_by_sql($sql);
}







function  odometro_fecha_rango($ruta,$fecha,$fecha2){
  global $db;
  $sql  = "SELECT
    *
FROM
    
    odometro
WHERE
    placas = '{$ruta}' AND fecha BETWEEN '{$fecha}' AND '{$fecha2}' ORDER BY
    fecha
ASC";
  return find_by_sql($sql);
}


function  odometro_total_fecha_rango($ruta,$fecha,$fecha2){
  global $db;
  $sql  = "SELECT MAX(odometro) - MIN(odometro) AS total_odometro FROM odometro WHERE fecha BETWEEN '{$fecha}' AND  '{$fecha2}' AND id_ruta='{$ruta}'";

	    $result = $db->query($sql);
     return($db->fetch_assoc($result));

	//return find_by_sql($sql);
}




function  folders($user_id){
  global $db;
  $sql  = "SELECT * FROM file WHERE is_folder='1' AND user_id='{$user_id}'";
  return find_by_sql($sql);
}


function  correo(){
  global $db;
  $sql  = "SELECT * FROM users where email!='0'";
  return find_by_sql($sql);
}


function  listar_archivos($user_id){
  global $db;
  $sql  = "select * from file where user_id='{$user_id}' and folder_id is NULL order by filename asc";
  return find_by_sql($sql);
}

function  papelera($user_id){
  global $db;
  $sql  = "select * from file where user_id='{$user_id}' and estatus=1 order by filename asc";
  return find_by_sql($sql);
}




function  recoleccion_diaria_odometro_ayer($ruta){
  global $db;
  $sql  = "SELECT
    *
FROM
    recolecta,
    odometro
WHERE
    odometro.id_ruta = '{$ruta}' AND recolecta.id=odometro.id_recoleccion AND DATE(fechaprogramar) = DATE(NOW())-1
ORDER BY
    odometro.fecha
ASC";
  return find_by_sql($sql);
}

function  odometro_total($ruta){
  global $db;
  $sql  = "SELECT MAX(odometro) - MIN(odometro) AS total_odometro FROM odometro WHERE DATE(fecha) = DATE(NOW())-1 AND id_ruta='{$ruta}'";

	    $result = $db->query($sql);
     return($db->fetch_assoc($result));

	//return find_by_sql($sql);
}

function  odometro_total_hoy($ruta){
  global $db;
  $sql  = "SELECT * FROM `odometro` WHERE `fecha`=(SELECT MAX(fecha) FROM odometro  WHERE importe_total IS NOT NULL and placas='{$ruta}') ";

	    $result = $db->query($sql);
     return($db->fetch_assoc($result));

	//return find_by_sql($sql); 
}
/*

//funcion original del odometro
function  odometro_total_hoy($ruta){
  global $db;
  $sql  = "SELECT MAX(odometro) - MIN(odometro) AS total_odometro, fecha_carga, importe_total FROM odometro WHERE placas = '{$ruta}' AND DATE(NOW()) AND DATE(NOW()-1)"  ;

	    $result = $db->query($sql);
     return($db->fetch_assoc($result));

	//return find_by_sql($sql);
}*/

function  odometro_ultimo($ruta){
  global $db;
  $sql  = "SELECT MAX(odometro) AS ultimo FROM odometro WHERE placas='{$ruta}'";

	    $result = $db->query($sql);
     return($db->fetch_assoc($result));

	//return find_by_sql($sql);
}

function  comprueba(){
  global $db;
  $sql  = "SELECT * FROM entrega";

	    $result = $db->query($sql);
     return($db->fetch_assoc($result));

	//return find_by_sql($sql);
}



function  suma_combustible($ruta){
  global $db;
  $sql  = "SELECT SUM(importe_total) AS sumatoria FROM odometro WHERE MONTH(fecha) = MONTH(NOW()) AND placas = '{$ruta}'";

	    $result = $db->query($sql);
     return($db->fetch_assoc($result));

	//return find_by_sql($sql);
}

/*function count_by_id_fecha($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table)." WHERE DATE(fechaprogramar) = DATE(NOW())";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}*/





function  operador($id){
  global $db;
  $sql  = "SELECT r.id AS id_reco, r.direccion, r.numero, r.colonia, r.delegacion, r.cp, r.totalp, r.alto, r.ancho, r.largo, r.peso, r.nombre, r.id_empresa, r.fechaprogramar, r.fechasolicitud, r.notas, r.medida, r.id_operador, r.telefono, r.correo, r.alianza, r.numero_des, r.colonia_des, r.delegacion_des, r.cp_des, r.nombre_des, r.telefono_des, r.asignado, r.estatus, r.paqueteria, u.id,u.name
  FROM recolecta r";
   $sql  .= " LEFT JOIN users u ON r.id_operador=u.id";
  $sql  .= " WHERE r.id_operador='{$id}' AND r.estatus=0  AND DATE(fechaprogramar) = DATE(NOW())";
     return find_by_sql($sql);
}///r.id_operador=u.id='{$id}' && 



function  operador_entrega($id){
  global $db;
  $sql  = "SELECT r.id AS id_entrega, r.direccion_des,r.guia,r.razon_social, c.nombre, r.remitente,r.direccion, r.colonia, r.cp, r.telefono, r.razonsocial_des, r.nombre_destinatario, r.colonia_des, r.cp_des, r.primera, r.segunda, r.tercera,  r.telefono_des, r.id_operador, r.correo, r.asignado, u.id,u.name, r.estatus
  FROM entrega r";
   $sql  .= " LEFT JOIN users u ON r.id_operador=u.id
   LEFT JOIN clientes c ON c.id=r.razon_social";
  $sql  .= " WHERE r.id_operador='{$id}' AND r.estatus=2";
     return find_by_sql($sql);
}



function  operador_entrega_muestra($id){
  global $db;
  $sql  = "SELECT r.id AS id_entrega, r.direccion_des, r.razonsocial_des, r.nombre_destinatario, r.colonia_des, r.cp_des, r.telefono_des, r.id_operador, r.correo, r.asignado, u.id,u.name, r.estatus , r.primera, r.segunda, r.tercera
  FROM entrega r";
   $sql  .= " LEFT JOIN users u ON r.id_operador=u.id";
  $sql  .= " WHERE r.id_operador='{$id}' AND r.estatus=0";
     $result = $db->query($sql);
     return($db->fetch_assoc($result));
}




function  consulta_operador_alianza($id){
  global $db;
  $sql  = "SELECT r.id AS id_reco, r.direccion, r.numero, r.colonia, r.delegacion, r.cp, r.totalp, r.alto, r.ancho, r.largo, r.peso, r.nombre, r.id_empresa, r.fechaprogramar, r.fechasolicitud, r.notas, r.medida, r.id_operador, r.telefono, r.correo, r.alianza, r.numero_des, r.colonia_des, r.delegacion_des, r.cp_des, r.nombre_des, r.telefono_des, r.asignado, r.estatus, r.paqueteria, u.id,u.name  
  FROM recolecta r";
  $sql  .= " LEFT JOIN users u ON r.id_operador=u.id";
  $sql  .= " WHERE r.id_operador='{$id}' AND r.alianza!='NULL' AND r.estatus=0";
     return find_by_sql($sql);
}
//r.alianza='NULL' &  & DATE(fechaprogramar) = DATE(NOW())


function  operador_alianza($id){
  global $db;
  $sql  = "SELECT r.id AS id_reco, r.direccion, r.numero, r.colonia, r.delegacion, r.cp, r.totalp, r.alto, r.ancho, r.largo, r.peso, r.nombre, r.id_empresa, r.fechaprogramar, r.fechasolicitud, r.notas, r.medida, r.id_operador, r.telefono, r.correo, r.alianza, r.numero_des, r.colonia_des, r.delegacion_des, r.cp_des, r.nombre_des, r.telefono_des, r.asignado, r.estatus, r.paqueteria, u.id,u.name  
  FROM recolecta r";
  $sql  .= " LEFT JOIN users u ON r.id_operador=u.id";
  $sql  .= " WHERE r.id_operador='{$id}' AND r.alianza='NULL'";
     return find_by_sql($sql);
}




function count_by_id_fecha($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table)." WHERE DATE(fechaprogramar) = DATE(NOW())";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}


function count_by_id_por_recolectar($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table)." WHERE asignado=1 AND estatus =0";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function count_by_id_recolectado($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table)." WHERE asignado=1 AND estatus =1";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}


function count_by_id_recolectado_mes($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table)." WHERE MONTH(fechaprogramar) = MONTH(NOW()) AND asignado=1 AND estatus =1";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}


function count_by_id_recolectado_mes_falta($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table)." WHERE MONTH(fechaprogramar) = MONTH(NOW()) AND estatus=0";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}




function count_by_id_fedex($table){
   global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT SUM(fedex) AS total FROM ".$db->escape($table)." WHERE MONTH(fecha) = MONTH(NOW())";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}



function count_by_id_estafeta($table){
   global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT SUM(estafeta) AS total FROM ".$db->escape($table)." WHERE MONTH(fecha) = MONTH(NOW())";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}



function count_by_id_redpack($table){
   global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT SUM(redpack) AS total FROM ".$db->escape($table)." WHERE MONTH(fecha) = MONTH(NOW())";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}


function count_by_id_envipaq($table){
   global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT SUM(envipaq) AS total FROM ".$db->escape($table)." WHERE MONTH(fecha) = MONTH(NOW())";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function count_by_id_expres($table){
   global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT SUM(express) AS total FROM ".$db->escape($table)." WHERE MONTH(fecha) = MONTH(NOW())";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function count_by_id_especial($table){
   global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT SUM(especial) AS total FROM ".$db->escape($table)." WHERE MONTH(fecha) = MONTH(NOW())";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}




function odometro($id_operador){
  global $db;
  if(tableExists($id_operador))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($id_operador)." WHERE MONTH(fechaprogramar) = MONTH(NOW()) AND estatus=0";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

/*--------------------------------------------------------------*/
/* contador  id por tabla que se pace como parametro
/*--------------------------------------------------------------*/

function id_memo($p_quien_genera){
  global $db;
 
    $sql = $db->query("SELECT MAX(id) AS id FROM memo WHERE id_quien_genera='{$p_quien_genera}'");
    if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     
  }

/*--------------------------------------------------------------*/
/* consulta los usuarios dados de alta y que ademas esten activos en el mismo
/*--------------------------------------------------------------*/

function  users_activos(){
  global $db;
  $sql  = 'SELECT id, name, email FROM users WHERE status="1" AND id!="2" AND id!="1" AND id!="32" AND id!="34" AND id!="43" AND id!="59" AND id!="62" AND id!="64" AND id!="65"';
     return find_by_sql($sql);
}


/*--------------------------------------------------------------*/
/* extrae los correos de los usuarios a los que va dirigido
/*--------------------------------------------------------------*/
function  envia_notificacion_memo(){
  global $db;
  $sql  = "SELECT u.email, m.id AS id_memo FROM users u LEFT JOIN memo_compartido m ON u.id=m.id_quien_lo_ve WHERE enviado_notf='0'";
     return find_by_sql($sql); //SELECT u.email, m.id AS id_memo FROM users u LEFT JOIN memo_compartido m ON u.id=m.id_quien_lo_ve WHERE enviado_notf='0'  //selector anterior
}


/*--------------------------------------------------------------*/
/* extrae los correos de los usuarios a los que va dirigida la copia de memo
/*--------------------------------------------------------------*/
function  envia_notificacion_memocc(){
  global $db;
  $sql  = "SELECT u.email, m.id AS id_memo FROM users u LEFT JOIN memo_copia m ON u.id=m.id_quien_lo_ve WHERE enviado_notf='0'";
     return find_by_sql($sql); //SELECT u.email, m.id AS id_memo FROM users u LEFT JOIN memo_compartido m ON u.id=m.id_quien_lo_ve WHERE enviado_notf='0'  //selector anterior
}


/*--------------------------------------------------------------*/
  /* consulta y genera pdf del memo pasado por id
  /*--------------------------------------------------------------*/
function consulta_memo($id){
   global $db;
   $sql   = " SELECT m.id, m.asunto, m.contenido, m.fecha, u.name, u.puesto FROM memo m LEFT JOIN users u ON u.id=m.id_quien_genera 
WHERE m.id='{$id}' LIMIT 1";
 
   return find_by_sql($sql);
 }

/*--------------------------------------------------------------*/
  /* consulta y genera pdf del memo pasado por id
  /*--------------------------------------------------------------*/
function mis_memos_creados($id_user){
   global $db;
   $sql   = " SELECT m.id, m.asunto, m.fecha, u.name, u.puesto, u.image, SUBSTRING(m.contenido, 1, 100) AS resumen FROM memo m LEFT JOIN users u ON u.id=m.id_quien_genera WHERE u.id='{$id_user}' ORDER BY m.fecha DESC ";
	return find_by_sql($sql);
   
}

/*--------------------------------------------------------------*/
  /* selecciona a todos los usuarios a los que se les mando el memo
  /*--------------------------------------------------------------*/
function mis_memos_enviados($id_memo){
   global $db;
   $sql   = " SELECT m.fecha_visto, u.name, u.image AS imagen FROM memo_compartido m LEFT JOIN users u ON u.id=m.id_quien_lo_ve WHERE m.enviado_notf='1' AND id_memo='{$id_memo}'";
	return find_by_sql($sql);
   
}





/*--------------------------------------------------------------*/
  /* selecciona todos lo memos enviados a un usuario
  /*--------------------------------------------------------------*/
function memos_por_usuario($id_user){
   global $db;
   $sql   = " SELECT m.asunto, SUBSTRING(m.contenido, 1, 100) AS resumen, md.fecha_enviado, md.fecha_visto,  m.id AS id_de_memo FROM memo_compartido md LEFT JOIN users u ON u.id=md.id_quien_lo_ve LEFT JOIN memo m ON m.id=md.id_memo WHERE u.id='{$id_user}'";
	return find_by_sql($sql);
   
}	
	
/*--------------------------------------------------------------*/
/* selecciona el nombre usuarios para los que va dirigido el memo
/*--------------------------------------------------------------*/
function selecciona_nombre_user($id){
   global $db;
   $sql   = "SELECT GROUP_CONCAT(u.name SEPARATOR  ', ') AS nombre FROM memo_compartido m LEFT JOIN users u ON u.id=m.id_quien_lo_ve WHERE m.enviado_notf='1' AND id_memo='{$id}' ORDER BY nombre ASC";
	return find_by_sql($sql);// SELECT u.name FROM memo_compartido m LEFT JOIN users u ON u.id=m.id_quien_lo_ve WHERE m.enviado_notf='1' AND id_memo='{$id}'  //version anterior de la consulta
   
}


/*--------------------------------------------------------------*/
/* selecciona el nombre usuarios para los que van en copia del memo
/*--------------------------------------------------------------*/
function selecciona_nombre_usercc($id){
   global $db;
   $sql   = "SELECT GROUP_CONCAT(u.name SEPARATOR  ', ') AS nombre FROM memo_copia m LEFT JOIN users u ON u.id=m.id_quien_lo_ve WHERE m.enviado_notf='1' AND id_memo='{$id}' ORDER BY nombre ASC";
	return find_by_sql($sql);// SELECT u.name FROM memo_compartido m LEFT JOIN users u ON u.id=m.id_quien_lo_ve WHERE m.enviado_notf='1' AND id_memo='{$id}'  //version anterior de la consulta
   
}




function  encuesta(){
  global $db;
  $sql  = "SELECT id, correo FROM correos_clientes WHERE enviado='0'";
     return find_by_sql($sql);
}




?>

<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
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
/* Function for Delete data from table by id
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
/* Function for Count id  By table name
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
/* Determine if database table exists
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
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
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
  /* Find current log in user by session id
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
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
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
   /* Function for Finding all product name
   /* JOIN with categorie  and media database table
   /*--------------------------------------------------------------*/
  function join_product_table(){
     global $db;
     $sql  =" SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.media_id,p.date,c.name";
    $sql  .=" AS categorie,m.file_name AS image";
    $sql  .=" FROM products p";
    $sql  .=" LEFT JOIN categories c ON c.id = p.categorie_id";
    $sql  .=" LEFT JOIN media m ON m.id = p.media_id";
    $sql  .=" ORDER BY p.id ASC";
    return find_by_sql($sql);

   }
  /*--------------------------------------------------------------*/
  /* Function for Finding all product name
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/

   function find_product_by_title($product_name){
     global $db;
     $p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT nombre FROM marca WHERE name like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

  /*--------------------------------------------------------------*/
  /* Function for Finding all product info by product title
  /* Request coming from ajax.php
  /*--------------------------------------------------------------*/
  function find_all_product_info_by_title($title){
    global $db;
    $sql  = "SELECT * FROM marca ";
    $sql .= " WHERE name ='{$title}'";
    $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }

  /*--------------------------------------------------------------*/
  /* Function for Update product quantity
  /*--------------------------------------------------------------*/
  function update_product_qty($qty,$p_id){
    global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $sql = "UPDATE products SET quantity=quantity -'{$qty}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }
  /*--------------------------------------------------------------*/
  /* Function for Display Recent product Added
  /*--------------------------------------------------------------*/
 function find_recent_product_added($limit){
   global $db;
   $sql   = " SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
   $sql  .= "m.file_name AS image FROM products p";
   $sql  .= " LEFT JOIN categories c ON c.id = p.categorie_id";
   $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Find Highest saleing Product
 /*--------------------------------------------------------------*/
 function find_higest_saleing_product($limit){
   global $db;
   $sql  = "SELECT p.name, COUNT(s.product_id) AS totalSold, SUM(s.qty) AS totalQty";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN products p ON p.id = s.product_id ";
   $sql .= " GROUP BY s.product_id";
   $sql .= " ORDER BY SUM(s.qty) DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for find all sales
 /*--------------------------------------------------------------*/
 function find_all_sale(){
   global $db;
   $sql  = "SELECT s.id,s.qty,s.price,s.date,p.name";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN products p ON s.product_id = p.id";
   $sql .= " ORDER BY s.date DESC";
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Display Recent sale
 /*--------------------------------------------------------------*/
function find_recent_sale_added($limit){
  global $db;
  $sql  = "SELECT s.id,s.qty,s.price,s.date,p.name";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " ORDER BY s.date DESC LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function find_sale_by_dates($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
  $sql  = "SELECT s.date, p.name,p.sale_price,p.buy_price,";
  $sql .= "COUNT(s.product_id) AS total_records,";
  $sql .= "SUM(s.qty) AS total_sales,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price,";
  $sql .= "SUM(p.buy_price * s.qty) AS total_buying_price ";
  $sql .= "FROM sales s ";
  $sql .= "LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
  $sql .= " GROUP BY DATE(s.date),p.name";
  $sql .= " ORDER BY DATE(s.date) DESC";
  return $db->query($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function  dailySales($year,$month){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function  monthlySales($year){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%c' ),s.product_id";
  $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
  return find_by_sql($sql);
}


//funcion busca empresa 
function buscaempresa(){
    global $db;
     $sql  ="SELECT c.id, c.name, r.id_empresa";
    $sql  .=" AS categories";
    $sql  .=" FROM categories c";
    $sql  .=" LEFT JOIN responsable r ON  r.id_empresa=c.id group by c.name";
    return find_by_sql($sql);

   }
 	//busca impresora
	function busca_imp(){
   global $db;
   $sql   = " SELECT i.id AS identificador, i.serie, i.id_empresa, i.notas, i.id_usuario, i.id_marca, i.id_modelo, c.id, c.name, m.modelo, ma.nombre, r.ape_pat, r.ape_mat, r.nombre AS usuario";
   $sql  .= " FROM impresora i";
   $sql  .= " LEFT JOIN categories c ON i.id_empresa = c.id ";
   $sql  .= " LEFT JOIN modelo m ON i.id_modelo = m.id";
   $sql  .= " LEFT JOIN marca ma ON i.id_marca = ma.id";
   $sql  .= " LEFT JOIN responsable r ON i.id_usuario= r.id";
   $sql  .= " ORDER BY i.id DESC LIMIT 10";
   return find_by_sql($sql);
	
	}
	//busca laptop
	function busca_lap(){
   global $db;
   $sql   = " SELECT l.id, l.serie, l.modelo, l.marca, l.tag, l.id_empresa, l.notas, l.id_usuario, c.name, m.modelo, ma.nombre, r.ape_pat, r.ape_mat, r.nombre AS usuario, s_o.version, ram_.ram ";
   $sql  .= " FROM laptop l";
   $sql  .= " LEFT JOIN categories c ON l.id_empresa = c.id ";
   $sql  .= " LEFT JOIN modelo m ON l.modelo = m.id";
   $sql  .= " LEFT JOIN marca ma ON l.marca = ma.id";
   $sql  .= " LEFT JOIN responsable r ON l.id_usuario= r.id";
   $sql  .= " LEFT JOIN so s_o ON l.id_so= s_o.id";
   $sql  .= " LEFT JOIN ram ram_ ON l.id_ram= ram_.id";
   $sql  .= " ORDER BY l.id DESC LIMIT 10";
   return find_by_sql($sql);
	
	}
function busca_lap_almacen(){
   global $db;
   $sql   = " SELECT l.id, l.serie, l.modelo, l.marca, l.tag, l.id_empresa, l.notas, l.id_usuario, c.name, m.modelo, ma.nombre, r.ape_pat, r.ape_mat, r.nombre AS usuario, s_o.version, ram_.ram ";
   $sql  .= " FROM almacen_laptop l";
   $sql  .= " LEFT JOIN categories c ON l.id_empresa = c.id ";
   $sql  .= " LEFT JOIN modelo m ON l.modelo = m.id";
   $sql  .= " LEFT JOIN marca ma ON l.marca = ma.id";
   $sql  .= " LEFT JOIN responsable r ON l.id_usuario= r.id";
   $sql  .= " LEFT JOIN so s_o ON l.id_so= s_o.id";
   $sql  .= " LEFT JOIN ram ram_ ON l.id_ram= ram_.id";
   $sql  .= " ORDER BY l.id DESC";
   return find_by_sql($sql);
	
	}

	function count_by_empresa(){
 global $db;
   $sql = "SELECT COUNT(r.id) AS total, name FROM responsable r LEFT JOIN categories c ON r.id_empresa=c.id GROUP BY c.id";
     return find_by_sql($sql);
}
	function count_by_empresapc(){
 global $db;
   $sql = "SELECT COUNT(r.id) AS total, name FROM pc r LEFT JOIN categories c ON r.id_empresa=c.id GROUP BY c.id";
     return find_by_sql($sql);
}
	function count_by_empresaall(){
 global $db;
   $sql = "SELECT COUNT(r.id) AS total, name FROM all_in_one r LEFT JOIN categories c ON r.id_empresa=c.id GROUP BY c.id";
     return find_by_sql($sql);
}
function count_by_empresalap(){
 global $db;
   $sql = "SELECT COUNT(r.id) AS total, name FROM laptop r LEFT JOIN categories c ON r.id_empresa=c.id GROUP BY c.id";
     return find_by_sql($sql);
}	
function count_by_empresasca(){
 global $db;
   $sql = "SELECT COUNT(r.id) AS total, name FROM impresora r LEFT JOIN categories c ON r.id_empresa=c.id GROUP BY c.id";
     return find_by_sql($sql);
}	



 function ultima($table){
   global $db;
     $sql= "SELECT MAX(id) FROM ".$db->escape($table);
      return find_by_sql($sql);
}


//recoleccion diaria
function  recoleccion_diaria(){
  global $db;
  $sql  = "SELECT id, direccion, numero, colonia, delegacion, cp, totalp, alto, ancho, largo, peso, nombre, id_empresa, fechaprogramar, fechasolicitud, notas, medida, id_operador, telefono, correo, direccion_des, numero_des, colonia_des, delegacion_des, cp_des, nombre_des, telefono_des FROM recolecta WHERE DATE(fechaprogramar) = DATE(NOW()) && asignado=0";
  return find_by_sql($sql);
}

// && asignado=0


function  operador($id){
  global $db;
  $sql  = "SELECT r.id AS id_reco, r.direccion, r.numero, r.colonia, r.delegacion, r.cp, r.totalp, r.alto, r.ancho, r.largo, r.peso, r.nombre, r.id_empresa, r.fechaprogramar, r.fechasolicitud, r.notas, r.medida, r.id_operador, r.telefono, r.correo, r.direccion_des, r.numero_des, r.colonia_des, r.delegacion_des, r.cp_des, r.nombre_des, r.telefono_des, r.asignado, r.estatus, r.paqueteria, u.id,u.name
  
  
  FROM recolecta r, users u ";
  $sql  .= " WHERE r.id_operador=u.id='{$id}' && r.estatus=0";
     return find_by_sql($sql);
}



//id, direccion, numero, colonia, delegacion, cp, totalp, alto, ancho, largo, peso, nombre, id_empresa, fechaprogramar, fechasolicitud, notas, medida, id_operador, telefono, correo, direccion_des, numero_des, colonia_des, delegacion_des, cp_des, nombre_des, telefono_des
?>

<?php

// Verifica que existan los datos que se enviaron desde el formulario
if(isset($_POST["caracteres"]) && isset($_POST["numcaracteres"])){
 
  //La informacion que se recibio del formulario se almacena en variables
  $numcaracteres = $_POST["numcaracteres"];
  $caracteres = $_POST["caracteres"];
 
  // Verifica que el valor de $numcaracteres este entre 6 y 16
  if($numcaracteres >= 6 && $numcaracteres <= 99){
    //Se definen las variables con los caracteres a utilizar en la contraseña
    $mayusculas = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $minusculas = "abcdefghijklmnopqrstuvwxyz";
    $numeros = "0123456789";
    $c_especiales = "?!*-+_%#/=()";
    /* Para asegurar que se utilizen los valores seleccionados
     * utilizo 2 variables para determinar cuantos caracteres
     * de cada tipo se van a utilizar.
     *
     * $aux almacena el numero de caracteres a utilizar por cada tipo,
     * ese dato tiene que ser un numero entero por eso se redondea hacia
     * abajo con la funcion floor
     */
     $aux = floor($numcaracteres / count($caracteres));
 
    /* Al momento de hacer la division puede que haya quedado un residuo
     * ese se almacena en la variable $residuo
     */
     $residuo = $numcaracteres % count($caracteres);
 
    // La bandera la utiliza para determinar si se va a utilizar el valor del residuo
     $bandera = false;
    // si el residuo es diferente de 0 se enciende la bandera
     if($residuo != 0)
       $bandera = true; 
    
    // Se crea un ciclo para ir generando los caracteres que contendra la contraseña 
     for($i=0; $i<count($caracteres); $i++){
       // Determina si se van a generar minusculas para la contraseña
       if( $caracteres[$i] == "minusculas"){
         /* Determina si se va a utilizar el valor del residuo, si se va a utilizar
          * se le asigna a $max el valor de $aux + $residuo, en caso contrario
          * se asigna a $max solo la variable $aux.
          *
          * Esto mismo se repite para mayusculas, numeros, caracteres especiales
          */
          if($bandera){
            $bandera = false;
            $max = $aux + $residuo;
          }
          else
            $max = $aux;
 
          //Genera los caracteres en minusculas
          for($x = 0; $x < $max; $x++)
            // Se almacenan en un arreglo los valores que se generan
            $arraypassword[] = substr($minusculas, rand(0, strlen($minusculas)-1),1);
          }
          if( $caracteres[$i] == "mayusculas"){
            if($bandera){
              $bandera = false;
              $max = $aux+$residuo;
          }
          else
            $max = $aux;
          for($x = 0; $x < $max; $x++)
            $arraypassword[] = substr($mayusculas, rand(0, strlen($mayusculas)-1),1);
       }
       if( $caracteres[$i] == "numeros"){
         if($bandera){
           $bandera = false;
           $max = $aux+$residuo;
         }
         else
           $max = $aux;
         for($x = 0; $x < $max; $x++)
           $arraypassword[] = substr($numeros, rand(0, strlen($numeros)-1),1);
       }
       if( $caracteres[$i] == "c_especiales"){
         $max = $aux;
         for($x = 0; $x < $max; $x++)
           $arraypassword[] = substr($c_especiales, rand(0, strlen($c_especiales)-1),1);
       }
     }
     // Una vez que se genero la contraseña se desordena el arreglo
     shuffle($arraypassword);
     // Se recorren todos los valores del arreglo y se imprimen
     foreach ($arraypassword as $caracter)
       echo $caracter;
  }
}
?>
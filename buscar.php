<?php

/* 
 * @version v3.0
 * Buscador creador por andrés cataño Medellín 2012
 * Si tienen algun incoveniente no olvides escribir:
 * serdnah2@gmail.com | andres0994@hotmail.com
 * Software libre, el conocimiento es libre.
 * No olvides agradecer y seguirme en mis cuentas:
 * Youtube: http://www.youtube.com/user/serdnah2
 * Twitter: @Andres542
 * Facebook: https://www.facebook.com/andres.ktano
 */

error_reporting(0);
include "conexion.php";
if(isset($_GET['buscar'])){
    $buscar = $_GET['buscar'];
    $findComplete = $_GET['findComplete'];
    if($findComplete == "true"){
        if($connected)
        findComplete($buscar);
    }else{
        if($connected)
        buscar($buscar);
    }
}

/*Función que buscar por palabras similares
 * Usela si necesita buscar por similitudes de palabras.
 * para cambiar a busqueda completa; en el archivo "script.js" 
 * cambie el valor a la variable "findComplete" a: "true"
 * ya que esta por defecto es false
 */
function buscar($buscar){
    $table = "campos"; // tabla donde buscar
    $field = "titulo"; // campo de la tabla
    $result = mysql_query("SELECT * FROM $table WHERE $field LIKE '%$buscar%'" );
    if($result){
        $rows = array();
	while($r = mysql_fetch_assoc($result)){
		$rows[] = $r;
	}
	print json_encode($rows);
    }else{
        $array = array(
        "error" => "error_table",
        "table" => $table,
        "field" => $field,
        );
        print json_encode($array);
        return;
    }
	
}

/*Funcion de busqueda por palabras completas
 * Usela si solo necesita buscar por palabras completas
 * y no por similutedes.
 * para cambiar a busqueda por similitud; en el archivo "script.js" 
 * cambie el valor a la variable "findComplete" a: "false"
 * ya que esta por defecto es false
 */

function findComplete($buscar){
    $table = "campos"; // tabla donde buscar
    $field = "titulo"; // campo de la tabla
    $result = mysql_query("SELECT * FROM $table WHERE $field = '$buscar'" );
    if($result){
            $rows = array();
            while($r = mysql_fetch_assoc($result)){
                    $rows[] = $r;
            }
            print json_encode($rows);
        }else{
            $array = array(
            "error" => "error_table",
            "table" => $table,
            "field" => $field,
            );
            print json_encode($array);
            return;
        }
}
?>

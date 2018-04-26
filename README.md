English | [Español](./README.es-US.md)


# Saforpres
System for the budget accounting record, is a project made in PHP using the software architecture pattern MVC. Will serve for that person who wants to learn the methodology. The PL / SQL programming language was used to manage the information in MySQL for better control of the data. The ADOdb library set was also implemented to provide more portability, speed and ease of connections. The system also manages email and PDF libraries for the generation of reports.

Everything is included and ready to use, I hope it will be useful.

## Overview :mag:
Main menu
![](https://raw.githubusercontent.com/delfinworks/saforpres/master/images/saforpre1.jpg)

Load Module
![](https://raw.githubusercontent.com/delfinworks/saforpres/master/images/saforpre2.jpg)

## Usage :white_check_mark:
- Web Server Apache-2.2.15
- PHP 5.2.13
- MySQL 5.1.46
- phpMyAdmin 3.3.3 

## PHP :eyes:
```bash
function ListProyecto($eje){				
	include_once(PATH.'/gui/ObjetoListBox.class.php');
	$lb = new ListBoxObj();
	$lb->setquery("SELECT safor_pry.id_pry, safor_pry.descripcion FROM safor_pry WHERE (safor_pry.id_eje=".$eje.") ORDER BY safor_pry.id_pry");
	$lb->setnombre_listbox('txtpry_id');
	$lb->setvalor_inicial(array('0',''));
	$lb->setajax_event('onchange');
	$lb->setajax_div('prys');
	$lb->setajax_file_root(PATH."/modulos/formulacion/plan.funciones.php");
	$lb->setajax_class_name("plan_funciones");
	$lb->setajax_parametro_function(0);
	$lb->setajax_function_on_event('Pry_Filtra');
	$lb->GENERA_LISTBOX(0,'',TRUE);				
}
```

## PL/SQL :eyes:
```bash
  CREATE DEFINER=`root`@`localhost` PROCEDURE `borrar_ai` (`v_id` INT, `v_eje` INT, `v_users` VARCHAR(15), `v_ip` VARCHAR(20))  BEGIN
        DECLARE    v_mensaje varchar(150);
        DECLARE    v_valor bool;

         IF NOT EXISTS(SELECT id_ae FROM safor_pry_ae_ai_eje_um WHERE id_ai=v_id AND id_eje=v_eje) THEN
                DELETE FROM safor_ai  WHERE id_ai=v_id AND id_eje=v_eje;
                SET v_mensaje='La accion intermedia se elimino exitosamente. ';
                SET v_valor=true;

                INSERT INTO sers_log_plan (users_id, users_ip, id_ai, accion, id_eje)
                        VALUES (v_users, v_ip, v_id, 'ELIMINACION (AI)', v_eje);
        ELSE
                SET v_mensaje='The intermediate action can not be eliminated, there are units of measure associated with it';
                SET v_valor=false;
        END IF;
        
        SELECT  v_id as id, v_mensaje as mensaje, v_valor as valor;
   END$$
```

## Configuration :gear:

****************************************************************************************
The configuration files of the application are in the "includes" directory.
****************************************************************************************
```bash
/* Database constants "configuracion_db.php" */
define('DB_TYPE','mysql'); //Database manager
define('DB_SERVIDOR', '127.0.0.1'); // IP address of the database server
define('DB_SERVIDOR_PUERTO', '3306'); // Database connection port
define('DB_SERVIDOR_USERNAME', 'user'); // Database connection user
define('DB_SERVIDOR_PASSWORD', 'password); // Database connection password
define('DB_DATABASE', 'saforpres'); //Database name
define('DB_CONEXION_P', false);  // Use persistent connections??
define('DEBUG_ADODB', false); // Option for the ADODB Class to show the errors thrown
```
```bash
/* System routing constants "configuracion.php" */
define('DOCUMENT_ROOT',$_SERVER['DOCUMENT_ROOT']);
define('PATH',$_SERVER['DOCUMENT_ROOT']. '/saforpes''); // 'Place the path where the system is located from the root directory
```

Mount database db/saforpre.sql

Ready!

## Compatibility :triangular_ruler:

Modern browsers and IE11.

Exploradores modernos y IE11.

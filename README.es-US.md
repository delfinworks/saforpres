# Saforpre
El sistema para el registro de contabilidad presupuestaria, es un proyecto realizado en PHP usando la patrón de arquitectura de software MVC que servirá de base para aquella persona que quiera aprender la metodología. Para el manejo de la información se uso PL/SQL en MySQL para un mejor control de los datos. Se usaron también el  conjunto de bibliotecas ADOdb para brindar mas portabilidad, rapidez y facilidad en las conexiones. El sistema también maneja librerías de Email y de PDF para la generación de reportes.


Todo esta incluido y listo para usar, espero sea de utilidad.


## Vision General :mag:
![](https://raw.githubusercontent.com/delfinworks/Saforpre/master/images/saforpre1.jpg)
![](https://raw.githubusercontent.com/delfinworks/Saforpre/master/images/saforpre2.jpg)

## Requerimiento :white_check_mark:
- Web Server Apache-2.2.15
- PHP 5.2.13
- MySQL 5.1.46
- phpMyAdmin 3.3.3 

## MVC :gear:

Manejo de las listas

```bash
  function ListProyecto($eje)
	{				
		include_once(PATH.'/gui/ObjetoListBox.class.php');
		$lb = new ListBoxObj();
		$lb->setquery(	"SELECT 
					  		safor_pry.id_pry, 
							safor_pry.descripcion
						FROM safor_pry 
						WHERE ((safor_pry.id_eje=".$eje.") AND 
							   (safor_pry.poa=TRUE))
						ORDER BY safor_pry.id_pry");
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

## PL/SQL :gear:

Manejo Stored Procedures

```bash
  CREATE DEFINER=`root`@`localhost` PROCEDURE `borrar_ai` (`v_id` INT, `v_eje` INT, `v_users` VARCHAR(15), `v_ip` VARCHAR(20))  BEGIN
        DECLARE    v_mensaje varchar(150);
        DECLARE    v_valor bool;

         IF NOT EXISTS(SELECT id_ae FROM safor_pry_ae_ai_eje_um WHERE id_ai=v_id AND id_eje=v_eje) THEN
                DELETE FROM safor_ai  WHERE id_ai=v_id AND id_eje=v_eje;
                SET v_mensaje='La accion intermedia se elimino exitosamente. ';
                SET v_valor=true;

                INSERT INTO seniat_users_log_plan (seniat_users_id, seniat_users_ip, id_ai, accion, id_eje)
                        VALUES (v_users, v_ip, v_id, 'ELIMINACION (AI)', v_eje);
        ELSE
                SET v_mensaje='La accion intermedia no puede ser eliminada, existen unidades de medida asociados a ella';
                SET v_valor=false;
        END IF;
        
        SELECT  v_id as id, v_mensaje as mensaje, v_valor as valor;
   END$$
```

## Compatibilidad :triangular_ruler:

Exploradores modernos y IE11.

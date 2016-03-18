DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SalidaMercaderiaPto`(
		documento_id            int,
		mercaderia_id  			int,  
		usuario_id 				int,
 out    er_text                 char(25))
BEGIN

/*´
se usa para el movimiento de mercaderias entre los locales.

1. registra el movimiento de ingreso del producto para su trazabilidad
2. carga los datos de documentos en las variables
2. actualiza el estado en la tabla mercadería.
*/

declare locini_id int;
declare locfin_id int;

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'Error SalidaMercaderiaPto';
end;


	select `localfin_id` , `localini_id` into locfin_id, locini_id
    from `souko`.`documentos`
    where `id`  = documento_id;


start transaction;
 	
	UPDATE `souko`.`mercaderias`
	SET `local_id` = locfin_id  
	WHERE `id` = mercaderia_id;

	CALL `AddMovimientos`(mercaderia_id, documento_id, er_text);


commit;
 set er_text = 'ok';
 
END$$
DELIMITER ;

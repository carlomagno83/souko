DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VentaMercaderia`(
		documento_id            int,
		mercaderia_id  			int,  
        _precioventa             decimal(6,2),
		usuario_id 				int,
 out    er_text                 char(25))
BEGIN

/*´
se usa para el movimiento de mercaderias entre los locales.

1. carga los datos de documentos en las variables
2. actualiza mercaderias estado y precioventa
2. adiciona registro de movimiento de asociado a documento.
*/

declare locini_id int;
declare locfin_id int;

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'Error VentaMercaderia';
end;

	select `localfin_id` , `localini_id` into locfin_id, locini_id
    from `souko`.`documentos`
    where `id`  = documento_id;

start transaction;
 	
	UPDATE `souko`.`mercaderias`
	SET `estado` = 'VEN',
         `precioventa` = _precioventa,
         `local_id` = locfin_id
	WHERE `id` = mercaderia_id;

	CALL `AddMovimientos`(mercaderia_id, documento_id, er_text);


commit;
 set er_text = 'ok';
 end$$
DELIMITER ;

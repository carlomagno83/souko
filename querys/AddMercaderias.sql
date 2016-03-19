DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddMercaderias`(
		producto_id  			int, 
		local_id 				int, 
		preciocompra 			decimal(6,2),
		precioventa 			decimal(6,2),
		usuario_id 				int,
 out    er_text                 char(25))
BEGIN

/*
ingresa items en la tabla mercaderias

*/
declare mercaderiacambio_id INT;
declare estado char(3);

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'error en sp_addmercaderias';
end;


start transaction;

	set mercaderiacambio_id = 0;
    set estado = 'ACT';
    
	INSERT INTO `souko`.`mercaderias`
	(`producto_id`,
	`mercaderiacambio_id`,
	`local_id`,
	`estado`,
	`preciocompra`,
	`precioventa`,
	`usuario_id`)
	VALUES
	(producto_id,
	 mercaderiacambio_id,
	 local_id,
	 estado,
	 preciocompra,
	 precioventa,
	 usuario_id);

commit;

 set er_text = 'ok';
 
END$$
DELIMITER ;

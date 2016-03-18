DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddMovimientos`(
		 mercaderia_id   int, 
         documento_id    int,
 out    er_text             char(25))
BEGIN

declare flagoferta  char(3);

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'error en sp_addmovimientos';
end;

start transaction;

	set flagoferta = '000';

		-- ingreso y registro demovimientos
		INSERT INTO `souko`.`movimientos`
		(`mercaderia_id`,`documento_id`,`flagoferta`)
		values
		(mercaderia_id,documento_id, flagoferta );

 commit; 
 set er_text = 'ok';
 
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddDocumentos`( 		
        tipomovimiento_id   int,
		localini_id         int,
		localfin_id         int,
		flagestado          char(3),
		usuario_id          int,
 out    er_text             char(25),
 out    documento_id        int)
BEGIN

/*
Procedimiento para el ingreso de los documentos ( archivo maestro de los movimientos )
declare full_error char(50);
*/

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'error en sp_adddocumentos';
end;

start transaction;

		INSERT INTO `souko`.`documentos`
		(`fechadocumento`,
		`tipomovimiento_id`,
		`localini_id`,
		`localfin_id`,
		`flagestado`,
		`usuario_id`)
		VALUES
		(curdate(),
		tipomovimiento_id,
		localini_id,
		localfin_id,
		flagestado,
		usuario_id);
      
commit;
 SET documento_id = LAST_INSERT_ID();
 set er_text = 'ok';

END$$
DELIMITER ;

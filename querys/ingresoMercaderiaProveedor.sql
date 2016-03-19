DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `IngresoMercaderiaProveedor`(
		documento_id            int,
		producto_id  			int,  
		local_id 				int, 
		preciocompra 			decimal(6,2),
		precioventa 			decimal(6,2),
		usuario_id 				int,
        cant                    int,
 out    er_text                 char(25))
BEGIN
/*´
se usa para el ingreso de mercaderias al almacen, desde el proveedor.
usa un loop de acuerdo a la cantida ingresada
1. registrar en la tabla mercadería.
2. registra el movimiento de ingreso del producto para su trazabilidad
*/
declare cont int default 1;
declare mercaderia_id int;

declare exit handler for sqlexception
begin
	rollback;
    set er_text = 'error en IngresoMercaderiaProveedor';
end;

start transaction;

   WHILE cont  <= cant DO
		-- llamar al procedimiento de mercadería
		CALL `AddMercaderias`
        (producto_id,   
		 local_id, 
		 preciocompra,
		 precioventa,
		 usuario_id,
         er_text);
		SET mercaderia_id = LAST_INSERT_ID();
       
		CALL `AddMovimientos`(mercaderia_id, documento_id,er_text);

		SET  cont = cont + 1; 
   END WHILE;
   
commit;
 set er_text = 'ok';
 
END$$
DELIMITER ;

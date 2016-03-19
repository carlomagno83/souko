

/*
1: Ingreso en documentos
2: ingreso en movimientos
3: ingreso en mercaderia

parametros
datos de documento
	array (producto, cantidad, precio)
*/

CALL `AddDocumentos`(1,1,1,'ACT',1, @doc, @documento_id);
/*
        tipomovimiento_id   int, 1 = ingreso , 2 = salida
		localini_id         int,  1 = almacen
		localfin_id         int,
		flagestado          char(3),  'ACT'
		usuario_id          int,   1 
 out    er_text             char(25)
*/
select @documento_id;

CALL `IngresoMercaderiaProveedor`(@documento_id,1,1,60,90, 1,5, @inmepr);
/*
		documento_id            int,
		producto_id  			int,  
		local_id 				int, 
		preciocompra 			decimal(6,2),
		precioventa 			decimal(6,2),
		usuario_id 				int,
        cant                    int,
 out    er_text                 char(25))
*/


select @inmepr;

select * from documentos;
select * from mercaderias;
select * from movimientos;

/*
delete from documentos where id > 0;
delete from mercaderias where id > 0;
delete from movimientos where id > 0;
*/


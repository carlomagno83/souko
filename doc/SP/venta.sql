

/*
1: call documentos por venta ( localini_id = 0 )
2: call venta mercaderia

parametros
datos de documento
	array (producto, cantidad, precio)
*/

CALL `AddDocumentos`(3,0,25,'ACT',1, @doc, @documento_id);
/* parametros
        tipomovimiento_id   int, 1 = ingreso , 2 = salida , 3 =venta
		localini_id         int,  1 = almacen , 2 = pto_venta2 ( colocar 0 cuando no sea necesario)
		localfin_id         int,  1 = almacen , 2 = pto_venta2 
		flagestado          char(3),  'ACT'
		usuario_id          int,   1 
 out    er_text             char(25)
*/
select @documento_id;
set @merca_id = 20;

CALL `VentaMercaderia`(@documento_id,@merca_id, 35, 1, @samept);

select @samept;

select * from documentos  where id = @documento_id;
select * from mercaderias where id = @merca_id;
select * from movimientos where mercaderia_id = @merca_id;

/* borrado
delete from documentos where id > 0;
delete from mercaderias where id > 0;
delete from movimientos where id > 0;
*/


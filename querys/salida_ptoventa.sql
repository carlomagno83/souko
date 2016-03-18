

/*
1: Ingreso en documentos
2: ingreso en movimientos
3: ingreso en mercaderia

parametros
datos de documento
	array (producto, cantidad, precio)
*/

CALL `AddDocumentos`(2,1,25,'ACT',1, @doc, @documento_id);
/* parametros
        tipomovimiento_id   int, 1 = ingreso , 2 = salida
		localini_id         int,  1 = almacen , 2 = pto_venta2
		localfin_id         int,  1 = almacen , 2 = pto_venta2
		flagestado          char(3),  'ACT'
		usuario_id          int,   1 
 out    er_text             char(25)
*/
select @documento_id;
set @merca_id = 20;

CALL `SalidaMercaderiaPto`(@documento_id,@merca_id,1, @samept);

select @samept;

select * from documentos  where id = @documento_id;
select * from mercaderias where id = @merca_id;
select * from movimientos where mercaderia_id = @merca_id;

/* borrado
delete from documentos where id > 0;
delete from mercaderias where id > 0;
delete from movimientos where id > 0;
*/


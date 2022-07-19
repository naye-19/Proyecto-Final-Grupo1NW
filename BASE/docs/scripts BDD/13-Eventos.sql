use project_nw;;
delimiter $
CREATE EVENT tarea_carrito_anonimo
ON schedule every 15 minute ON completion preserve
DO
begin

	declare idCliente varchar(300);
    declare idProducto int default 0;
	declare cantidad int default 0;
    declare FechaIngreso datetime;
    declare FechaActual datetime;
    declare contador int;
    declare total_registros int;
    
    declare anonimo CURSOR FOR 
		SELECT ClienteAnonimoId, ProdId, ProdCantidad, ProdFechaIngreso 
        FROM carritocompraclienteanonimo;
    
    set contador = 1;
    set total_registros = 0;
    
    select count(*) into total_registros from carritocompraclienteanonimo;
    select now() into FechaActual;
    
    open anonimo;
    
		loop1: loop
        
			fetch anonimo into idCliente, idProducto, cantidad, FechaIngreso;
            
            if ( FechaIngreso < FechaActual ) then
				           
				UPDATE productos SET ProdStock = ProdStock + cantidad where ProdId = idProducto;
				DELETE FROM carritocompraclienteanonimo WHERE ClienteAnonimoId = idCliente AND ProdId = idProducto;
                
			end if;
            
        end loop loop1;
        
    close anonimo;
    
end
$

delimiter $
CREATE EVENT tarea_carrito_usuario
ON schedule every 2 day ON completion preserve
DO
begin

	declare idCliente varchar(300);
    declare idProducto int default 0;
	declare cantidad int default 0;
    declare FechaIngreso datetime;
    declare FechaActual datetime;
    declare contador int;
    declare total_registros int;
    
    declare registrado CURSOR FOR 
		SELECT UsuarioId, ProdId, ProdCantidad, ProdFechaIngreso 
        FROM carritocompraclienteregistrado;
    
    set contador = 1;
    set total_registros = 0;
    
    select count(*) into total_registros from carritocompraclienteregistrado;
    select now() into FechaActual;
    
    open registrado;
    
		loop1: loop
        
			fetch registrado into idCliente, idProducto, cantidad, FechaIngreso;
            
            if ( FechaIngreso < FechaActual ) then
				           
				UPDATE productos SET ProdStock = ProdStock + cantidad where ProdId = idProducto;
				DELETE FROM carritocompraclienteregistrado WHERE UsuarioId = idCliente AND ProdId = idProducto;
                
			end if;
            
        end loop loop1;
        
    close registrado;
    
end
$

SET GLOBAL event_scheduler=ON;
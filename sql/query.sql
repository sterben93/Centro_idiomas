USE Centro_Idiomas;

-- Ver todos los Administradores
select * FROM Administradores;

-- Agregar Administrador --
insert into Administradores(idAdministrador,Nombre, Apellido_Paterno, Apellido_Materno, Contraseña, Correo, status)
value ('CIIRG123', 'Ivan', 'Romero', 'Garcia', 'I12345678', 'rous.archer@gmail.com', true);

-- Eliminar Administradores
delete Administradores.*
from Administradores
where idAdministrador='CIIRG123';

-- Login
select count(*) as login
from Administradores
where idAdministrador='CIIRG123' and Contraseña='I12345678';

-- Nombre del Usuario
select concat(concat(concat(concat(Nombre, ' '), Apellido_Paterno),' '),Apellido_Materno)
from Administradores
where idAdministrador='CIIRG123';

-- Cambiar el status de los administradores
update Administradores
set status = true
where idAdministrador='CIERGCOV';

-- obtener la contraseña
update Administradores
set Contraseña = 'IRG13041993'
where Correo ='rous.archer@gmail.com';



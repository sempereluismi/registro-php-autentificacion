drop database if exists usuarios;
create database if not exists usuarios;
use usuarios;


CREATE TABLE rol (
	id int primary key auto_increment,
    rol varchar(45) not null
);

CREATE TABLE usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    verificado BOOLEAN DEFAULT 0 NOT NULL,
    rolId int not null DEFAULT 2,
    createAt TIMESTAMP not null default CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_rol_user foreign key (rolId) references rol(id)
);

INSERT INTO rol (rol) VALUES ('conexion');
INSERT INTO rol (rol) VALUES ('standard');
INSERT INTO rol (rol) VALUES ('admin');

CREATE USER 'conexion'@'%' IDENTIFIED BY 'abc123.';
GRANT SELECT, INSERT ON usuarios.usuario TO 'conexion'@'%';
GRANT SELECT ON usuarios.rol TO 'conexion'@'%';

CREATE USER 'standard'@'%' IDENTIFIED BY 'abc123.';
GRANT SELECT, INSERT, UPDATE, DELETE ON usuarios.usuario TO 'standard'@'%';
GRANT SELECT ON usuarios.rol TO 'standard'@'%';

CREATE USER 'admin'@'%' IDENTIFIED BY 'abc123.';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, ALTER, REFERENCES, INDEX, TRIGGER, ALTER ROUTINE, CREATE ROUTINE, CREATE VIEW ON usuarios.* TO 'admin'@'%';


SET GLOBAL event_scheduler=ON;
DELIMITER //
DROP PROCEDURE IF EXISTS EliminarUsuariosAntiguosProcedure//
CREATE PROCEDURE EliminarUsuariosAntiguosProcedure()
BEGIN
    DECLARE fecha_actual date default CURRENT_TIMESTAMP;
    DECLARE fecha_creacion date;
    DECLARE verificado_usuario BOOLEAN;
    DECLARE id_usuario INT;
	DECLARE var_final INTEGER DEFAULT 0;

    -- Cursor para recorrer y eliminar las tuplas
    DECLARE cursor_usuarios CURSOR FOR
        SELECT createAt, verificado, id FROM usuarios.usuario;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET var_final = 1;
    
    OPEN cursor_usuarios;

    read_loop: LOOP
        FETCH cursor_usuarios INTO fecha_creacion, verificado_usuario, id_usuario;

        IF var_final = 1 THEN
            LEAVE read_loop;
        END IF;

        -- Calcular la diferencia en días entre la fecha actual y la de creación
        IF (TIMESTAMPDIFF(HOUR, fecha_creacion, fecha_actual) >= 24 AND verificado_usuario = 0) THEN
            -- Eliminar la tupla
            DELETE FROM usuarios.usuario WHERE id = id_usuario;
        END IF;
    END LOOP;

    CLOSE cursor_usuarios;
END //


CREATE EVENT IF NOT EXISTS EliminarUsuariosAntiguos
ON SCHEDULE EVERY 12 HOUR
DO
    CALL EliminarUsuariosAntiguosProcedure();

//



DELIMITER ;


CREATE EVENT IF NOT EXISTS EliminarUsuariosAntiguos
ON SCHEDULE EVERY 12 HOUR
DO
    CALL EliminarUsuariosAntiguosProcedure();

//



DELIMITER ;

CREATE DATABASE db_login;

USE db_login;

CREATE TABLE USUARIO(
id_user int primary key,
NombreCompleto varchar(200),
username varchar(100),
contraseña varchar(100)
);
--
CREATE TABLE TAREAS(
id_tarea int primary key,
id_user int,
tarea  varchar(200),
Estado varchar(50),
foreign key (id_user) references usuario(id_user)
);

--
USE db_login;
-- USERS
INSERT INTO USUARIO VALUES (1,"Limbert Falcon Huanca","LimberthStyle","20Limbert");
INSERT INTO USUARIO VALUES (2,"Junior Huamanñahui Zea","Papita","21Papita");
INSERT INTO USUARIO VALUES (3,"Cristian Mondragon Huanca","Cristian","mondra");
INSERT INTO USUARIO VALUES (4,"Kevin Rojas Fuentes","Kevin","leonidas");
INSERT INTO USUARIO VALUES (5,"Bill Romero Cayllahua","Romero","bill");
INSERT INTO USUARIO VALUES (6,"Vicente Silva Ferro","Vicent","silva");
INSERT INTO USUARIO VALUES (7,"Elvis Chura Cruz","Elvis","chura12");
INSERT INTO USUARIO VALUES (8,"Ronald Salinas Soria","Ronald","chalinas50");
INSERT INTO USUARIO VALUES (9,"Melany Guevara Paucar","Melany","lstyle08");
INSERT INTO USUARIO VALUES (10,"Sofia Guillen Ramirez","Sofia","sofi99");
-- TAREAS
INSERT INTO TAREAS VALUES (1,1,"JUGAR","PENDIENTE");
INSERT INTO TAREAS VALUES (2,1,"NADAR","REALIZADO");
INSERT INTO TAREAS VALUES (3,1,"MIRAR TV","EN PROCESO");


-- CONSULTAS
SELECT USERNAME, CONTRASEÑA FROM USUARIO where USERNAME='$usuario' and CONTRASEÑA='$contraseña';
SELECT ID_TAREA AS ID,
		T.TAREA AS TA,
		T.ESTADO AS ES
    FROM TAREAS T
    ORDER BY ID ASC;

-- TABLAS
SELECT * FROM USUARIO;
SELECT * FROM TAREAS;


SELECT ID_TAREA FROM TAREAS
WHERE ID_TAREA 
    
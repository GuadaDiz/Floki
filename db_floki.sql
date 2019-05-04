create schema db_floki;

CREATE TABLE roles(
id int not null auto_increment primary key,
rol varchar(50) not null);

INSERT INTO roles VALUES(default, "ADMIN");
INSERT INTO roles VALUES(default, "USUARIO REGISTRADO");
INSERT INTO roles VALUES(default, "INVITADO");

CREATE TABLE clientes(
id int not null auto_increment primary key,
nombre varchar(50) not null,
apellido varchar(50) not null,
email varchar(50) not null,
pass varchar(50) not null,
telefono int,
fecha_nacimiento date,
rol_id int not null,
FOREIGN KEY fk_roles(rol_id)
REFERENCES roles(id)
ON DELETE restrict
ON UPDATE cascade
); 

CREATE TABLE domicilios(
id int not null auto_increment primary key,
domicilio_linea1 varchar(100),
domicilio_linea2 varchar(100),
ciudad varchar(30),
provincia varchar(30),
pais varchar(30),
codigo_postal int,
tipo varchar(20),
cliente_id int,
FOREIGN KEY fk_clientes(cliente_id)
REFERENCES clientes(id)
ON DELETE set null
ON UPDATE cascade
);

CREATE TABLE descuentos(
id int not null auto_increment primary key,
porcentaje int not null,
estado varchar(20)
);

CREATE TABLE categorias(
id int not null auto_increment primary key,
nombre varchar(50) not null
);

CREATE TABLE productos(
id int not null auto_increment primary key,
nombre varchar(100) not null,
precio decimal(6,2) not null,
descripcion text,
stock int,
descuento_id int,
FOREIGN KEY fk_descuentos(descuento_id)
REFERENCES descuentos(id)
ON DELETE set null
ON UPDATE cascade
);

CREATE TABLE producto_categoria(
id int not null auto_increment primary key,
producto_id int,
categoria_id int,
FOREIGN KEY fk_productos(producto_id)
REFERENCES productos(id)
ON DELETE set null
ON UPDATE cascade,
FOREIGN KEY fk_categorias(categoria_id)
REFERENCES categorias(id)
ON DELETE set null
ON UPDATE cascade
);





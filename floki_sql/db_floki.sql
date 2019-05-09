create schema db_floki;

CREATE TABLE db_floki.roles(
id int not null auto_increment primary key,
rol varchar(50) not null);

INSERT INTO db_floki.roles VALUES(default, "ADMIN");
INSERT INTO db_floki.roles VALUES(default, "USUARIO REGISTRADO");
INSERT INTO db_floki.roles VALUES(default, "INVITADO");

CREATE TABLE db_floki.usuarios(
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

CREATE TABLE db_floki.domicilios(
id int not null auto_increment primary key,
domicilio_linea1 varchar(100),
domicilio_linea2 varchar(100),
ciudad varchar(30),
provincia varchar(30),
pais varchar(30),
codigo_postal int,
tipo varchar(20),
usuario_id int,
FOREIGN KEY fk_usuarios(usuario_id)
REFERENCES usuarios(id)
ON DELETE set null
ON UPDATE cascade
);

CREATE TABLE db_floki.descuentos(
id int not null auto_increment primary key,
porcentaje int not null,
estado varchar(20)
);

CREATE TABLE db_floki.categorias(
id int not null auto_increment primary key,
nombre varchar(50) not null
);

CREATE TABLE db_floki.productos(
id int not null auto_increment primary key,
nombre varchar(100) not null,
precio decimal(6,2) not null,
descripcion text,
stock int,
descuento_id int,
fotos varchar(100),
FOREIGN KEY fk_descuentos(descuento_id)
REFERENCES descuentos(id)
ON DELETE set null
ON UPDATE cascade
);

CREATE TABLE db_floki.producto_categoria(
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

CREATE TABLE db_floki.correos(
id int not null auto_increment primary key,
nombre varchar(50) not null,
email varchar(50),
telefono int(20)
);


CREATE TABLE db_floki.estado_compra(
id int not null auto_increment primary key,
estado varchar(20)
);

INSERT INTO db_floki.estado_compra VALUES(default, "ESPERANDO PAGO");
INSERT INTO db_floki.estado_compra VALUES(default, "PAGO APROBADO");
INSERT INTO db_floki.estado_compra VALUES(default, "PAGO RECHAZADO");
INSERT INTO db_floki.estado_compra VALUES(default, "COMPRA CANCELADA");
INSERT INTO db_floki.estado_compra VALUES(default, "ENVIO REALIZADO");
INSERT INTO db_floki.estado_compra VALUES(default, "COMPRA FINALIZADA OK");
INSERT INTO db_floki.estado_compra VALUES(default, "RECLAMADA");


CREATE TABLE db_floki.compras(
id int not null auto_increment primary key,
usuario_id int,
fecha datetime,
cantidad_productos int,
precio_final decimal (6,2) not null,
monto_descuento int,
domicilio_envio_id int,
fecha_envio date,
correo_id int,
estado_id int,
FOREIGN KEY fk_usuario_compra(usuario_id)
REFERENCES usuarios(id)
ON DELETE set null
ON UPDATE cascade,
FOREIGN KEY fk_domicilio_envio(domicilio_envio_id)
REFERENCES domicilios(id)
ON DELETE set null
ON UPDATE cascade,
FOREIGN KEY fk_correos(correo_id)
REFERENCES correos(id)
ON DELETE set null
ON UPDATE cascade,
FOREIGN KEY fk_estado_compra(estado_id)
REFERENCES estado_compra(id)
ON DELETE set null
ON UPDATE cascade
);

CREATE TABLE db_floki.detalle_compra(
id int not null auto_increment primary key,
compra_id int,
producto_id int,
cantidad int,
precio_final decimal(6,2),
descuento int,
FOREIGN KEY fk_compra(compra_id)
REFERENCES compras(id)
ON DELETE set null
ON UPDATE cascade,
FOREIGN KEY fk_producto_comprado(producto_id)
REFERENCES productos(id)
ON DELETE set null
ON UPDATE cascade
);





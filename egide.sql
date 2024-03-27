CREATE TABLE USER (
	ID_user int PRIMARY KEY,
	email VARCHAR(255),
	pseudo VARCHAR(255),
	password VARCHAR(255),
	admin BIT(1)
)

CREATE TABLE MESSAGE (
	ID_message int PRIMARY KEY,
	ID_user_get int,
	ID_user_send int,
	Text VARCHAR(255)
)

CREATE TABLE BASE(
	ID_base int PRIMARY KEY,
	ID_user_FK int,
	Ressource FLOAT
)

CREATE TABLE CONSTUIRE (
	ID_base_FK int PRIMARY key,
	ID_Batiment_FK int
)

CREATE TABLE BATIMENT (
	ID_batiment int PRIMARY KEY,
	Ressource_par_minute int,
	Point_de_vie int,
	Defense int
)

CREATE TABLE SOLDAT (
	ID_Soldat int PRIMARY KEY,
	Point_de_vie int,
	Attaque int,
	Bonus_infanterie int,
	Bonus_blinder int,
	Bonus_airiens int,
	ID_batiment int
)

CREATE TABLE POSSEDE (
	ID_base_fk int PRIMARY KEY,
	ID_soldat_fk int
)
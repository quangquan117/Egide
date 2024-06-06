CREATE TABLE user (
    ID_User INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    pseudo VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    admin BOOLEAN NOT NULL
);

CREATE TABLE base (
    ID_Base INT PRIMARY KEY AUTO_INCREMENT,
    ID_User_FK INT,
    resource NUMERIC,
    FOREIGN KEY (ID_User_FK) REFERENCES user(ID_User)
);

CREATE TABLE batiment (
    ID_Batiment INT PRIMARY KEY AUTO_INCREMENT,
	nom VARCHAR(255),
    ressource_par_minute NUMERIC,
    point_de_vie NUMERIC,
    defense NUMERIC,
    prix NUMERIC,
    description VARCHAR(255)
);

CREATE TABLE type_soldat (
    ID_Soldat INT PRIMARY KEY AUTO_INCREMENT,
	nom VARCHAR(255),
    point_de_vie NUMERIC,
    attaque NUMERIC,
    bonus_vs_infanterie FLOAT,
    bonus_vs_blinder FLOAT,
    bonus_vs_aeriens FLOAT,
    prix NUMERIC,
    description VARCHAR(255),
    ID_Batiment_FK INT,
    FOREIGN KEY (ID_Batiment_FK) REFERENCES batiment(ID_Batiment)
);

CREATE TABLE soldat (
    ID_Soldat INT PRIMARY KEY AUTO_INCREMENT,
    nb_soldat NUMERIC,
    type_soldat INT,
    ID_Base_FK INT,
    FOREIGN KEY (ID_Base_FK) REFERENCES base(ID_Base)
);

CREATE TABLE evenement (
    ID_Evenement INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255),
    description VARCHAR(255),
    choix_facile VARCHAR(255),
    choix_difficile VARCHAR(255)
);

CREATE TABLE message (
    ID_Message INT PRIMARY KEY AUTO_INCREMENT,
    ID_User_get INT,
    ID_User_send INT,
    text VARCHAR(255),
    FOREIGN KEY (ID_User_get) REFERENCES user(ID_User),
    FOREIGN KEY (ID_User_send) REFERENCES user(ID_User)
);

CREATE TABLE construire (
    ID_Base_FK INT,
    ID_Batiment_FK INT,
    nb_batiment NUMERIC,
    PRIMARY KEY (ID_Base_FK, ID_Batiment_FK),
    FOREIGN KEY (ID_Base_FK) REFERENCES base(ID_Base),
    FOREIGN KEY (ID_Batiment_FK) REFERENCES batiment(ID_Batiment)
);

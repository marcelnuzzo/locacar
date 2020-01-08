--
-- Base de données: 'locacar'
--
CREATE DATABASE IF NOT EXISTS locacar DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE locacar;

-- --------------------------------------------------------
-- CREATION DES TABLES

SET FOREIGN_KEY_CHECKS =0;

-- TABLE departement
DROP TABLE IF EXISTS departement;
CREATE TABLE departement (
	dep_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	dep_code VARCHAR (50),
	dep_nom VARCHAR (50)
)ENGINE=InnoDB;

-- TABLE categorie
DROP TABLE IF EXISTS categorie;
CREATE TABLE categorie (
	cat_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	cat_nom VARCHAR(50)
)ENGINE=InnoDB;

-- TABLE agence
DROP TABLE IF EXISTS agence;
CREATE TABLE agence (
	age_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	age_nom VARCHAR(50),
	age_adresse VARCHAR(50),	
	age_departement INT NOT NULL
)ENGINE=InnoDB;

-- TABLE gestionnaire
DROP TABLE IF EXISTS gestionnaire;
CREATE TABLE gestionnaire (
	ges_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ges_nom VARCHAR(50),
	ges_prenom VARCHAR(50),
	ges_mail VARCHAR(50) unique,
	ges_mdp VARCHAR(250),
	ges_profil VARCHAR(50),
	ges_agence INT
)ENGINE=InnoDB;

-- TABLE vehicule
DROP TABLE IF EXISTS vehicule;
CREATE TABLE vehicule (
	veh_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	veh_marque VARCHAR(50),
	veh_immatriculation VARCHAR(50),
	veh_agence INT NOT NULL,
	veh_categorie INT NOT NULL
)ENGINE=InnoDB;

-- TABLE client
DROP TABLE IF EXISTS client;
CREATE TABLE client (
	cli_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	cli_nom VARCHAR(50),
	cli_prenom VARCHAR(50),
	cli_adresse VARCHAR(50),
	cli_mail VARCHAR(50) unique,
	cli_mdp VARCHAR(250)
)ENGINE=InnoDB;

-- TABLE location
DROP TABLE IF EXISTS location;
CREATE TABLE location (
	loc_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	loc_date_debut DATETIME,
	loc_date_fin DATETIME,
	loc_age_depart INT NOT NULL,
	loc_age_arrivee INT NOT NULL,
	loc_statut VARCHAR(50),
	loc_client INT NOT NULL,
	loc_gestionnaire INT NOT NULL,
	loc_categorie INT NOT NULL,
	loc_vehicule INT,
	loc_date DATETIME
)ENGINE=InnoDB;

-- TABLE options
DROP TABLE IF EXISTS options;
CREATE TABLE options (
	opt_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	opt_nom VARCHAR(50),
	opt_prix FLOAT NOT NULL
)ENGINE=InnoDB;


-- TABLE plage_horaire
DROP TABLE IF EXISTS plage_horaire;
CREATE TABLE plage_horaire (
	pla_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	pla_hmin FLOAT NOT NULL,
	pla_hmax FLOAT NOT NULL
)ENGINE=InnoDB;

-- TABLE tarif
DROP TABLE IF EXISTS tarif;
CREATE TABLE tarif (
	tar_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tar_thj FLOAT NOT NULL,
	tar_pla INT NOT NULL,
	tar_categorie INT NOT NULL
)ENGINE=InnoDB;

-- TABLE contenir
DROP TABLE IF EXISTS contenir;
CREATE TABLE contenir (
	con_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	con_options INT NOT NULL,
	con_location INT NOT NULL
)ENGINE=InnoDB;


SET FOREIGN_KEY_CHECKS =1;

-- CONTRAINTES
ALTER TABLE agence ADD CONSTRAINT cs1 FOREIGN KEY (age_departement) REFERENCES departement(dep_id);
ALTER TABLE vehicule ADD CONSTRAINT cs2 FOREIGN KEY (veh_agence) REFERENCES agence(age_id);
ALTER TABLE vehicule ADD CONSTRAINT cs3 FOREIGN KEY (veh_categorie) REFERENCES categorie(cat_id);
ALTER TABLE location ADD CONSTRAINT cs4 FOREIGN KEY (loc_age_depart) REFERENCES agence(age_id);
ALTER TABLE location ADD CONSTRAINT cs5 FOREIGN KEY (loc_age_arrivee) REFERENCES agence(age_id);
ALTER TABLE location ADD CONSTRAINT cs6 FOREIGN KEY (loc_client) REFERENCES client(cli_id);
ALTER TABLE location ADD CONSTRAINT cs7 FOREIGN KEY (loc_gestionnaire) REFERENCES gestionnaire(ges_id);
ALTER TABLE location ADD CONSTRAINT cs8 FOREIGN KEY (loc_vehicule) REFERENCES vehicule(veh_id);
ALTER TABLE location ADD CONSTRAINT CS9 FOREIGN KEY (loc_categorie) REFERENCES categorie(cat_id);
ALTER TABLE tarif ADD CONSTRAINT cs10 FOREIGN KEY (tar_pla) REFERENCES plage_horaire(pla_id);
ALTER TABLE tarif ADD CONSTRAINT cs11 FOREIGN KEY (tar_categorie) REFERENCES categorie(cat_id);
ALTER TABLE contenir ADD CONSTRAINT CS12 FOREIGN KEY (con_options) REFERENCES options(opt_id);
ALTER TABLE contenir ADD CONSTRAINT CS13 FOREIGN KEY (con_location) REFERENCES location(loc_id);
ALTER TABLE gestionnaire ADD CONSTRAINT CS14 FOREIGN KEY (ges_agence) REFERENCES agence(age_id);

-- Jeu de données categorie 
insert into categorie values (1, 'petit');
insert into categorie values (2, 'moyen');
insert into categorie values (3, 'grand');
insert into categorie values (4, 'utilitaire');
insert into categorie values (5, 'prestige');
insert into categorie values (6, 'camping car');

-- Jeu de données options
insert into options values(1,	'climatisation',	10);
insert into options values(2,	'GPS',	7);
insert into options values(3,	'pneus neige',	23);
insert into options values(4,	'lecteur vidéo',	5);
insert into options values(5,	'minibar',	15);

-- Jeu de données plage_horaire
insert into plage_horaire values(1,0,12);
insert into plage_horaire values(2,12,24);
insert into plage_horaire values(3,24,8760);

-- Jeu de données tarif
insert into tarif values(1,4,1,1);
insert into tarif values(2,3.5,2,1);
insert into tarif values(3,3,3,1);
insert into tarif values(4,5,1,2);
insert into tarif values(5,4.5,2,2);
insert into tarif values(6,4,3,2);
insert into tarif values(7,7,1,3);
insert into tarif values(8,6.5,2,3);
insert into tarif values(9,6,3,3);
insert into tarif values(10,3,1,4);
insert into tarif values(11,2.5,2,4);
insert into tarif values(12,2,3,4);
insert into tarif values(13,15,1,5);
insert into tarif values(14,14,2,5);
insert into tarif values(15,13,3,5);
insert into tarif values(16,17,1,6);
insert into tarif values(17,16,2,6);
insert into tarif values(18,15,3,6);

-- Jeu de données département
INSERT INTO `departement` (`dep_id`, `dep_code`, `dep_nom`) VALUES
(1, '01', 'Ain'),
(2, '02', 'Aisne'),
(3, '03', 'Allier'),
(5, '05', 'Hautes-Alpes'),
(4, '04', 'Alpes-de-Haute-Provence'),
(6, '06', 'Alpes-Maritimes'),
(7, '07', 'Ardèche'),
(8, '08', 'Ardennes'),
(9, '09', 'Ariège'),
(10, '10', 'Aube'),
(11, '11', 'Aude'),
(12, '12', 'Aveyron'),
(13, '13', 'Bouches-du-Rhône'),
(14, '14', 'Calvados'),
(15, '15', 'Cantal'),
(16, '16', 'Charente'),
(17, '17', 'Charente-Maritime'),
(18, '18', 'Cher'),
(19, '19', 'Corrèze'),
(20, '2a', 'Corse-du-sud'),
(21, '2b', 'Haute-corse'),
(22, '21', 'Côte-d''or'),
(23, '22', 'Côtes-d''armor'),
(24, '23', 'Creuse'),
(25, '24', 'Dordogne'),
(26, '25', 'Doubs'),
(27, '26', 'Drôme'),
(28, '27', 'Eure'),
(29, '28', 'Eure-et-Loir'),
(30, '29', 'Finistère'),
(31, '30', 'Gard'),
(32, '31', 'Haute-Garonne'),
(33, '32', 'Gers'),
(34, '33', 'Gironde'),
(35, '34', 'Hérault'),
(36, '35', 'Ile-et-Vilaine'),
(37, '36', 'Indre'),
(38, '37', 'Indre-et-Loire'),
(39, '38', 'Isère'),
(40, '39', 'Jura'),
(41, '40', 'Landes'),
(42, '41', 'Loir-et-Cher'),
(43, '42', 'Loire'),
(44, '43', 'Haute-Loire'),
(45, '44', 'Loire-Atlantique'),
(46, '45', 'Loiret'),
(47, '46', 'Lot'),
(48, '47', 'Lot-et-Garonne'),
(49, '48', 'Lozère'),
(50, '49', 'Maine-et-Loire'),
(51, '50', 'Manche'),
(52, '51', 'Marne'),
(53, '52', 'Haute-Marne'),
(54, '53', 'Mayenne'),
(55, '54', 'Meurthe-et-Moselle'),
(56, '55', 'Meuse'),
(57, '56', 'Morbihan'),
(58, '57', 'Moselle'),
(59, '58', 'Nièvre'),
(60, '59', 'Nord'),
(61, '60', 'Oise'),
(62, '61', 'Orne'),
(63, '62', 'Pas-de-Calais'),
(64, '63', 'Puy-de-Dôme'),
(65, '64', 'Pyrénées-Atlantiques'),
(66, '65', 'Hautes-Pyrénées'),
(67, '66', 'Pyrénées-Orientales'),
(68, '67', 'Bas-Rhin'),
(69, '68', 'Haut-Rhin'),
(70, '69', 'Rhône'),
(71, '70', 'Haute-Saône'),
(72, '71', 'Saône-et-Loire'),
(73, '72', 'Sarthe'),
(74, '73', 'Savoie'),
(75, '74', 'Haute-Savoie'),
(76, '75', 'Paris'),
(77, '76', 'Seine-Maritime'),
(78, '77', 'Seine-et-Marne'),
(79, '78', 'Yvelines'),
(80, '79', 'Deux-Sèvres'),
(81, '80', 'Somme'),
(82, '81', 'Tarn'),
(83, '82', 'Tarn-et-Garonne'),
(84, '83', 'Var'),
(85, '84', 'Vaucluse'),
(86, '85', 'Vendée'),
(87, '86', 'Vienne'),
(88, '87', 'Haute-Vienne'),
(89, '88', 'Vosges'),
(90, '89', 'Yonne'),
(91, '90', 'Territoire de Belfort'),
(92, '91', 'Essonne'),
(93, '92', 'Hauts-de-Seine'),
(94, '93', 'Seine-Saint-Denis'),
(95, '94', 'Val-de-Marne'),
(96, '95', 'Val-d''oise'),
(97, '976', 'Mayotte'),
(98, '971', 'Guadeloupe'),
(99, '973', 'Guyane'),
(100, '972', 'Martinique'),
(101, '974', 'Réunion');


-- Adatbázis létrehozása best_music néven
CREATE SCHEMA `best_music` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci ;

-- adatbázis kiválasztása
use `best_music`;

-- gitar_kategoriak tábla létrehozása
CREATE TABLE `best_music`.`gitar_kategoriak` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nev` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));

-- gitarok tábla létrehozása
CREATE TABLE `best_music`.`gitarok` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gyarto` VARCHAR(45) NOT NULL,
  `tipus` VARCHAR(45) NOT NULL,
  `kategoria_id` INT NOT NULL,
  `hurok_szama` INT NULL,
  `ar` INT NOT NULL,
  `raktar_mennyiseg` INT NULL,
  `allapot` TINYINT(1) NULL,
  PRIMARY KEY (`id`));
  
-- idegen kulcs beállítások
  ALTER TABLE `best_music`.`gitarok` 
ADD INDEX `gitar_kat_FK_idx` (`kategoria_id` ASC);
ALTER TABLE `best_music`.`gitarok` 
ADD CONSTRAINT `gitar_kat_FK`
  FOREIGN KEY (`kategoria_id`)
  REFERENCES `best_music`.`gitar_kategoriak` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
-- rekordbeszúrások
INSERT INTO `best_music`.`gitar_kategoriak` (`nev`) VALUES ('elektromos');
INSERT INTO `best_music`.`gitar_kategoriak` (`nev`) VALUES ('akusztikus');

INSERT INTO `gitarok` (`id`, `gyarto`, `tipus`, `kategoria_id`, `hurok_szama`, `ar`, `raktar_mennyiseg`, `allapot`) VALUES
(1, 'Fender', 'Bullet Strat - Squier', 2, 6, 42900, 1, 1),
(2, 'Cort', 'AD810-OP', 1, 6, 32900, 9, 0),
(3, 'Yamaha', 'F310 NT', 1, 6, 40900, 0, 1),
(4, 'Yamaha', 'EG112U Black', 2, 6, 72900, 3, 1),
(5, 'Ibanez', 'S521 Blackberry Sunburst', 2, 6, 125900, 5, 1),
(6, 'Epiphone', 'DR-100 EB', 1, 6, 39900, 1, 1),
(7, 'Epiphone', 'DR-212', 1, 12, 79900, 5, 1),
(8, 'Stagg', 'S300-BK', 2, 6, 42900, 7, 1),
(9, 'Cort', 'Earth70 OP', 1, 6, 50000, 8, 1),
(10, 'Stagg', 'J200-BK', 2, 6, 36900, 6, 1),
(11, 'Guild', 'F-1512 Natural Gloss', 1, 12, 324900, 1, 1),
(12, 'Fender', 'FA-125 Sunburst', 1, 6, 40900, 3, 1),
(13, 'Yamaha', 'Pacifica 311 H YNT Satin', 2, 6, 96900, 7, 1),
(14, 'Yamaha', 'Pacifica 510 V OVB', 2, 0, 138900, 0, 1),
(15, 'Ibanez', 'PF 15 NT', 1, 6, 47000, 2, 1),
(16, 'Ibanez', 'AZ242F Tequila Sunrise Gradati', 2, 6, 377000, 1, 1),
(17, 'Jackson', 'JS22-7 Dinky Satin Black', 2, 7, 79900, 8, 1),
(18, 'Epiphone', 'DR-100 NA', 1, 6, 39800, 5, 1),
(20, 'ESP', 'E-II Horizon NT-II', 2, 6, 658900, 1, 1),
(21, 'Ibanez', 'RG1070PBZ Premium Cerulean Blu', 2, 7, 400900, 1, 0),
(22, 'Fender', 'CD-60S', 1, 6, 59900, 0, 0),
(23, 'Ibanez', 'RG7421 Walnut Flat', 2, 7, 138000, 2, 1),
(24, 'Ibanez', 'RGDIX6MPB Surreal Blue Burst', 2, 6, 251000, 8, 1),
(25, 'Schecter', 'Omen-7 Vintage White', 2, 7, 139900, 3, 1),
(26, 'Ibanez', 'AZ242BC Deep Espresso Burst', 2, 6, 377500, 1, 1),
(27, 'Schecter', 'OMEN EXTREME 7 See Thru Black', 2, 7, 173900, 8, 1),
(28, 'Fender', 'Squier Standard Strat', 2, 6, 55900, 1, 1),
(29, 'Cort', 'AF510 NAT', 1, 6, 32900, 10, 1),
(30, 'Pasadena', 'AG160 VS', 1, 6, 26900, 1, 1),
(31, 'Ibanez', 'GSA60-WNF', 2, 6, 63000, 0, 1);

  


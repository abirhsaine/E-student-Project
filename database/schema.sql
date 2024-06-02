DROP TABLE IF EXISTS Etudiant CASCADE;
DROP TABLE IF EXISTS EtudiantSemestre CASCADE;
DROP TABLE IF EXISTS Module CASCADE;
DROP TABLE IF EXISTS ParcoursType CASCADE;
DROP TABLE IF EXISTS Responsable CASCADE;
DROP TABLE IF EXISTS Semestre CASCADE;
DROP TABLE IF EXISTS UE CASCADE;
DROP TABLE IF EXISTS UEModule CASCADE;
DROP TABLE IF EXISTS UESemestre CASCADE;
DROP TABLE IF EXISTS UEValide CASCADE;

DROP VIEW IF EXISTS VueUEImpair CASCADE;
DROP VIEW IF EXISTS VueUEPair CASCADE;
DROP VIEW IF EXISTS VueUEImpairPair CASCADE;
DROP VIEW IF EXISTS VueModuleNbUE CASCADE;
DROP VIEW IF EXISTS VueModuleImpair CASCADE;
DROP VIEW IF EXISTS VueModulePair CASCADE;
DROP VIEW IF EXISTS VueAjourneeDetails CASCADE;
DROP VIEW IF EXISTS VueAjourneeAgg CASCADE;
DROP VIEW IF EXISTS VueCesure CASCADE;
DROP VIEW IF EXISTS Vue2Cesure CASCADE;
DROP VIEW IF EXISTS VueECTS CASCADE;


-- Parcours Type
-- ParcoursType(id : entier, nom : chaîne de 20 caractères)
CREATE TABLE ParcoursType (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(20)
);

-- Module
-- Module(id : chaîne de 10 caractères, libelle : chaîne de 50 caractères, commentaire : texte sans limite de caractères)
CREATE TABLE Module(
    code VARCHAR(10) PRIMARY KEY,
    libelle VARCHAR(50),
    commentaire text
);

-- Responsable
-- Responsable(id : entier, nom : chaîne de 50 caractères, prenom : chaîne de 50 caractères) 
-- Responsable[id] ⊆ UE[responsable]
CREATE TABLE Responsable (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(20),
    prenom VARCHAR(20)
);

-- Etudiant
-- Etudiant(ine : chaîne de 20 caractères, nom : chaîne de 50 caractères, prenom : chaîne de 50 caractères, date_de_naissance : date)
CREATE TABLE etudiant(
    ine VARCHAR(20) PRIMARY KEY,
    nom VARCHAR(20),
    prenom VARCHAR(50),
    date_de_naissance DATE,
    parcours_original INTEGER,
    CONSTRAINT etudiant_fk_parcourstype FOREIGN KEY (parcours_original) REFERENCES ParcoursType(id)
);

-- Semestre
-- Semestre(id : entier, type : chaîne de 20 caractères, annee: date, pair : booléen, parcours_type : entier)
-- type ⊆ {'Académique', 'Césure', 'Professionnel'}
-- Semestre[parcours_type] ⊆ ParcoursType[id]
CREATE TABLE Semestre(
    id SERIAL PRIMARY KEY,
    type VARCHAR(20),
    pair BOOLEAN,
    annee INTEGER,
    parcours_type INTEGER,
    CONSTRAINT check_type CHECK(type in ('Académique', 'Césure', 'Professionnel')),
    CONSTRAINT semestre_fk_parcours_type FOREIGN KEY (parcours_type) REFERENCES ParcoursType(id)
);

-- Unite d'enseignement
-- UE(code : chaine de 20 caractères, modalite : chaine de 3 caractères, libelle : chaine de 50 caractères, responsable : entier, capacite : entier)
-- UE[modalite] ⊆ {“Maj”, “Min”}
-- UE[responsable] ⊆ Responsable[id]
CREATE TABLE UE(
    code VARCHAR(20) PRIMARY KEY,
    modalite VARCHAR(3),
    libelle VARCHAR(50),
    responsable Integer,
    capacite Integer, 
    ects Integer,                      --j ai ajoute cet attribut ects pour la requette 11
    CONSTRAINT modalite_type CHECK (modalite='Maj'or modalite='Min'),
    CONSTRAINT ue_fk_responsable FOREIGN KEY (responsable) REFERENCES Responsable(id)
);

-- UEValide
-- UEValide(ineEtudiant : chaine de 20 caractères, idSemestre : entier, codeUE : chaine de 20 caractères, valide : booléen)
-- UEValide[ineEtudiant] ⊆ Etudiant[ine]
-- UEValide[idSemestre] ⊆ Semestre[id]
-- UEValide[codeUE] ⊆ UE[code]
CREATE TABLE UEValide (
    id INTEGER PRIMARY KEY,
    ineEtudiant VARCHAR(20),
    idSemestre INTEGER,
    codeUE VARCHAR(20),
    valide BOOLEAN,
    CONSTRAINT uevalide_unique UNIQUE (ineEtudiant, idSemestre, codeUE),
    CONSTRAINT uevalide_fk_etudiant FOREIGN KEY (ineEtudiant) REFERENCES Etudiant(ine),
    CONSTRAINT uevalide_fk_semestre FOREIGN KEY (idSemestre) REFERENCES Semestre(id),
    CONSTRAINT uevalide_fk_ue FOREIGN KEY (codeUE) REFERENCES UE(code)
);

-- UEModule
-- UEModule (idModule :chaîne de 10 caractères, codeUE : chaîne de 20 caractères)
-- UEModule[idModule] ⊆ Module[id]
-- UEModule[codeUE] ⊆ UE[code]
CREATE TABLE UEModule(
    codeModule VARCHAR(10),
    codeUE VARCHAR(20),
    PRIMARY KEY (codeModule,codeUE),
    CONSTRAINT uemodule_fk_module FOREIGN KEY (codeModule) REFERENCES Module(code),
    CONSTRAINT uemodule_fk_ue FOREIGN KEY (codeUE) REFERENCES UE(code)
);

-- Etudiant Semestre
-- EtudiantSemestre(id : entier, ine : chaîne de 20 caractères)
-- EtudiantSemestre[id] ⊆ Semestre[id]
-- EtudiantSemestre[ine] ⊆ Etudiant[ine]
CREATE TABLE etudiantsemestre(
    id SERIAL,
    ine VARCHAR(20),
    PRIMARY KEY (id, ine),
    CONSTRAINT etudiantsemestre_fk_semestre FOREIGN KEY (id) REFERENCES Semestre(id),
    CONSTRAINT etudiantsemestre_fk_etudiant FOREIGN KEY (ine) REFERENCES Etudiant(ine)
);

-- UE Semestre
-- UESemestre(code : chaîne de 20 caractères, id : entier)
-- UESemestre[id] ⊆ Semestre[id]
-- UESemestre[code] ⊆ UE[code]
CREATE TABLE UESemestre(
    code VARCHAR(20),
    id INTEGER,
    PRIMARY KEY (code, id),
    CONSTRAINT uesemestre_fk_ue FOREIGN KEY (code) REFERENCES ue(code),
    CONSTRAINT uesemestre_fk_semestre FOREIGN KEY (id) REFERENCES semestre(id)
);

INSERT INTO Responsable VALUES
(1,'ALAIN', 'Pierre'),
(2,'LE CALVEZ', 'Laurent'),
(3,'MALLART', 'Cyrielle'),
(4,'THION', 'Virginie'),
(5,'BARBOT', 'Nelly'),
(6,'CARADEC', 'Nathalie'),
(7,'CHEVELU', 'Jonathan'),
(8,'DUBOIS', 'Hélène'),
(9,'HENRY', 'Karine'),
(10,'LE BRAS', 'Régis'),
(11, 'BARREAUD', 'Vincent');

ALTER SEQUENCE responsable_id_seq RESTART WITH 11;

INSERT INTO Module VALUES
('algo', 'Algorithmique', 'Coefficient 2 pour les INFO en IMR'),
('reseaux', 'Réseaux', 'Connexion de cables'),
('devobj', 'Développement objet', 'Le plan de la maison et la maison'),
('sys', 'Systèmes d''exploitation, systèmes temps réel', 'Linux'),
('archi', 'Architecture des microprocesseurs', 'Découverte d''un coeur ARM'),
('dbb', 'Bases de données', 'C''est la base'),
('web', 'Technologie web', 'PHP, Vue.js, JavaScript'),
('mathsan', 'Analyse', 'Des maths...'),
('mathsalg', 'Algèbre et géométrie', 'Encore des maths...'),
('entr', 'Gestion d''entreprise', 'Beaucoup de choses...'),
('comm', 'Expression-Communication', 'Savoir communiquer'),
('share', 'Partage d''expérience', 'Conférences'),
('en', 'Anglais', 'LV2'),
('aps', 'APS', ''),
('conf', 'Conférences éthique et DD&RS', ''),
('intromicro', 'Introduction aux micro-controlleurs', ''),
('micro', 'Microcontrolleurs', ''),
('algo2', 'Algorithmique 2', ''),
('num', 'Bases pour le numérique', ''),
('ingsys', 'Ingénieurie des systèmes', ''),
('elec', 'Bases de l''électronique', ''),
('maj', 'Mise à niveau', 'Rappels mathématiques'),
('harmo', 'Analyse harmonique', ''),
('sig', 'Signaux et Systèmes (continu)', ''),
('concepcar', 'Conception de cartes', '');

INSERT INTO UE VALUES
('SoInfoMaj_2022', 'Maj', 'SoInfoMaj 2022', 1, 17, 21),       ---j'ai ajoutee la valeur de ects 21 si maj et 9 si min
('HardMin_2022', 'Min', 'HardMin 2022', 9, 20, 9),
('SoMathsMaj_2022', 'Maj', 'SoMathsMaj 2022', 5, 17, 21),
('FondProgMin_2022', 'Min', 'FondProgMin 2022', 4, 15, 9),
('GLMaj_2022', 'Maj', 'GLMaj 2022', 2, 17, 21),
('InfoAvMin_2022', 'Min', 'InfoAvMin 2022', 3, 10, 9),
('CyberMaj_2022', 'Maj', 'CyberMaj 2022', 10, 11, 21),
('SysResMin_2022', 'Min', 'SysResMin 2022', 6, 22, 9),
('WebMaj_2022', 'Maj', 'WebMaj 2022', 7, 13, 21),
('CloudMin_2022', 'Min', 'CloudMin_2022', 8, 17, 9),
('ProjIMin_2022', 'Maj', 'ProjIMin 2022', 8, 20, 21);

--Les données pour ParcoursType
--ParcoursType(id : entier, nom : chaîne de 20 caractères)
INSERT INTO ParcoursType VALUES(01,'PCybersecurite');
INSERT INTO ParcoursType VALUES(02,'PMultimedia');
INSERT INTO ParcoursType VALUES(03,'PSystemeNumerique');
INSERT INTO ParcoursType VALUES(04,'PInfoIA');
INSERT INTO ParcoursType VALUES(05,'PMultimedia');
INSERT INTO ParcoursType VALUES(06,'PInfoReseaux');
-- Les donnees du semestre
-- Semestre(id : entier, type : chaîne de 20 caractères, annee: entier, 
--pair : booléen, parcours_type : entier)
--type ⊆ {'Académique', 'Césure', 'Professionnel'}

INSERT INTO Semestre VALUES(1,'Académique',True,2022,01);
INSERT INTO Semestre VALUES(2,'Professionnel',False,2022,01);
INSERT INTO Semestre VALUES(3,'Césure',True,2022,Null);
INSERT INTO Semestre VALUES(4,'Césure',False,2023,Null);
INSERT INTO Semestre VALUES(5,'Académique',False,2022,02);
INSERT INTO Semestre VALUES(6,'Académique',True,2022,03);
INSERT INTO Semestre VALUES(7,'Professionnel',True,2023,03);
INSERT INTO Semestre VALUES(8,'Académique',False,2023,04);
INSERT INTO Semestre VALUES(9,'Professionnel',False,2024,05);
INSERT INTO Semestre VALUES(10,'Académique',True,2024,06);
INSERT INTO Semestre VALUES(11,'Césure',False,2024,Null);

ALTER SEQUENCE semestre_id_seq RESTART WITH 12;

--Etudiant(ine : chaîne de 20 caractères, nom : chaîne de 50 caractères, prenom : chaîne de 50 caractères, date_de_naissance : date)
--remplissage de la relation Etudiant
INSERT INTO Etudiant VALUES ('2020a01dd','Boutin','Paul','1999-01-01',01);
INSERT INTO Etudiant VALUES ('2020a02dd','Sardou','Michel','1999-08-15',02);
INSERT INTO Etudiant VALUES ('2020a03dd','Hsaine','Abir','2002-01-15',03);
INSERT INTO Etudiant VALUES ('2020a04dd','Cordier','Maxime','2001-07-16',04);
INSERT INTO Etudiant VALUES ('2021b01cc','Uarthegaray','Remi','2001-01-12',04);
INSERT INTO Etudiant VALUES ('2021b02cc','Morrais','Antoine','2001-05-24',05);
INSERT INTO Etudiant VALUES ('2021b03cc','Boultoureau','Mathis','2001-02-19',06);
INSERT INTO Etudiant VALUES ('2022c01aa','LeGall','Lou','1999-02-12',01);
INSERT INTO Etudiant VALUES ('2022c02aa','Quemener','Katell','1999-03-30',02);
INSERT INTO Etudiant VALUES ('2022c03aa','Raji','Zakaria','1998-03-13',03);


INSERT INTO UEModule VALUES 
('algo', 'SoInfoMaj_2022'),
('reseaux', 'SoInfoMaj_2022'),
('mathsan', 'HardMin_2022'),
('mathsalg', 'HardMin_2022'),
('entr', 'HardMin_2022'),
('comm', 'HardMin_2022'),
('share', 'HardMin_2022'),
('en', 'HardMin_2022'),
('aps', 'HardMin_2022'),
('conf', 'HardMin_2022'),
('intromicro', 'HardMin_2022'),
('micro', 'HardMin_2022'),
('algo2', 'SoMathsMaj_2022'),
('num', 'SoMathsMaj_2022'),
('ingsys', 'SoMathsMaj_2022'),
('elec', 'SoMathsMaj_2022'),
('maj', 'SoMathsMaj_2022'),
('harmo', 'SoMathsMaj_2022'),
('sig', 'SoMathsMaj_2022'),
('concepcar', 'SoMathsMaj_2022'),
('algo', 'FondProgMin_2022'),
('reseaux', 'FondProgMin_2022'),
('devobj', 'FondProgMin_2022'),
('sys', 'FondProgMin_2022'),
('archi', 'FondProgMin_2022'),
('dbb', 'FondProgMin_2022'),
('web', 'FondProgMin_2022'),
('num', 'GLMaj_2022'),
('elec', 'GLMaj_2022'),
('maj', 'GLMaj_2022'),
('harmo', 'GLMaj_2022'),
('sig', 'GLMaj_2022'),
('concepcar', 'GLMaj_2022'),
('algo', 'InfoAvMin_2022'),
('reseaux', 'InfoAvMin_2022'),
('devobj', 'InfoAvMin_2022'),
('sys', 'InfoAvMin_2022'),
('archi', 'InfoAvMin_2022'),
('dbb', 'InfoAvMin_2022'),
('web', 'InfoAvMin_2022'),
('num', 'InfoAvMin_2022'),
('elec', 'InfoAvMin_2022'),
('maj', 'InfoAvMin_2022'),
('harmo', 'InfoAvMin_2022'),
('sig', 'InfoAvMin_2022'),
('concepcar', 'InfoAvMin_2022');

INSERT INTO etudiantsemestre VALUES
(1, '2020a01dd'),
(3, '2020a01dd'),
(5, '2020a01dd'),
(6, '2020a01dd'),
(8, '2020a01dd'),
(9, '2020a01dd'),
(1, '2020a02dd'),
(2, '2020a02dd'),
(10, '2020a02dd'),
(11, '2020a02dd'),
(1, '2020a03dd'),
(1, '2020a04dd'),
(2, '2021b01cc'),
(2, '2021b02cc'),
(3, '2022c01aa'),
(3, '2022c02aa'),
(4, '2022c02aa'),
(7, '2022c02aa'),
(8, '2022c02aa'),
(9, '2022c02aa'),
(10, '2022c02aa'),
(3, '2022c03aa'),--------------------
(9, '2020a02dd'),
(6, '2020a02dd'),
(3, '2020a02dd'),
(4, '2020a02dd'),
(8, '2020a02dd'),
(5, '2021b02cc'),------------------------------
(5, '2020a02dd');


--UESemestre(code : chaîne de 20 caractères, id : entier)
--UESemestre[id] ⊆ Semestre[id]
--UESemestre[code] ⊆ UE[code]

INSERT INTO UESemestre VALUES('SoInfoMaj_2022',1);
INSERT INTO UESemestre VALUES('HardMin_2022',2);
INSERT INTO UESemestre VALUES('FondProgMin_2022',3);
INSERT INTO UESemestre VALUES('SoMathsMaj_2022',4);
INSERT INTO UESemestre VALUES('GLMaj_2022',5);
INSERT INTO UESemestre VALUES('GLMaj_2022',6);
INSERT INTO UESemestre VALUES('InfoAvMin_2022',6);
INSERT INTO UESemestre VALUES('CyberMaj_2022',11);
INSERT INTO UESemestre VALUES('SysResMin_2022',8);
INSERT INTO UESemestre VALUES('CloudMin_2022',9);
INSERT INTO UESemestre VALUES('ProjIMin_2022',10);
INSERT INTO UESemestre VALUES('WebMaj_2022',11);
INSERT INTO UESemestre VALUES('SysResMin_2022',7);





INSERT INTO UEValide VALUES
(1, '2020a01dd', 1, 'SoInfoMaj_2022', false),
(2, '2020a01dd', 3, 'FondProgMin_2022', true),
(3, '2020a01dd', 5, 'GLMaj_2022', true),
(4, '2020a01dd', 6, 'InfoAvMin_2022', true),
(5, '2020a01dd', 8, 'SoMathsMaj_2022', true),
(6, '2020a01dd', 9, 'HardMin_2022', true),
(7, '2020a02dd', 1, 'SoInfoMaj_2022', true),----
(8, '2020a02dd', 2, 'FondProgMin_2022', true),
(9, '2020a02dd', 10, 'GLMaj_2022', true),
(10, '2020a02dd', 11, 'InfoAvMin_2022', true),
(11, '2020a03dd', 1, 'SoInfoMaj_2022', false),
(12, '2020a03dd', 3, 'FondProgMin_2022', true),
(13, '2020a03dd', 5, 'GLMaj_2022', true),
(14, '2020a03dd', 6, 'InfoAvMin_2022', false),
(15, '2020a03dd', 8, 'SoMathsMaj_2022', true),
(16, '2020a03dd', 9, 'HardMin_2022', true),
(17, '2020a04dd', 1, 'SoInfoMaj_2022', false),
(18, '2020a04dd', 3, 'FondProgMin_2022', true),
(19, '2020a04dd', 5, 'GLMaj_2022', true),
(20, '2020a04dd', 6, 'InfoAvMin_2022', true),
(21, '2020a04dd', 8, 'SoMathsMaj_2022', true),
(22, '2020a04dd', 9, 'HardMin_2022', true),
(23, '2021b01cc', 1, 'SoInfoMaj_2022', false),
(24, '2021b01cc', 2, 'FondProgMin_2022', true),
(25, '2021b01cc', 11, 'InfoAvMin_2022', true),
(26, '2021b02cc', 1 , 'SoInfoMaj_2022', false),
(27, '2020a02dd', 9 , 'HardMin_2022', true),
(28, '2020a02dd', 6 , 'SoMathsMaj_2022', true),
(29, '2020a02dd', 3 , 'CyberMaj_2022', true),
(30, '2020a02dd', 4 , 'CloudMin_2022', true),
(31, '2020a02dd', 8 , 'ProjIMin_2022', true),
(32, '2021b02cc', 5 , 'WebMaj_2022', true),
(33, '2020a02dd', 5 , 'GLMaj_2022', true),
(34, '2020a02dd', 5 , 'WebMaj_2022', true),
(35, '2020a02dd', 1 , 'WebMaj_2022', true),
(36, '2021b01cc', 10, 'GLMaj_2022', true);


-------------VueUEImpair-------------------------------------------
CREATE VIEW VueUEImpair(codeUE)
AS select code 
from(SELECT id from semestre where pair ='False') as impair natural join UESemestre;

-------------VueUEPair-------------------------------------------
CREATE VIEW VueUEPair(codeUE)
AS select code 
from(SELECT id from semestre where pair ='True') as impair natural join UESemestre;

------------VueUEImpairPair-------------------------------------------
CREATE VIEW VueUEImpairPair(codeUE)
AS select code 
from(SELECT id from semestre where pair ='True'or pair='False') as imp natural join UESemestre;
--------------------VueModuleNbUE---------------------------------------------------------------
CREATE VIEW VueModuleNbUE AS select codemodule,count(codeue)
from uemodule
Group by codemodule;
-------------------------VueModuleImpair-------------------------------------------------------
 CREATE VIEW VueModuleImpair(codedumodule)
  AS select codemodule from 

	(
	(SELECT id from semestre where pair ='False') as impair 
    natural join UESemestre
    ) as ueimpair 
	 natural join  
	 (select codeue as code,codemodule from uemodule) as modeue;
-------------------------VueModulePair-------------------------------------------------------
CREATE VIEW VueModulePair(codedumodule)
  AS select distinct codemodule from 

	(
	(SELECT id from semestre where pair ='True') as impair 
    natural join UESemestre
    ) as uepair 
	 natural join  
	 (select codeue as code,codemodule from uemodule) as modeue;
    -------------------------VueAjourneeDetails--------------------------------
    
CREATE VIEW VueAjourneeDetails(ue,etudiant,annee)
 as select libelle,nom,annee from
(select libelle,ineEtudiant,annee from
 (select libelle,idSemestre,ineEtudiant from
 (select ineEtudiant,idSemestre,codeUE from uevalide where valide = 'False') as val join (select code,libelle from ue )as ueval on val.codeUE=ueval.code)as EU
 join (select id,annee from semestre)as sem on sem.id=EU.idSemestre) as an
 join (select ine,nom from etudiant)as etu on etu.ine=an.ineEtudiant
 ORDER BY nom,annee; 
 -------------------------VueAjourneeAGG------------------------------------------------

  create view VueAjourneeAgg(nbinscrit,uetotal,annee,nbajournee,ueechec,year,pourcentage)
  As select mas.count as nbinscrit,mas.codeue as ue_total,mas.annee,echec.count as nbechoue,echec.codeue as ue_echec,echec.annee,CAST(echec.count as decimal)/CAST(mas.count as decimal)*100 as percent from
 (select count as count,codeue,annee from
(select count(ineetudiant),idsemestre,codeue from
ue join uevalide on ue.code=uevalide.codeue
Group by codeue,idsemestre) as test join
 (select id,annee from semestre) as seme on seme.id=test.idsemestre)as mas 
join (select count(ineetudiant),codeue,annee from
 (select libelle,idSemestre,ineEtudiant,val.codeUE from
 (select ineEtudiant,idSemestre,codeUE from uevalide where valide = 'False') as val join (select code,libelle from ue )as ueval on val.codeUE=ueval.code)as EU
 join (select id,annee from semestre)as sem on sem.id=EU.idSemestre
group by codeue,annee) as echec
on echec.codeue=mas.codeue and echec.annee=mas.annee ;

-------------------------------------VueCesure-------------------------------------------
CREATE VIEW VueCesure(ine,semestreid,annee,nom,prenom)
 as select * from
(select id,annee from semestre where type='Césure') as sem 
natural join (select* from etudiantsemestre)as etu
natural join (select ine,nom,prenom from etudiant)as netu;
-------------------------------------Vue2Cesure-------------------------------------------
CREATE VIEW Vue2Cesure(nom, prenom, anneeCesure1, anneeCesure2)
 as select ces1.nom,ces1.prenom,ces1.annee,ces2.annee from
 (select nom,prenom,annee from VueCesure) as ces1 
 cross join (select nom,prenom,annee from VueCesure) as ces2
 where ces1.nom=ces2.nom and ces1.prenom=ces2.prenom and ces1.annee !=ces2.annee;
-------------------------------------VueECTS-------------------------------------------

CREATE VIEW VueECTS(nbects,ine,annee,nom,prenom)
 AS select sum,ine,annee,nom,prenom from
(select distinct sum(ects),ineetudiant,annee from
(select ects,ineetudiant,annee from
(select code,ects,ineetudiant,idsemestre from
(select code,ects from ue) as UE 
join (select ineEtudiant,codeUE,idSemestre from uevalide) as UEval
on UEval.codeUE= UE.code) as codeee 
 join (select annee,id from semestre) as sem on codeee.idsemestre=sem.id) as ECT 

 GROUP BY ineetudiant,annee
 ORDER BY annee DESC) as ectss
 join (select nom,prenom,ine from etudiant) as etu on etu.ine=ectss.ineetudiant
 ORDER BY nom ASC;
-------------------------------------Vuediplomes-------------------------------------------

 Create VIEW VueDiplomes (nom_diplomee,prenom_diplomee,date_de_naissance,nbects)
 as select nom,prenom,date_de_naissance,ects from
(select ineetudiant,count,pro,ects from
(select ineetudiant,count(type='Maj'),count(modalite='Professionnel')as pro,sum(ects) as ects from
(select ineetudiant,idsemestre,code,modalite,ects from
(select ineetudiant,codeue,idsemestre from uevalide where valide='true')as valide
join (select code,modalite,ects from ue)as UE
on valide.codeue=UE.code) as ecc
join (select id,type from semestre) as sem on ecc.idsemestre=sem.id
group by ineetudiant) as total
where pro>1 and count>=5 and ects>=180) listediplomee
join (select ine,nom,prenom,date_de_naissance from etudiant) as etud
on etud.ine=listediplomee.ineetudiant;
------------------------------------VueInscritsUE-------------------------------------------
create view VueInscritsUE (nomue,ine,nom_etudiant,prenom_etudiant,annee)
as select libelle,lina.ine,nom,prenom,annee from
(select libelle,ine,annee from
(select code,ine,annee from (select ine,id,annee from
(select ine,parcours_original from etudiant) as ed join (select annee,id,parcours_type from semestre)as sem
on ed.parcours_original=sem.parcours_type) as edsem join (select code,id from uesemestre)as coduue
on edsem.id=coduue.id
GROUP BY code,edsem.ine,annee)as codina 
join(select code,libelle from ue) as nameue 
on nameue.code=codina.code) as lina join (select nom,prenom,ine from etudiant)as etu
on etu.ine=lina.ine
Order by annee,libelle;
-----------------------------------------VueAcquisX-----------------------------------------
create view VueAcquisX(ineetudiant, idsemestre, codeue, valide)
as select ineetudiant, idsemestre, codeue, valide from uevalide where valide=true or valide=NULL;
-----------------------------------------VueInscritsUnite-----------------------------------------
create view VueInscritsUnite (codeue, nbinscrit, annee) as
select codeue, count(*) as nbinscrit, annee from uevalide join semestre on uevalide.idsemestre = semestre.id
join ue on uevalide.codeue = ue.code
group by codeue, annee
-- ------------------------------------VueInscritsModule A REVOIR-----------------------------------------
-- Create view VueInscritsModule(lastname,firstname,annee,nom_module)
--  as select lastname,firstname,annee,nom_module from
-- (select lastname,firstname,annee,codemodule from
-- (select lastname,firstname,annee,code from
-- (select nomue,prenom_etudiant as lastname,annee as firstname,annee 
--  from VueInscritsUE)as inscritue join (select code,libelle from ue)as UE 
--  on inscritue.nomue=UE.libelle) uecodeinscrit
--  join (select codemodule,codeue from uemodule)as Modu
--  on Modu.codeue=uecodeinscrit.code) as tout
--  join (select code,commentaire from Module)as Model
--  on Model.code=tout.codemodule;
--  -----------------------------------------VueEtudiantX A REVOIR-----------------------------------------
-- create view VueEtudiantX (ineetudiant,semestre,ue,validation)
--  as select ineetudiant,id as numSemestre,type,codeue,valide from 
-- (select sem.id,ine,type from etudiantsemestre join (select id,type from semestre) as sem 
-- on etudiantsemestre.id=sem.id)as tem
-- join (select * from uevalide)as val 
-- on val.idsemestre=tem.id and tem.ine=val.ineetudiant;
-- -----------------------------------------VueAcquisDetailX A REVOIR-----------------------------------------
-- create view VueAcquisDetailX (etudiant_ine,semestre,uetype,validation,year,uenom,typageue,credit_ects,nom_responsable)
--  as select tempo.ineetudiant,numsemestre,type,valide,annee,libelle,modalite,ects,nom from
--  (select total.ineetudiant,numsemestre,type,valide,annee,libelle,modalite,sum as ECTS,responsable from
-- ( select ineetudiant,numsemestre,type,valide,annee,libelle,modalite,responsable,ects from
--  (select ineetudiant,id as numSemestre,type,codeue,valide,annee from 
-- (select sem.id,ine,type,annee from etudiantsemestre join (select id,type,annee from semestre) as sem 
-- on etudiantsemestre.id=sem.id)as tem
-- join (select * from uevalide)as val 
-- on val.idsemestre=tem.id and tem.ine=val.ineetudiant) as parcours
-- join (select code,libelle,modalite,responsable,ects from ue) as rescod
-- on rescod.code=parcours.codeue ) as total
-- JOIN (select ineetudiant,SUM(ects)from ( select ineetudiant,numsemestre,type,valide,annee,libelle,modalite,responsable,ects from
--  (select ineetudiant,id as numSemestre,type,codeue,valide,annee from 
-- (select sem.id,ine,type,annee from etudiantsemestre join (select id,type,annee from semestre) as sem 
-- on etudiantsemestre.id=sem.id)as tem
-- join (select * from uevalide)as val 
-- on val.idsemestre=tem.id and tem.ine=val.ineetudiant) as parcours
-- join (select code,libelle,modalite,responsable,ects from ue) as rescod
-- on rescod.code=parcours.codeue )as top 
-- 	  GROUP BY ineetudiant) as somme 
-- on somme.ineetudiant=total.ineetudiant) as tempo 
-- join (select id,nom from responsable) as respo 
-- on respo.id=tempo.responsable;
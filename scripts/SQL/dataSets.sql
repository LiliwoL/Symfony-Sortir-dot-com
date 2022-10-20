delete from ville;
delete from lieu;
delete from site;
delete from utilisateur;
delete from sortie;
delete from photo_sortie;
delete from inscription;

delete from sqlite_sequence;

/*Jeux de donnéees ville */

INSERT INTO ville (nom, code_postal)
VALUES
('Nantes', '44000'),
('Saint-Herblain','44800'),
('Rennes','35000'),
('Chartres-de-Bretagne','35131'),
('Quimper','29000'),
('Niort', '79000');


/* Jeux de données lieu */

INSERT INTO lieu (ville_id, nom, rue, latitude, longitude)
VALUES
(2, 'ENI Campus Nantes FARADAY', '3 rue Mickael FARADAY', 47.225433349609375, -1.6185470819473267),
(4, 'ENI Campus Rennes', 'ZAC de La Conterie, 8 Rue Léo Lagrange',48.039398193359375, -1.6918691396713257 ) ,
(5, 'ENI Campus Quimper','2, rue Georges Perros',47.97711944580078, -4.083467960357666),
(6, 'ENI Campus Niort', '19 avenue Léo Lagrange', 46.31629943847656, -0.4703825116157532 ),
(1, 'Lieu Unique','2 Rue de la Biscuiterie', 47.215084075927734, -1.5454285144805908),
(3, 'Roazhon Park','111 Rue de Lorient',48.10929870605469,-1.7080506086349487 );
/*(3, 'Eni Compus Nantes FRANKLIN','r Benjamin Franklin,',48.10929870605469,-1.7080506086349487 );*/

/* Jeux de données site */

INSERT INTO site (localisation_id, nom)
VALUES
(2, ' Nantes Faraday'),
/*(3, ' Nantes Franklin'),*/
(4 ,'Rennes'),
(5 ,'Quimper'),
(6 , 'Niort');

/* Jeux de données utilisateur*/

INSERT INTO utilisateur (username,site_id,roles, password, courriel, is_verified, nom, prenom, telephone, is_actif, nom_photo, is_cgu_accepte)
VALUES
( 'aa',1,'["ROLE_ADMIN"]','$2y$13$zf.lPO/7uA0va9nYld2vteQeqwRE496OHHzsLnshokjLFd6Vtst/.', 'a@a.com', true, 'AUVERGNAT', 'Aurélie','0666666666', true,'aa.jpg',true),
( 'bb',1,'[]','$2y$13$H3mjdb1K154e2KAkdGg0Mu0Jk7rwnIOSTKTs97fBn3xwFK2l2v/Dq', 'b@b.com', true, 'BALVERT', 'Bernard','0666666666',true,'bb.svg',true),
( 'cc',1,'[]','$2y$13$nJDksGsidC0hlWzDGP3vlesrsnRJXXAPXIjw7ZAS4f8Ypx1b5em5u', 'c@c.com', true, 'COWNELL', 'Caroline','0666666666',true,'cc.svg',true),
( 'dd',1,'[]','$2y$13$h3VDj2zpJ6W1oQJ5Ka2gXe54RAfHz1xc7JYJ1wSMnm4FN872PbdnO', 'd@d.com', true, 'DARWIN', 'David','0666666666',true,'dd.svg',true),
( 'ee',1,'[]','$2y$13$TT2oaY6E4VcuxjXqumOr0.wuxwoqW7qxHCpdN5Pl6ZO6L9j586e5y', 'e@e.com', true, 'EPSILON', 'Eloise','0666666666',true,'ee.svg',true);

/* Jeux de données de sortie*/


INSERT INTO sortie (organisateur_id, adresse_id, nom, nb_inscription_max, description, date_ouverture_inscription, date_fermeture_inscription, date_debut_sortie, is_annulee, date_enregistrement, date_fin_sortie)
VALUES
(2,5,'KMRU',10,'Né à Nairobi et actuellement basé à Berlin pour des études universitaires, KMRU est un artiste sonore et un producteur qui nourrit sa musique de field recording*, d’improvisation, de bruit, de machine learning*, d’art radiophonique et de drones. À la frontière entre l’ambient et les musiques africaines, KMRU explore les sonorités et réveille d’intenses émotions pour celui qui l’écoute','2022-10-13 12:00','2022-11-12 12:00', '2022-12-15 19:00', false, '2022-10-13 14:00','2022-12-15 23:00'),
(3,6,'Football, Stade Rennais - FC Toulouse', 10, '15 ème journée de Ligue 1 ','2022-10-13 12:00','2022-10-14 12:00', '2022-11-13 20:00', false, '2022-10-13 12:00','2022-12-15 23:59'),
(2,5,'KMRU',10,'Né à Nairobi et actuellement basé à Berlin pour des études universitaires, KMRU est un artiste sonore et un producteur qui nourrit sa musique de field recording*, d’improvisation, de bruit, de machine learning*, d’art radiophonique et de drones. À la frontière entre l’ambient et les musiques africaines, KMRU explore les sonorités et réveille d’intenses émotions pour celui qui l’écoute','2022-10-13 12:00','2022-11-12 12:00', '2022-12-15 19:00', false, '2022-10-13 14:00','2022-12-15 23:00'),
(3,6,'Football, Stade Rennais - FC Toulouse', 10, '15 ème journée de Ligue 1 ','2022-10-13 12:00','2022-10-14 12:00', '2022-11-13 20:00', false, '2022-10-13 12:00','2022-12-15 23:59'),
(2,5,'KMRU',10,'Né à Nairobi et actuellement basé à Berlin pour des études universitaires, KMRU est un artiste sonore et un producteur qui nourrit sa musique de field recording*, d’improvisation, de bruit, de machine learning*, d’art radiophonique et de drones. À la frontière entre l’ambient et les musiques africaines, KMRU explore les sonorités et réveille d’intenses émotions pour celui qui l’écoute','2022-10-13 12:00','2022-11-12 12:00', '2022-12-15 19:00', false, '2022-10-13 14:00','2022-12-15 23:00'),
(3,6,'Football, Stade Rennais - FC Toulouse', 10, '15 ème journée de Ligue 1 ','2022-10-13 12:00','2022-10-14 12:00', '2022-11-13 20:00', false, '2022-10-13 12:00','2022-12-15 23:59'),
(2,5,'KMRU',10,'Né à Nairobi et actuellement basé à Berlin pour des études universitaires, KMRU est un artiste sonore et un producteur qui nourrit sa musique de field recording*, d’improvisation, de bruit, de machine learning*, d’art radiophonique et de drones. À la frontière entre l’ambient et les musiques africaines, KMRU explore les sonorités et réveille d’intenses émotions pour celui qui l’écoute','2022-10-13 12:00','2022-11-12 12:00', '2022-12-15 19:00', false, '2022-10-13 14:00','2022-12-15 23:00'),
(3,6,'Football, Stade Rennais - FC Toulouse', 10, '15 ème journée de Ligue 1 ','2022-10-13 12:00','2022-10-14 12:00', '2022-11-13 20:00', false, '2022-10-13 12:00','2022-12-15 23:59'),
(2,5,'KMRU',10,'Né à Nairobi et actuellement basé à Berlin pour des études universitaires, KMRU est un artiste sonore et un producteur qui nourrit sa musique de field recording*, d’improvisation, de bruit, de machine learning*, d’art radiophonique et de drones. À la frontière entre l’ambient et les musiques africaines, KMRU explore les sonorités et réveille d’intenses émotions pour celui qui l’écoute','2022-10-13 12:00','2022-11-12 12:00', '2022-12-15 19:00', false, '2022-10-13 14:00','2022-12-15 23:00'),
(3,6,'Football, Stade Rennais - FC Toulouse', 10, '15 ème journée de Ligue 1 ','2021-10-13 12:00','2021-10-14 12:00', '2021-11-13 20:00', false, '2021-10-13 12:00','2021-12-15 23:59'),
(2,5,'KMRU',10,'Né à Nairobi et actuellement basé à Berlin pour des études universitaires, KMRU est un artiste sonore et un producteur qui nourrit sa musique de field recording*, d’improvisation, de bruit, de machine learning*, d’art radiophonique et de drones. À la frontière entre l’ambient et les musiques africaines, KMRU explore les sonorités et réveille d’intenses émotions pour celui qui l’écoute','2022-10-13 12:00','2022-11-12 12:00', '2022-12-15 19:00', false, '2022-10-13 14:00','2022-12-15 23:00'),
(3,6,'Football, Stade Rennais - FC Toulouse', 10, '15 ème journée de Ligue 1 ','2022-10-13 12:00','2022-10-14 12:00', '2022-11-13 20:00', false, '2022-10-13 12:00','2022-12-15 23:59'),
(2,5,'KMRU',10,'Né à Nairobi et actuellement basé à Berlin pour des études universitaires, KMRU est un artiste sonore et un producteur qui nourrit sa musique de field recording*, d’improvisation, de bruit, de machine learning*, d’art radiophonique et de drones. À la frontière entre l’ambient et les musiques africaines, KMRU explore les sonorités et réveille d’intenses émotions pour celui qui l’écoute','2022-10-13 12:00','2022-11-12 12:00', '2022-12-15 19:00', false, '2022-10-13 14:00','2022-12-15 23:00'),
(3,6,'Football, Stade Rennais - FC Toulouse', 10, '15 ème journée de Ligue 1 ','2022-10-13 12:00','2022-10-14 12:00', '2022-11-13 20:00', false, '2022-10-13 12:00','2022-12-15 23:59'),
(2,5,'KMRU',10,'Né à Nairobi et actuellement basé à Berlin pour des études universitaires, KMRU est un artiste sonore et un producteur qui nourrit sa musique de field recording*, d’improvisation, de bruit, de machine learning*, d’art radiophonique et de drones. À la frontière entre l’ambient et les musiques africaines, KMRU explore les sonorités et réveille d’intenses émotions pour celui qui l’écoute','2022-10-13 12:00','2022-11-12 12:00', '2022-12-15 19:00', false, '2022-10-13 14:00','2022-12-15 23:00'),
(3,6,'Football, Stade Rennais - FC Toulouse', 10, '15 ème journée de Ligue 1 ','2022-10-13 12:00','2022-10-14 12:00', '2022-11-13 20:00', false, '2022-10-13 12:00','2022-12-15 23:59');
/*Jeux de données photoSortie*/


INSERT INTO photo_sortie (sortie_id, nom)
VALUES
(1,'kmru.jpg'),
(2,'rennestoulouse.jpg');

/* Jeux de données inscription */
INSERT INTO inscription (utilisateur_id, sortie_id, date_inscription, is_participant)
VALUES
(3,2,'2022-10-20 14:00',true),
(4,2,'2022-10-20 14:00',true),
(5,1,'2022-10-20 14:00',true);





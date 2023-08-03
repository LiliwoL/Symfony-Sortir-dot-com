/* Suppression des tables existantes */
DROP TABLE IF EXISTS ville, lieu, site, utilisateur, sortie, photo_sortie, inscription;

/* Création des tables */

--
-- Base de données : `app`
--

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
                               `idInscription` int(11) NOT NULL,
                               `utilisateur_id` int(11) NOT NULL,
                               `sortie_id` int(11) NOT NULL,
                               `date_inscription` datetime NOT NULL,
                               `is_participant` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
                        `idLieu` int(11) NOT NULL,
                        `nom` varchar(255) NOT NULL,
                        `rue` varchar(255) NOT NULL,
                        `latitude` float NOT NULL,
                        `longitude` float NOT NULL,
                        `ville_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo_sortie`
--

CREATE TABLE `photo_sortie` (
                                `idsortie` int(11) NOT NULL,
                                `sortie_id` int(11) NOT NULL,
                                `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

CREATE TABLE `site` (
                        `idsite` int(11) NOT NULL,
                        `localisation_id` int(11) NOT NULL,
                        `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
                          `idSortie` int(11) NOT NULL,
                          `organisateur_id` int(11) NOT NULL,
                          `adresse_id` int(11) NOT NULL,
                          `nom` varchar(255) NOT NULL,
                          `nb_inscription_max` int(11) NOT NULL,
                          `description` text NOT NULL,
                          `date_ouverture_inscription` datetime NOT NULL,
                          `date_fermeture_inscription` datetime NOT NULL,
                          `date_debut_sortie` datetime NOT NULL,
                          `is_annulee` tinyint(1) NOT NULL,
                          `date_enregistrement` datetime NOT NULL,
                          `date_fin_sortie` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
                               `idUtilisateur` int(11) NOT NULL,
                               `username` varchar(255) NOT NULL,
                               `site_id` int(11) NOT NULL,
                               `roles` varchar(255) NOT NULL,
                               `password` varchar(255) NOT NULL,
                               `courriel` varchar(255) NOT NULL,
                               `is_verified` tinyint(1) NOT NULL,
                               `nom` varchar(255) NOT NULL,
                               `prenom` varchar(255) NOT NULL,
                               `telephone` varchar(255) NOT NULL,
                               `is_actif` tinyint(1) NOT NULL,
                               `nom_photo` varchar(255) NOT NULL,
                               `is_cgu_accepte` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
                         `idVille` int(11) NOT NULL,
                         `nom` varchar(255) NOT NULL,
                         `code_postal` varchar(10) NOT NULL,
                         `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
    ADD PRIMARY KEY (`idInscription`),
  ADD KEY `sortie_id` (`sortie_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
    ADD PRIMARY KEY (`idLieu`),
  ADD KEY `ville_id` (`ville_id`);

--
-- Index pour la table `photo_sortie`
--
ALTER TABLE `photo_sortie`
    ADD PRIMARY KEY (`idsortie`);

--
-- Index pour la table `site`
--
ALTER TABLE `site`
    ADD PRIMARY KEY (`idsite`),
  ADD KEY `site_ibfk_1` (`localisation_id`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
    ADD PRIMARY KEY (`idSortie`),
  ADD KEY `sortie_ibfk_2` (`adresse_id`),
  ADD KEY `sortie_ibfk_1` (`organisateur_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
    ADD PRIMARY KEY (`idUtilisateur`),
  ADD KEY `site_id` (`site_id`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
    ADD PRIMARY KEY (`idVille`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
    MODIFY `idInscription` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
    MODIFY `idLieu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photo_sortie`
--
ALTER TABLE `photo_sortie`
    MODIFY `idsortie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `site`
--
ALTER TABLE `site`
    MODIFY `idsite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
    MODIFY `idSortie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
    MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
    MODIFY `idVille` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
    ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`sortie_id`) REFERENCES `sortie` (`idSortie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `lieu`
--
ALTER TABLE `lieu`
    ADD CONSTRAINT `lieu_ibfk_1` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`idVille`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `site`
--
ALTER TABLE `site`
    ADD CONSTRAINT `site_ibfk_1` FOREIGN KEY (`localisation_id`) REFERENCES `lieu` (`idLieu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sortie`
--
ALTER TABLE `sortie`
    ADD CONSTRAINT `sortie_ibfk_1` FOREIGN KEY (`organisateur_id`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sortie_ibfk_2` FOREIGN KEY (`adresse_id`) REFERENCES `lieu` (`idLieu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
    ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `site` (`idsite`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;




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
(3, 'Eni Compus Nantes FRANKLIN','r Benjamin Franklin,',48.10929870605469,-1.7080506086349487 ),
(5, 'ENI Campus Quimper','2, rue Georges Perros',47.97711944580078, -4.083467960357666),
(6, 'ENI Campus Niort', '19 avenue Léo Lagrange', 46.31629943847656, -0.4703825116157532 ),
(1, 'Lieu Unique','2 Rue de la Biscuiterie', 47.215084075927734, -1.5454285144805908),
(3, 'Roazhon Park','111 Rue de Lorient',48.107745,-1.714349 ),
(1, 'Gare de Nantes','25 boulevard de staligrad',47.21796,-1.542652 ),
(4, 'ENI Campus Rennes', 'ZAC de La Conterie, 8 Rue Léo Lagrange',48.039398193359375, -1.6918691396713257 );


/* Jeux de données site */
INSERT INTO site (localisation_id, nom)
VALUES
(2, ' Nantes Faraday'),
/*(3, ' Nantes Franklin'),*/
/*(4 ,'Rennes'),*/
(5 ,'Quimper'),
(6 , 'Niort');

/* Jeux de données utilisateur*/

/*  password : azerty0123456789 */
INSERT INTO utilisateur (username,site_id,roles, password, courriel, is_verified, nom, prenom, telephone, is_actif, nom_photo, is_cgu_accepte)
VALUES
( 'admin',1,'["ROLE_ADMIN"]','$2y$13$dedlIDS4Oa9T0NHhoTeIg.8quSiR3IkZQ3jx.T9hmfV2jctg1DoBq', 'admin@campus-eni.fr', true, 'AUVERGNAT', 'Aurélie','0123456789', true,'1.jpg',true),
( 'Boubou',1,'[]','$2y$13$dedlIDS4Oa9T0NHhoTeIg.8quSiR3IkZQ3jx.T9hmfV2jctg1DoBq', 'bernard.balvert@campus-eni.fr', true, 'BALVERT', 'Bernard','0123456789',true,'2.jpg',true),
( 'la Mouette ',1,'[]','$2y$13$dedlIDS4Oa9T0NHhoTeIg.8quSiR3IkZQ3jx.T9hmfV2jctg1DoBq', 'caro.cownell@campus-eni.fr', true, 'COWNELL', 'Caroline','0123456789',true,'3.jpg',true),
( 'JarretdePorcSelPoivre',1,'[]','$2y$13$dedlIDS4Oa9T0NHhoTeIg.8quSiR3IkZQ3jx.T9hmfV2jctg1DoBq', 'david.darwin@campus-eni.fr', true, 'DARWIN', 'David','0123456789',true,'4.jpg',true),
( 'pizzaiolo pizzaiolo',1,'[]','$2y$13$dedlIDS4Oa9T0NHhoTeIg.8quSiR3IkZQ3jx.T9hmfV2jctg1DoBq', 'eloise.epsilon@campus-eni.fr', true, 'EPSILON', 'Eloise','0123456789',true,'5.png',true);

/* Jeux de données de sortie*/
INSERT INTO sortie (organisateur_id, adresse_id, nom, nb_inscription_max, description, date_ouverture_inscription, date_fermeture_inscription, date_debut_sortie, is_annulee, date_enregistrement, date_fin_sortie)
VALUES
(2,5,'KMRU',10,'Né à Nairobi et actuellement basé à Berlin pour des études universitaires, KMRU est un artiste sonore et un producteur qui nourrit sa musique de field recording*, d’improvisation, de bruit, de machine learning*, d’art radiophonique et de drones. À la frontière entre l’ambient et les musiques africaines, KMRU explore les sonorités et réveille d’intenses émotions pour celui qui l’écoute','2022-10-13 12:00','2022-11-12 12:00', '2022-12-15 19:00', false, '2022-10-13 14:00','2022-12-15 23:00'),
(3,6,'Football, Stade Rennais - FC Toulouse', 10, '15 ème journée de Ligue 1 ','2022-10-13 12:00','2022-10-14 12:00', '2022-12-15 20:00', false, '2022-10-10 12:00','2022-12-15 23:59'),
(4,7,'harmonie', 2, 'Venez vous ressourcer dans un lieu zen au contact de la nature','2022-10-19 12:00','2022-12-31 12:00', '2023-01-01 20:00', false, '2022-10-12 12:00','2023-03-02 21:00')
;

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
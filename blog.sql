DROP DATABASE IF EXISTS blog;

CREATE DATABASE IF NOT EXISTS blog DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE blog;

CREATE TABLE utilisateur (
  id_utilisateur int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  date_naissance date NOT NULL,
  nom varchar(20) NOT NULL,
  prenom varchar(15) NOT NULL,
  email varchar(30) NOT NULL,
  pseudo varchar(20) NOT NULL,
  mdp varchar(50) NOT NULL,
  avatar varchar(100) DEFAULT "images/avatar/default.png",
  UNIQUE (pseudo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE post (
  id_post int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_utilisateur int NOT NULL,
  titre varchar(100) NOT NULL,
  contenu varchar(10000) NOT NULL,
  imgPresentation varchar(100) DEFAULT "images/post/default.png",
  date_post timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE commentaire (
  id_commentaire int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_post int NOT NULL,
  id_utilisateur int NOT NULL,
  contenu varchar(10000) NOT NULL,
  date_commentaire timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur),
  FOREIGN KEY (id_post) REFERENCES post (id_post) ON DELETE CASCADE /*Supprime les commentaires quand un post est supprimé*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `utilisateur` (`id_utilisateur`, `date_naissance`, `nom`, `prenom`, `email`, `pseudo`, `mdp`, `avatar`, `administrateur`) VALUES
(1, '2023-04-11', 'efz', 'zef', 'a@azd', 'loric', '*93623BE70862E3B70A2D9AEB646DE4C9FA2E1449', 'images/avatar/default.png', 0);
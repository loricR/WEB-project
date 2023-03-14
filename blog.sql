DROP DATABASE blog;

CREATE DATABASE blog;

USE blog;

CREATE TABLE utilisateur (
  id_utilisateur int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  date_naissance date NOT NULL,
  nom varchar(20) NOT NULL,
  prenom varchar(15) NOT NULL,
  email varchar(30) NOT NULL,
  pseudo varchar(20) NOT NULL,
  mdp varchar(50) NOT NULL,
  photo blob,
  createur boolean NOT NULL,
  administrateur boolean NOT NULL,
  UNIQUE (pseudo)
);

CREATE TABLE post (
  id_post int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_utilisateur int NOT NULL,
  titre varchar(100) NOT NULL,
  contenu varchar(10000) NOT NULL,
  date date NOT NULL,
  visible boolean NOT NULL,

  FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)
);
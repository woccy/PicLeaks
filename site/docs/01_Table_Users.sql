/* alotin tekeen tota tutoriaalin pohjalta ja olin laiska ja käytin samoja tunnuksia kuin esimerkeissä */

/*
tietokannan nimi: zf-tutorial
käyttäjä: rob
passu: 123456

users-taulun luonti
*/

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  salt varchar(50) NOT NULL,
  role varchar(50) NOT NULL,
  date_created datetime NOT NULL,
  PRIMARY KEY (id)
);


INSERT INTO users (username, password, salt, role, date_created)
VALUES ('admin', SHA1('passwordce8d96d579d389e783f95b3772785783ea1a9854'),
	'ce8d96d579d389e783f95b3772785783ea1a9854', 'administrator', NOW());
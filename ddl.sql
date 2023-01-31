CREATE DATABASE hackathon_sample;

use hackathon_sample;

CREATE TABLE users(
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(32) NOT NULL,
  age INT NOT NULL
);

INSERT INTO users VALUES(null, '津嶋勇輝', 21);
INSERT INTO users VALUES(null, '石木政吏', 20);
INSERT INTO users VALUES(null, '藤原頼希', 19);

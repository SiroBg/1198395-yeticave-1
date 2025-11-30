CREATE DATABASE yeticave
       DEFAULT CHARACTER SET utf8
       DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE cats (
  cat_name CHAR(64),
  sym_code CHAR(64) PRIMARY KEY
);

CREATE TABLE lots (
  lot_id INT AUTO_INCREMENT PRIMARY KEY,
  date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
  name CHAR(64) NOT NULL,
  descrip VARCHAR(128),
  img_url VARCHAR(128) NOT NULL,
  price INT NOT NULL,
  date_exp DATE NOT NULL,
  bid_step INT,
  user_id INT NOT NULL,
  winner_id INT,
  cat_sym CHAR(64) NOT NULL
);

CREATE TABLE bids (
  bid_id INT AUTO_INCREMENT PRIMARY KEY,
  date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
  sum INT NOT NULL,
  user_id INT NOT NULL,
  lot_id INT NOT NULL
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reg_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  email CHAR(64) NOT NULL UNIQUE,
  name VARCHAR(128) NOT NULL,
  password CHAR(64) NOT NULL,
  contacts VARCHAR(128) NOT NULL,
  lots INT,
  bids INT
);

CREATE INDEX u_email ON users(email);
CREATE INDEX l_name ON lots(name);

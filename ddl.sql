create database Hackathon_casino;

use Hackathon_casino;

create table account(
    id INTEGER AUTO_INCREMENT,
    name VARCHAR(32),
    mail VARCHAR(256) NOT NULL UNIQUE,
    point INTEGER,
    salt VARCHAR(32) NOT NULL,
    password VARCHAR(32) NOT NULL,
    PRIMARY KEY(id)
);

create table casino (
    id INTEGER AUTO_INCREMENT,
    used_point INTEGER,
    standid INTEGER,
    account_id INTEGER NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(account_id) REFERENCES account(id),
    FOREIGN KEY(standid) REFERENCES stand(id)
);

create table stand (
    id INTEGER AUTO_INCREMENT,
    upper_limit INTEGER,
    lower_limit INTEGER,
    stand_id INTEGER,
    PRIMARY KEY(id),
    FOREIGN KEY(stand_id) REFERENCES stand_name(id)
);

create table stand_name (
    id INTEGER AUTO_INCREMENT,
    name VARCHAR(32),
    max_bet INTEGER,
    min_bet INTEGER,
    PRIMARY KEY(id)
);

create table gift(
    id INTEGER AUTO_INCREMENT,
    giftname_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    number INTEGER,
    now_point INTEGER,
    PRIMARY KEY(id),
    FOREIGN KEY(giftname_id) REFERENCES gift_name(id),
    FOREIGN KEY(user_id) REFERENCES account(id)
);

create table gift_name(
    id INTEGER AUTO_INCREMENT,
    exchange_point INTEGER,
    gift VARCHAR(32),
    PRIMARY KEY(id)
);
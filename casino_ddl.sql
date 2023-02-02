create database Hackathon_casino;

use Hackathon_casino;

/*ユーザーのアカウントテーブル*/
create table account(
    id INTEGER AUTO_INCREMENT,
    name VARCHAR(32),
    mail VARCHAR(256) NOT NULL UNIQUE,
    point INTEGER, /*ユーザーが持っているポイント*/
    salt VARCHAR(32) NOT NULL,
    password VARCHAR(64) NOT NULL,
    PRIMARY KEY(id)
);

/*各台の詳細*/
create table stand_name (
    id INTEGER AUTO_INCREMENT,
    name VARCHAR(32),
    max_bet INTEGER,
    min_bet INTEGER,
    PRIMARY KEY(id)
);

INSERT INTO stand_name VALUES(null, '1betルーレット', 1, 10);
INSERT INTO stand_name VALUES(null, '10betルーレット', 10, 100);
INSERT INTO stand_name VALUES(null, '20betスロット', 20, 20);
INSERT INTO stand_name VALUES(null, '40betスロット', 40, 40);

/*台のテーブル*/
create table stand (
    id INTEGER AUTO_INCREMENT,
    upper_limit INTEGER,
    lower_limit INTEGER,
    standname_id INTEGER,
    PRIMARY KEY(id),
    FOREIGN KEY(standname_id) REFERENCES stand_name(id)
);

INSERT INTO stand VALUES(1, 10000, -10000, 1, 0);
INSERT INTO stand VALUES(2, 5000, -5000, 1, 0);
INSERT INTO stand VALUES(3, 10000, -10000, 2, 0);
INSERT INTO stand VALUES(4, 5000, -5000, 2, 0);
INSERT INTO stand VALUES(5, 10000, -10000, 3, 0);
INSERT INTO stand VALUES(6, 5000, -5000, 3, 0);
INSERT INTO stand VALUES(7, 10000, -10000, 4, 0);
INSERT INTO stand VALUES(8, 5000, -50000, 4, 0);

/*カジノについてのテーブル*/
create table casino (
    id INTEGER AUTO_INCREMENT,
    used_point INTEGER, /*ユーザーが使ったポイント*/
    stand_id INTEGER,
    account_id INTEGER NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(account_id) REFERENCES account(id),
    FOREIGN KEY(stand_id) REFERENCES stand(id)
);


/*景品の詳細*/
create table gift_name(
    id INTEGER AUTO_INCREMENT,
    exchange_point INTEGER, /*ユーザーが交換したポイント*/
    gift VARCHAR(32),
    PRIMARY KEY(id)
);

/*景品の中間テーブル*/
create table gift(
    id INTEGER AUTO_INCREMENT,
    giftname_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    number INTEGER,
    now_point INTEGER, /*今の交換できるポイント*/
    PRIMARY KEY(id),
    FOREIGN KEY(giftname_id) REFERENCES gift_name(id),
    FOREIGN KEY(user_id) REFERENCES account(id)
);

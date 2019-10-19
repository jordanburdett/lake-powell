
drop TABLE dates;
drop TABLE user_profile;

CREATE TABLE user_profile (
    id SERIAL NOT NULL PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL
);

CREATE TABLE dates (
    id SERIAL NOT NULL PRIMARY KEY,
    user_id INT NOT NULL REFERENCES user_profile(id),
    month_start INT NOT NULL,
    month_end INT NOT NULL,
    day_start INT NOT NULL,
    day_end INT NOT NULL,
    year_start INT NOT NULL,
    year_end INT NOT NULL
);


INSERT INTO user_profile (username, password, first_name, last_name) VALUES ('jordan', 'password', 'jordan', 'burdett');
INSERT INTO user_profile (username, password, first_name, last_name) VALUES ('amber', 'password', 'amber', 'parr');
INSERT INTO user_profile (username, password, first_name, last_name) VALUES ('troy', 'password', 'troy', 'burdett');
INSERT INTO user_profile (username, password, first_name, last_name) VALUES ('larry', 'password', 'larry', 'burdett');


INSERT INTO dates (user_id, month_start, month_end, day_start, day_end, year_start, year_end) 
VALUES (1, 7, 8, 29, 5, 2019, 2019);
INSERT INTO dates (user_id, month_start, month_end, day_start, day_end, year_start, year_end) 
VALUES (1, 8, 8, 10, 15, 2019, 2019);
INSERT INTO dates (user_id, month_start, month_end, day_start, day_end, year_start, year_end) 
VALUES (1, 8, 8, 20, 25, 2019, 2019);

INSERT INTO dates (user_id, month_start, month_end, day_start, day_end, year_start, year_end) 
VALUES (2, 7, 7, 25, 29, 2019, 2019);
INSERT INTO dates (user_id, month_start, month_end, day_start, day_end, year_start, year_end) 
VALUES (2, 8, 8, 5, 10, 2019, 2019);
INSERT INTO dates (user_id, month_start, month_end, day_start, day_end, year_start, year_end) 
VALUES (2, 7, 7, 15, 20, 2019, 2019);



SELECT * from user_profile;
SELECT * from dates;


SELECT * from dates
where user_id = 0;

SELECT first_name, month_start, month_end, day_start, day_end, year_start, year_end FROM user_profile AS u
JOIN dates AS n
ON u.id = n.user_id;

SELECT username, password, first_name, last_name FROM user_profile
WHERE username = 'jordan' AND password = 'password';
drop TABLE note;
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

CREATE TABLE note (
    id SERIAL NOT NULL PRIMARY KEY,
    user_id INT NOT NULL REFERENCES user_profile(id),
    date_id INT NOT NULL REFERENCES dates(id),
    info VARCHAR(1000)
);


INSERT INTO user_profile (username, password, first_name, last_name) VALUES ('jordan', 'password', 'Jordan', 'Burdett');
INSERT INTO user_profile (username, password, first_name, last_name) VALUES ('amber', 'password', 'Amber', 'Parr');
INSERT INTO user_profile (username, password, first_name, last_name) VALUES ('troy', 'password', 'Troy', 'Burdett');
INSERT INTO user_profile (username, password, first_name, last_name) VALUES ('larry', 'password', 'Larry', 'Burdett');
INSERT INTO user_profile (username, password, first_name, last_name) VALUES ('admin', 'password', 'Brother', 'Birch');

SELECT * from user_profile;
SELECT * from dates;


SELECT * from dates
where user_id = 0;

SELECT first_name, month_start, month_end, day_start, day_end, year_start, year_end FROM user_profile AS u
JOIN dates AS n
ON u.id = n.user_id;

SELECT username, password, first_name, last_name FROM user_profile
WHERE username = 'jordan' AND password = 'password';

SELECT first_name, month_start, month_end, day_start, day_end, year_start, year_end, info, date_id, u.id, n.id, d.id
FROM user_profile AS u
JOIN dates AS n
ON u.id = n.user_id
FULL OUTER JOIN note AS d
ON n.id = d.date_id;

SELECT first_name, last_name FROM user_profile as u, dates as d
WHERE u.id = d.user_id AND d.id = 3;

SELECT month_start, month_end, day_start, day_end, year_start, year_end, info, dates.user_id FROM dates
FULL OUTER JOIN note 
ON note.date_id = dates.id
WHERE dates.id = 1 ORDER BY year_start, month_start, day_start;

 
drop user_profile;
drop dates;

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


INSERT INTO user_profile VALUES (0, 'jordanburdett', 'password', 'jordan', 'burdett');
INSERT INTO user_profile VALUES (1, 'amberparr', 'password', 'amber', 'parr');

INSERT INTO dates VALUES (0, 0, 7, 8, 29, 5, 2019, 2019);



SELECT * from user_profile;
SELECT * from dates;


SELECT * from dates
where user_id = 0;
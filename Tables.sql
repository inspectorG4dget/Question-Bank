-- Table creations

CREATE TABLE QUESTION (
	id		INT(5) ,
	question	VARCHAR(500),

	PRIMARY KEY (id),
	UNIQUE (question)
);

CREATE TABLE TECH (
	id		INT(5) ,
	name	VARCHAR(20),

	PRIMARY KEY (id),
	UNIQUE (name)
);

CREATE TABLE DIFFICULTY (
	question	INT(5),
	tech		INT(5),
	degree		INT(1),
	
	PRIMARY KEY (question, tech),
	
	FOREIGN KEY (question) REFERENCES question(id)
		ON DELETE RESTRICT -- or cascade? Depends on the use case
		ON UPDATE CASCADE,
	
	FOREIGN KEY (tech) REFERENCES tech(id)
		ON DELETE RESTRICT
		ON UPDATE CASCADE
);

-- Inserts
INSERT INTO question (id, question) VALUES (1, 'Q1');
INSERT INTO question (id, question) VALUES (2, 'Q2');

INSERT INTO TECH (id, name) VALUES (1, 'Python');
INSERT INTO TECH (id, name) VALUES (2, 'ASP');

INSERT INTO DIFFICULTY (question, tech, degree) VALUES (1, 1, 1);
INSERT INTO DIFFICULTY (question, tech, degree) VALUES (1, 2, 0);
INSERT INTO DIFFICULTY (question, tech, degree) VALUES (2, 1, 0);
INSERT INTO DIFFICULTY (question, tech, degree) VALUES (2, 2, 1);

-- Get all the questions that have a difficulty between d1 and d2 on technology t

SELECT * FROM (
SELECT Q.question 
FROM QUESTION Q, TECH T, DIFFICULTY D 
WHERE 	D.question = Q.id AND 
	D.tech = T.id AND 
        D.tech = t AND 
        D.degree BETWEEN d_low AND d_high
) as Temp
ORDER BY RAND()
LIMIT lim
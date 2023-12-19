.read sql/defaults.sql

DROP TABLE IF EXISTS Notification;
DROP TABLE IF EXISTS NotificationLevel;
DROP TABLE IF EXISTS Reply;
DROP TABLE IF EXISTS Thread;
DROP TABLE IF EXISTS QuestionAttempts;
DROP TABLE IF EXISTS QuestionRating;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS StudentUCs;
DROP TABLE IF EXISTS UC;
DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS Course;
DROP TABLE IF EXISTS Role;

CREATE TABLE Role (
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL
);

CREATE TABLE Course (
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL
);

CREATE TABLE Student (
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL,
	username TEXT UNIQUE NOT NULL,
	password_hash TEXT NOT NULL,
	creation_date INTEGER NOT NULL,
	role_id INTEGER NOT NULL DEFAULT 1,
	course_id INTEGER,
	FOREIGN KEY (role_id) REFERENCES Role(id),
	FOREIGN KEY (course_id) REFERENCES Course(id)
);

CREATE TABLE UC (
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL,
	code TEXT NOT NULL,
	semester INTEGER NOT NULL,
	year INTEGER NOT NULL,
	course INTEGER NOT NULL,
	FOREIGN KEY (course) REFERENCES Course(id)
);

CREATE TABLE StudentUCs (
	student INTEGER,
	uc INTEGER,
	PRIMARY KEY (student, uc),
	FOREIGN KEY (student) REFERENCES Student(id),
	FOREIGN KEY (uc) REFERENCES UC(id)
);

CREATE TABLE Question (
	id INTEGER PRIMARY KEY,
	question TEXT NOT NULL,
	correct_answer TEXT NOT NULL,
	wrong_answer1 TEXT NOT NULL,
	wrong_answer2 TEXT,
	wrong_answer3 TEXT,
	author INTEGER NOT NULL,
	uc INTEGER NOT NULL,
	FOREIGN KEY (author) REFERENCES Student(id),
	FOREIGN KEY (uc) REFERENCES UC(id)
);

CREATE TABLE QuestionRating (
	student INTEGER,
	question INTEGER,
	user_score INTEGER NOT NULL DEFAULT 0,
	PRIMARY KEY (student, question),
	CHECK (user_score IN (0, 1, -1)),
	FOREIGN KEY (student) REFERENCES Student(id),
	FOREIGN KEY (question) REFERENCES Question(id)
);

CREATE TABLE QuestionAttempts (
	student INTEGER,
	question INTEGER,
	date INTEGER NOT NULL,
	selected INTEGER NOT NULL CHECK (selected IN (1, 2, 3, 4)),
	FOREIGN KEY (student) REFERENCES Student(id),
	FOREIGN KEY (question) REFERENCES Question(id)
);

CREATE TABLE Thread (
	id INTEGER PRIMARY KEY,
	title TEXT NOT NULL,
	creation_date INTEGER NOT NULL,
	content TEXT,
	author INTEGER NOT NULL,
	uc INTEGER,
	FOREIGN KEY (author) REFERENCES Student(id),
	FOREIGN KEY (uc) REFERENCES UC(id)
);

CREATE TABLE Reply (
	id INTEGER PRIMARY KEY,
	creation_date INTEGER NOT NULL,
	content TEXT NOT NULL,
	author INTEGER NOT NULL,
	thread INTEGER NOT NULL,
	FOREIGN KEY (author) REFERENCES Student(id),
	FOREIGN KEY (thread) REFERENCES Thread(id)
);

CREATE TABLE NotificationLevel (
	student INTEGER,
	thread INTEGER,
	level INTEGER not NULL DEFAULT 0,
	PRIMARY KEY (student, thread),
	FOREIGN KEY (student) REFERENCES Student(id)
	FOREIGN KEY (thread) REFERENCES Thread(id)  
);

CREATE TABLE Notification (
	student INTEGER,
	reply INTEGER,
	was_read INTEGER NOT NULL DEFAULT 0 CHECK (was_read IN (0, 1)),
	PRIMARY KEY (student, reply),
	FOREIGN KEY (student) REFERENCES Student(id)
	FOREIGN KEY (reply) REFERENCES Reply(id)	
);

INSERT INTO Role (name) VALUES ('membro');
INSERT INTO Role (name) VALUES ('admin');

INSERT INTO Course (name) VALUES ('Bioengeneering');
INSERT INTO Course (name) VALUES ('Retirement Preparation');

INSERT INTO UC (name, code, semester, year, course) VALUES ('Enology 1', 'EN1', 1, 1, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Ornitology', 'ORN', 1, 1, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Enology 2', 'EN2', 1, 2, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Star Wars History 1', 'SWH1', 1, 2, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Grape Appreciation', 'GRAP', 2, 1, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Macarena and Ballroom Dances', 'MABD', 2, 1, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Enology 3', 'EN3', 2, 2, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Bakery', 'BAK', 2, 2, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Slavic', 'SLV', 1, 3, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Star Wars History 2', 'SWH2', 1, 3, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Ornitology Applied to Bird Watching', 'OABW', 2, 3, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Star Wars History Applied to Bird Watching', 'SWBW', 2, 3, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Gaming 1', 'GAM1', 1, 4, 2);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Gaming 2', 'GAM2', 2, 4, 2);

INSERT INTO UC (name, code, semester, year, course) VALUES ('Material Sciences', 'CMBI', 1, 1, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Cientific Programing', 'IPCOM', 1, 1, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Celular Biology', 'BIOCEL', 2, 1, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Organic Chemistry', 'QOBI', 2, 1, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Fluid Mechanics', 'MFLU', 1, 2, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Electromagnetism', 'ELEL', 1, 2, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Microbiology', 'MGER', 1, 2, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Signals and Electronics', 'SEL', 2, 2, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Statistics', 'MNES', 2, 2, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Molecular Biology', 'BIOMOL', 2, 2, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Processing of Phisiological Signal', 'PSFI', 1, 3, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Sensors and Actuators', 'SA', 1, 3, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Anatomy', 'ANAT', 1, 3, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Image Processing', 'AIBI', 2, 3, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Information Systems Engeneering', 'ESIN', 1, 4, 1);
INSERT INTO UC (name, code, semester, year, course) VALUES ('Computer Assisted Diagnosis', 'DACO', 1, 4, 1);

INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Diamantino Freitas', 'diamantino', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 12, 2, 2);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Jonas Carvalho', 'jonas', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 300, 1, 1);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Pedro Felix', 'furrix', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 1098765432, 1, 1);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Rocky Cebola', 'rocky', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 3456789012, 1, 2);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Jack Douglass', 'jacksfilms', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 7890123456, 1, 2);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Charles Christopher White Jr.', 'penguinz0', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 2345678901, 1, 1);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('J. R. R. Tolkien', 'bilbobaggins', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 8765432109, 2, 2);


INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('What is the primary ingredient in wine?', 'Grapes', 'Apples', 'Oranges', 'Berries', 1, 1);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Which type of wine is typically lighter in color?', 'White wine', 'Red wine', 'Rosé wine', 'Sparkling wine', 2, 1);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('In winemaking, what is fermentation?', 'Conversion of sugars into alcohol', 'A type of grape', 'A wine storage container', 'A wine glass', 3, 1);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('What is the purpose of aging wine?', 'Enhancing flavor and complexity', 'Reducing alcohol content', 'Preventing fermentation', NULL, 4, 1);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Which country is known for its Bordeaux wine?', 'France', 'Italy', 'Spain', NULL, 5, 1);

INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('What is the study of birds called?', 'Ornithology', 'Entomology', 'Herpetology', NULL, 6, 2);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Which bird is known for its ability to mimic human speech?', 'Parrot', 'Penguin', NULL, NULL, 7, 2);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('What is the largest bird of prey?', 'Andean condor', 'Golden eagle', 'Bald eagle', NULL, 7, 2);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Which bird species is known for its long migration journeys?', 'Arctic tern', 'Albatross', 'Swan', 'Puffin', 1, 2);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('What is the scientific name for the study of bird nests?', 'Nidology', 'Aviology', 'Ornamentology', 'Aerology', 2, 2);

INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Which grape variety is used to make Chardonnay wine?', 'Chardonnay', 'Merlot', 'Sauvignon Blanc', 'Pinot Noir', 3, 3);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('What is the primary difference between red and white wine production?', 'Use of grape skins', 'Use of oak barrels', 'Fermentation process', 'Alcohol content', 4, 3);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Which region is famous for its Cabernet Sauvignon wines?', 'Napa Valley', 'Bordeaux', 'Tuscany', 'Barossa Valley', 5, 3);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('What is the purpose of racking in winemaking?', 'Separating wine from sediment', 'Blending different wines', 'Filtering impurities', NULL, 6, 3);

INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Question 1 for Grape Appreciation?', 'Correct Answer', 'Wrong Answer 1', 'Wrong Answer 2', 'Wrong Answer 3', 1, 5);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Question 2 for Grape Appreciation?', 'Correct Answer', 'Wrong Answer 1', 'Wrong Answer 2', 'Wrong Answer 3', 2, 5);

INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('What does the term "Macarena" refer to in the lyrics?', 'The name of a woman', 'A dance move', 'A city in Spain', 'A type of food', 1, 6);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('In which type of dance do partners hold each other in a closed position?', 'Ballroom', 'Breakdance', 'Swing', NULL, 4, 6);

INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Which of these is NOT related to Luke Skywalker?', 'Jabba the Hutt', 'Princess Leia', 'Darth Vader', 'Padme Amidala', 3, 4);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('What was Darth Sidious’ ultimate goal?', 'To become the most powerful Sith Lord', 'To destroy the Jedi Order', 'To rule the Tattooine', 'Padme Amidala', 3, 4);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Who trained Anakin Skywalker?', 'Obi-Wan Kenobi', 'Jabba the Hutt', 'Darth Vader', NULL, 2, 4);

INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Who created the rule of 2?', 'Darth Bane', 'Darth Sidious', 'Darth Plahueis', 'Darth Nihilus', 2, 10);
INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Who was Darth Sidious’ master?', 'Darth Plagueis', 'Darth Maul', 'Darth Tyranus', NULL, 3, 10);

INSERT INTO Question (question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3, author, uc) VALUES ('Grapes are good.', 'T', 'F', NULL, NULL, 1, 5);

INSERT INTO StudentUCs (student, uc) VALUES (1,4);
INSERT INTO StudentUCs (student, uc) VALUES (1,15);
INSERT INTO StudentUCs (student, uc) VALUES (1,16);
INSERT INTO StudentUCs (student, uc) VALUES (1,17);

INSERT INTO StudentUCs (student, uc) VALUES (2,1);
INSERT INTO StudentUCs (student, uc) VALUES (2,2);
INSERT INTO StudentUCs (student, uc) VALUES (2,3);
INSERT INTO StudentUCs (student, uc) VALUES (2,4);
INSERT INTO StudentUCs (student, uc) VALUES (2,5);
INSERT INTO StudentUCs (student, uc) VALUES (2,6);
INSERT INTO StudentUCs (student, uc) VALUES (2,7);
INSERT INTO StudentUCs (student, uc) VALUES (2,8);

INSERT INTO StudentUCs (student, uc) VALUES (3,4);
INSERT INTO StudentUCs (student, uc) VALUES (3,5);

INSERT INTO Thread (title, creation_date, content, author, uc) VALUES ('Help with reports', 0, 'I was interestedin throwing some blind people in the metro. Any volunteers?', 1, 17);
INSERT INTO Thread (title, creation_date, content, author, uc) VALUES ('Welcome to web-Jonas', 0, 'Our platform is built by students for students. We hope you will enjoy your study sessions here and that can help you with your academic endeavours.', 3, NULL);
INSERT INTO Thread (title, creation_date, content, author, uc) VALUES ('Where is the bathroom at FEUP?', 0, NULL, 3, NULL);

INSERT INTO Reply (content, creation_date, author, thread) VALUES ('No thanks uwu', 1, 3, 1);
INSERT INTO Reply (content, creation_date, author, thread) VALUES ('I would also like to know.', 1, 2, 2);


INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 1, 3600, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 2, 3601, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 1, 3610, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 2, 3611, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 1, 3611, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 1, 3611, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 1, 3611, 2);


INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 1, 450, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 2, 521, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 1, 1210, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 1, 1520, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 1, 1520, 2);

INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 1, 450, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 2, 521, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 1, 1210, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (3, 1, 1520, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 1, 1520, 2);

INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 18, 275521, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 13, 399214, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 4, 221004, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 17, 286638, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 18, 359366, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 12, 475604, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (4, 8, 300385, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 5, 188117, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (4, 5, 159049, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 14, 318064, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 5, 268253, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 2, 196702, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 9, 478866, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 9, 151958, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (3, 14, 451502, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (4, 15, 208797, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 18, 320112, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 3, 126070, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 20, 348147, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 8, 140193, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 7, 123415, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (3, 10, 475562, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (4, 1, 245481, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (3, 2, 58208, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (3, 9, 232960, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (6, 7, 376230, 1);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 7, 7365, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (6, 7, 140800, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (2, 5, 228957, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (4, 20, 228080, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (4, 5, 451815, 4);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (6, 20, 2023, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 14, 462343, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 5, 267779, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 12, 309781, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 13, 347783, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (3, 6, 273554, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 13, 272030, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (1, 7, 48353, 2);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (5, 13, 36640, 3);
INSERT INTO QuestionAttempts (student, question, date, selected) VALUES (4, 1, 490020, 4);
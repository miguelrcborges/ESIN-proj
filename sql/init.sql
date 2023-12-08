.read sql/defaults.sql

DROP TABLE IF EXISTS Notification;
DROP TABLE IF EXISTS NotificationLevel;
DROP TABLE IF EXISTS Reply;
DROP TABLE IF EXISTS Thread;
DROP TABLE IF EXISTS QuestionAttempts;
DROP TABLE IF EXISTS QuestionRating;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS StudentUCs;
DROP TABLE IF EXISTS Course;
DROP TABLE IF EXISTS Role;
DROP TABLE IF EXISTS UC;
DROP TABLE IF EXISTS Student;


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

CREATE TABLE UC (
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL,
	semester INTEGER NOT NULL,
	year INTEGER NOT NULL,
	course INTEGER NOT NULL,
	FOREIGN KEY (course) REFERENCES Course(id)
);

CREATE TABLE Role (
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL
);

CREATE TABLE Course (
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL
);

CREATE TABLE UC (
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL,
	semester INTEGER NOT NULL,
	year INTEGER NOT NULL,
	course INTEGER NOT NULL,
	FOREIGN KEY (course) REFERENCES Course(id)
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
	was_correct INTEGER NOT NULL CHECK (was_correct IN (0, 1)),
	PRIMARY KEY (student, question),
	FOREIGN KEY (student) REFERENCES Student(id),
	FOREIGN KEY (question) REFERENCES Question(id)
);

CREATE TABLE Thread (
	id INTEGER PRIMARY KEY,
	title TEXT NOT NULL,
	creation_date INTEGER NOT NULL,
	content TEXT,
	author INTEGER NOT NULL,
	FOREIGN KEY (author) REFERENCES Student(id)
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

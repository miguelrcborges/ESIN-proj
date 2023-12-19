.read sql/init.sql

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

INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Diamantino Freitas', 'diamantino', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 0, 2, 2);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Jonas Carvalho', 'jonas', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 0, 1, 1);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Pedro Felix', 'furrix', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 0, 1, 1);

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
INSERT INTO Thread (title, creation_date, content, author, uc) VALUES ('Where is the bathroom at FEUP?', 0, NULL, 3, NULL);

INSERT INTO Reply (content, creation_date, author, thread) VALUES ('No thanks uwu', 1, 3, 1);
INSERT INTO Reply (content, creation_date, author, thread) VALUES ('Yes', 1, 2, 2);

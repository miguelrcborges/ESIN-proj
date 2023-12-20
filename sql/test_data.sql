.read sql/init.sql

INSERT INTO Course (name) VALUES ('Bioengeneering');
INSERT INTO Course (name) VALUES ('Retirement Preparation');

INSERT INTO UC (name, code, course) VALUES ('Enology 1', 'EN1', 2);
INSERT INTO UC (name, code, course) VALUES ('Ornitology', 'ORN', 2);
INSERT INTO UC (name, code, course) VALUES ('Enology 2', 'EN2', 2);
INSERT INTO UC (name, code, course) VALUES ('Star Wars History 1', 'SWH1', 2);
INSERT INTO UC (name, code, course) VALUES ('Grape Appreciation', 'GRAP', 2);
INSERT INTO UC (name, code, course) VALUES ('Macarena and Ballroom Dances', 'MABD', 2);
INSERT INTO UC (name, code, course) VALUES ('Enology 3', 'EN3', 2);
INSERT INTO UC (name, code, course) VALUES ('Bakery', 'BAK', 2);
INSERT INTO UC (name, code, course) VALUES ('Slavic', 'SLV', 2);
INSERT INTO UC (name, code, course) VALUES ('Star Wars History 2', 'SWH2', 2);
INSERT INTO UC (name, code, course) VALUES ('Ornitology Applied to Bird Watching', 'OABW', 2);
INSERT INTO UC (name, code, course) VALUES ('Star Wars History Applied to Bird Watching', 'SWBW', 2);
INSERT INTO UC (name, code, course) VALUES ('Gaming 1', 'GAM1', 2);
INSERT INTO UC (name, code, course) VALUES ('Gaming 2', 'GAM2', 2);

INSERT INTO UC (name, code, course) VALUES ('Material Sciences', 'CMBI',1);
INSERT INTO UC (name, code, course) VALUES ('Cientific Programing', 'IPCOM', 1);
INSERT INTO UC (name, code, course) VALUES ('Celular Biology', 'BIOCEL', 1);
INSERT INTO UC (name, code, course) VALUES ('Organic Chemistry', 'QOBI', 1);
INSERT INTO UC (name, code, course) VALUES ('Fluid Mechanics', 'MFLU', 1);
INSERT INTO UC (name, code, course) VALUES ('Electromagnetism', 'ELEL', 1);
INSERT INTO UC (name, code, course) VALUES ('Microbiology', 'MGER', 1);
INSERT INTO UC (name, code, course) VALUES ('Signals and Electronics', 'SEL', 1);
INSERT INTO UC (name, code, course) VALUES ('Statistics', 'MNES', 1);
INSERT INTO UC (name, code, course) VALUES ('Molecular Biology', 'BIOMOL', 1);
INSERT INTO UC (name, code, course) VALUES ('Processing of Phisiological Signal', 'PSFI', 1);
INSERT INTO UC (name, code, course) VALUES ('Sensors and Actuators', 'SA', 1);
INSERT INTO UC (name, code, course) VALUES ('Anatomy', 'ANAT', 1);
INSERT INTO UC (name, code, course) VALUES ('Image Processing', 'AIBI', 1);
INSERT INTO UC (name, code, course) VALUES ('Information Systems Engeneering', 'ESIN', 1);
INSERT INTO UC (name, code, course) VALUES ('Computer Assisted Diagnosis', 'DACO', 1);


--passwords are 'password'
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Senhor Administrador', 'admin', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 12, 2, 2);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Jonas Carvalho', 'jonas', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 300, 2, 1);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Pedro Felix', 'furrix', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 1009965432, 1, 1);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Rocky Cebola', 'rocky', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 345678090, 1, 2);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Jack Douglass', 'jacksfilms', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 178901234, 1, 2);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('Charles Christopher White Jr.', 'penguinz0', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 2300901, 1, 1);
INSERT INTO Student (name, username, password_hash, creation_date, role_id, course_id) VALUES ('J. R. R. Tolkien', 'bilbobaggins', '$2y$10$M46ilCAqnBOGULh0V44B9.Qo3jcfFgoZVx6ccNTqyXKtVg.Oh5dwK', 876543210, 2, 2);


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

INSERT INTO Thread (title, creation_date, content, author, uc) VALUES ('Welcome to web-Jonas', 10, 'Our platform is built by students for students. We hope you will enjoy your study sessions here and that can help you with your academic endeavours.', 1, NULL);
INSERT INTO Thread (title, creation_date, content, author, uc) VALUES ('Help with field trip', 10500, 'I was interestedin goint to see the the metros. Anyone wants to join?', 2, 17);
INSERT INTO Thread (title, creation_date, content, author, uc) VALUES ('Where is the bathroom at FEUP?', 20320, NULL, 3, NULL);

INSERT INTO Reply (content, creation_date, author, thread) VALUES ('No thanks uwu', 1, 3, 2);
INSERT INTO Reply (content, creation_date, author, thread) VALUES ('I would also like to know.', 50020, 2, 3);
INSERT INTO Reply (content, creation_date, author, thread) VALUES ('First door on the left.', 60000, 1, 3);


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

CREATE TABLE Doctor
(
  Doctor_ID INT NOT NULL,
  specialization VARCHAR(50) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (Doctor_ID)
);

CREATE TABLE Nurse
(
  Nurse_ID INT NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (Nurse_ID)
);

CREATE TABLE Ward_Boy
(
  Ward_Boy_ID INT NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (Ward_Boy_ID)
);

CREATE TABLE Medicine
(
  Medicine_ID INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  quantity INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  PRIMARY KEY (Medicine_ID)
);

CREATE TABLE Payment
(
  status VARCHAR(20) NOT NULL,
  Payment_ID INT NOT NULL,
  type VARCHAR(20) NOT NULL,
  PRIMARY KEY (Payment_ID)
);


CREATE TABLE Room
(
  Room_type VARCHAR(50) NOT NULL,
  Room_number INT NOT NULL,
  Nurse_ID INT NOT NULL,
  Ward_Boy_ID INT NOT NULL,
  PRIMARY KEY (Room_number),
  FOREIGN KEY (Nurse_ID) REFERENCES Nurse(Nurse_ID),
  FOREIGN KEY (Ward_Boy_ID) REFERENCES Ward_Boy(Ward_Boy_ID)
);

CREATE TABLE Patient
(
  Patient_ID INT NOT NULL AUTO_INCREMENT,
  last_name VARCHAR(50) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  gender VARCHAR(10) NOT NULL,
  age INT NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  disease VARCHAR(100) NULL,
  Doctor_ID INT NULL,
  Medicine_ID INT NULL,
  Room_number INT NULL,
  PRIMARY KEY (Patient_ID),
  FOREIGN KEY (Doctor_ID) REFERENCES Doctor(Doctor_ID),
  FOREIGN KEY (Medicine_ID) REFERENCES Medicine(Medicine_ID),
  FOREIGN KEY (Room_number) REFERENCES Room(Room_number)
);

CREATE TABLE Bill
(
  Bill_ID INT NOT NULL AUTO_INCREMENT,
  Room_Charges DECIMAL(10, 2) NOT NULL,
  Medicine_Charges DECIMAL(10, 2) NOT NULL,
  Doc_Charges DECIMAL(10, 2) NOT NULL,
  Patient_ID INT NOT NULL,
  PRIMARY KEY (Bill_ID),
  FOREIGN KEY (Patient_ID) REFERENCES Patient(Patient_ID),
);

ALTER TABLE room
ADD COLUMN able INT DEFAULT 0;

ALTER TABLE `bill` ADD COLUMN `payed` INT NOT NULL DEFAULT 0;

//////////////////////////////////////////////////////////////

INSERT INTO Doctor (Doctor_ID, specialization, first_name, last_name) 
VALUES
  (1, 'Cardiology', 'John', 'Doe'),
  (2, 'Pediatrics', 'Jane', 'Smith'),
  (3, 'Cardiology', 'Michael', 'Johnson'),
  (4, 'Dermatology', 'Emily', 'Brown'),
  (5, 'Pediatrics', 'David', 'Wilson'),
  (6, 'Cardiology', 'Sarah', 'Anderson'),
  (7, 'Dermatology', 'Jessica', 'Taylor'),
  (8, 'Pediatrics', 'Daniel', 'Martinez'),
  (9, 'Cardiology', 'Laura', 'Hernandez'),
  (10, 'Dermatology', 'Matthew', 'Garcia'),
  (11, 'Pediatrics', 'Jennifer', 'Lopez'),
  (12, 'Cardiology', 'Christopher', 'Lee'),
  (13, 'Dermatology', 'Ashley', 'Clark'),
  (14, 'Pediatrics', 'Andrew', 'Lewis'),
  (15, 'Cardiology', 'Lauren', 'Young'),
  (16, 'Dermatology', 'Ryan', 'Walker'),
  (17, 'Pediatrics', 'Stephanie', 'Turner'),
  (18, 'Cardiology', 'William', 'Adams'),
  (19, 'Dermatology', 'Megan', 'Morris'),
  (20, 'Pediatrics', 'Brandon', 'Wright');

  INSERT INTO Nurse (Nurse_ID, first_name, last_name) 
VALUES
  (1, 'Emma', 'Johnson'),
  (2, 'Oliver', 'Smith'),
  (3, 'Sophia', 'Brown'),
  (4, 'Noah', 'Davis'),
  (5, 'Isabella', 'Wilson'),
  (6, 'Liam', 'Anderson'),
  (7, 'Mia', 'Taylor'),
  (8, 'James', 'Martinez'),
  (9, 'Ava', 'Hernandez'),
  (10, 'Lucas', 'Garcia'),
  (11, 'Charlotte', 'Lopez'),
  (12, 'Alexander', 'Lee'),
  (13, 'Amelia', 'Clark'),
  (14, 'Benjamin', 'Lewis'),
  (15, 'Harper', 'Young'),
  (16, 'Henry', 'Walker'),
  (17, 'Evelyn', 'Turner'),
  (18, 'Michael', 'Adams'),
  (19, 'Abigail', 'Morris'),
  (20, 'Daniel', 'Wright');

  INSERT INTO Ward_Boy (Ward_Boy_ID, first_name, last_name) 
VALUES
  (1, 'Ethan', 'Johnson'),
  (2, 'Lily', 'Smith'),
  (3, 'Logan', 'Brown'),
  (4, 'Grace', 'Davis'),
  (5, 'Samuel', 'Wilson'),
  (6, 'Chloe', 'Anderson'),
  (7, 'Carter', 'Taylor'),
  (8, 'Scarlett', 'Martinez'),
  (9, 'Jackson', 'Hernandez'),
  (10, 'Zoe', 'Garcia'),
  (11, 'Sebastian', 'Lopez'),
  (12, 'Penelope', 'Lee'),
  (13, 'Levi', 'Clark'),
  (14, 'Victoria', 'Lewis'),
  (15, 'Mateo', 'Young'),
  (16, 'Avery', 'Walker'),
  (17, 'Emily', 'Turner'),
  (18, 'Wyatt', 'Adams'),
  (19, 'Nora', 'Morris'),
  (20, 'Gabriel', 'Wright'),
  (21, 'Hannah', 'Johnson'),
  (22, 'Matthew', 'Smith'),
  (23, 'David', 'Brown'),
  (24, 'Addison', 'Davis'),
  (25, 'Owen', 'Wilson'),
  (26, 'Aria', 'Anderson'),
  (27, 'Elijah', 'Taylor'),
  (28, 'Elizabeth', 'Martinez'),
  (29, 'Landon', 'Hernandez'),
  (30, 'Audrey', 'Garcia');

  INSERT INTO Room (Room_type, Room_number, Nurse_ID, Ward_Boy_ID) 
VALUES
  ('defualt', '0','19','24'),
  ('Private', 101, 1, 1),
  ('Private', 102, 2, 2),
  ('Private', 103, 3, 3),
  ('Private', 104, 4, 4),
  ('Private', 105, 5, 5),
  ('Private', 106, 6, 6),
  ('Private', 107, 7, 7),
  ('Private', 108, 8, 8),
  ('Private', 109, 9, 9),
  ('Private', 110, 10, 10),
  ('Shared', 201, 11, 11),
  ('Shared', 202, 12, 12),
  ('Shared', 203, 13, 13),
  ('Shared', 204, 14, 14),
  ('Shared', 205, 15, 15),
  ('Shared', 206, 16, 16),
  ('Shared', 207, 17, 17),
  ('Shared', 208, 18, 18),
  ('Shared', 209, 19, 19),
  ('Shared', 210, 15, 20),
  ('General', 301, 11, 21),
  ('General', 302, 12, 22),
  ('General', 303, 13, 23),
  ('General', 304, 2, 24),
  ('General', 305, 2, 25),
  ('General', 306, 6, 26),
  ('General', 307, 17, 27),
  ('General', 308, 2, 28),
  ('General', 309, 9, 29),
  ('General', 310, 3, 30),
  ('Emergency', 401, 1, 1),
  ('Emergency', 402, 2, 22),
  ('Emergency', 403, 3, 3),
  ('Emergency', 404, 4, 14),
  ('Emergency', 405, 5, 15),
  ('Emergency', 406, 6, 26),
  ('Emergency', 407, 7, 27),
  ('Emergency', 408, 8, 18),
  ('Emergency', 409, 9, 29),
  ('Emergency', 410, 10, 10);


  INSERT INTO Medicine (Medicine_ID, price, quantity, name)
VALUES
	(0, 0.0, 0, 'defualt'),
    (1, 10.50, 20, 'Medicine_1'),
    (2, 20.75, 15, 'Medicine_2'),
    (3, 15.99, 50, 'Medicine_3'),
    (4, 7.25, 10, 'Medicine_4'),
    (5, 12.99, 30, 'Medicine_5'),
    (6, 9.50, 25, 'Medicine_6'),
    (7, 18.75, 18, 'Medicine_7'),
    (8, 13.49, 40, 'Medicine_8'),
    (9, 6.99, 12, 'Medicine_9'),
    (10, 11.50, 35, 'Medicine_10'),
    (11, 14.75, 22, 'Medicine_11'),
    (12, 8.99, 45, 'Medicine_12'),
    (13, 5.50, 8, 'Medicine_13'),
    (14, 16.75, 17, 'Medicine_14'),
    (15, 19.99, 55, 'Medicine_15'),
    (16, 4.25, 9, 'Medicine_16'),
    (17, 9.99, 32, 'Medicine_17'),
    (18, 13.50, 27, 'Medicine_18'),
    (19, 15.75, 20, 'Medicine_19'),
    (20, 17.99, 60, 'Medicine_20'),
    (21, 3.50, 7, 'Medicine_21'),
    (22, 10.75, 25, 'Medicine_22'),
    (23, 5.99, 13, 'Medicine_23'),
    (24, 8.25, 38, 'Medicine_24'),
    (25, 11.50, 33, 'Medicine_25'),
    (26, 6.75, 28, 'Medicine_26'),
    (27, 9.99, 23, 'Medicine_27'),
    (28, 15.50, 50, 'Medicine_28'),
    (29, 14.75, 37, 'Medicine_29'),
    (30, 18.99, 15, 'Medicine_30'),
    (31, 16.25, 42, 'Medicine_31'),
    (32, 7.99, 19, 'Medicine_32'),
    (33, 5.50, 24, 'Medicine_33'),
    (34, 12.75, 31, 'Medicine_34'),
    (35, 10.99, 44, 'Medicine_35'),
    (36, 9.50, 29, 'Medicine_36'),
    (37, 8.75, 36, 'Medicine_37'),
    (38, 6.99, 21, 'Medicine_38'),
    (39, 11.25, 58, 'Medicine_39'),
    (40, 13.99, 26, 'Medicine_40'),
    (41, 4.50, 16, 'Medicine_41'),
    (42, 17.75, 43, 'Medicine_42'),
    (43, 13.99, 35, 'Medicine_43'),
    (44, 6.50, 30, 'Medicine_44'),
    (45, 8.75, 27, 'Medicine_45'),
    (46, 11.99, 54, 'Medicine_46'),
    (47, 9.25, 41, 'Medicine_47'),
    (48, 5.99, 46, 'Medicine_48'),
    (49, 7.50, 33, 'Medicine_49'),
    (50, 14.75, 20, 'Medicine_50');
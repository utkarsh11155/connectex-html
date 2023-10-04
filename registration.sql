CREATE TABLE registration (
  firstName VARCHAR(50) NOT NULL,
  lastName VARCHAR(50) NOT NULL,
  gender ENUM('m','f') NOT NULL,
  email VARCHAR(100) NOT NULL,
  branch VARCHAR(50) NOT NULL,
  number VARCHAR(10) NOT NULL Primary Key,
  passingyear YEAR(4) NOT NULL,
  company VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  photo LONGBLOB NOT NULL
);

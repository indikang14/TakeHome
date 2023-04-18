CREATE database IF NOT EXISTS TakeHome;
Create table IF NOT EXISTS TakeHome.Employees (
                    id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                    firstname VARCHAR(50) NOT NULL,
                    lastname VARCHAR(50) NOT NULL,
                    salary INT(8) SIGNED NOT NULL);
                    
INSERT INTO 
TakeHome.Employees (firstname, lastname, salary) 
values
("Lewis", "Burson", 99000),
("Ian","Malcolm", 65000),
("Ellie","Sattler", 80000 ),
("Dennis","Nedry", 50000);
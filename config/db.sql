DROP DATABASE IF EXISTS nfq_tomas_mikus;
CREATE DATABASE nfq_tomas_mikus;
USE nfq_tomas_mikus;

-- -------------------------------
-- Table structure for projects
-- -------------------------------
CREATE TABLE IF NOT EXISTS projects  (
     id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
     title VARCHAR(64) NOT NULL,
     num_groups INT(3) NOT NULL,
     students_per_group INT(3) NOT NULL,
     PRIMARY KEY (id)
);

-- -------------------------------
-- Table structure for student_groups
-- -------------------------------
CREATE TABLE IF NOT EXISTS student_groups (
      project_id INT(11) UNSIGNED NOT NULL,
      group_number INT(11) UNSIGNED NOT NULL,
      PRIMARY KEY (project_id, group_number),
      FOREIGN KEY (project_id) REFERENCES projects(id)
);

-- -------------------------------
-- Table structure for students
-- -------------------------------
CREATE TABLE IF NOT EXISTS students  (
     id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
     firstname VARCHAR(32) NOT NULL,
     lastname VARCHAR(32) NOT NULL,
     project_id INT(11) UNSIGNED,
     group_number INT(11) UNSIGNED,
     PRIMARY KEY (id),
     FOREIGN KEY (project_id, group_number) REFERENCES student_groups(project_id, group_number),
     UNIQUE (firstname, lastname)
);


INSERT INTO projects (id, title, num_groups, students_per_group)
VALUES (1, 'Winter Photoshoot', 5, 2);

INSERT INTO student_groups (project_id, group_number)
VALUES (1, 1),
       (1, 2),
       (1, 3),
       (1, 4),
       (1, 5);

INSERT INTO students (firstname, lastname, project_id, group_number)
VALUES ('Ada', 'Lovelace', 1, 2),
       ('Grace', 'Hopper', 1, 1),
       ('Margaret', 'Hamilton', 1, null),
       ('Joan', 'Clarke', 1, 2);

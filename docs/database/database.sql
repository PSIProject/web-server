CREATE DATABASE team_tasks;
USE team_tasks;

CREATE TABLE collaborator (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nick NVARCHAR (25) NOT NULL,
    email NVARCHAR (30) NOT NULL,
    name NVARCHAR (25) NOT NULL,
    last_name NVARCHAR (15) NOT NULL,
    password NVARCHAR (64) NOT NULL
);

CREATE TABLE team (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name NVARCHAR (50) NOT NULL,
    manager_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (manager_id) REFERENCES collaborator (id)
);

CREATE TABLE collaborate (
    collaborator_id INT UNSIGNED NOT NULL,
    team_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (collaborator_id) REFERENCES collaborator (id),
    FOREIGN KEY (team_id) REFERENCES team (id)
);

CREATE TABLE goal (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name NVARCHAR (50) NOT NULL,
    team_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (team_id) REFERENCES team (id)
);

CREATE TABLE task (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name NVARCHAR (50) NOT NULL,
    description NVARCHAR (100) NOT NULL,
    init_date DATE NOT NULL,
    finish_date DATE NOT NULL,
    state TINYINT UNSIGNED NOT NULL,
    goal_id INT UNSIGNED NOT NULL,
    delivery_description NVARCHAR (100) NOT NULL,
    delivery NVARCHAR (50) NULL,
    FOREIGN KEY (goal_id) REFERENCES goal (id)
);

CREATE TABLE comment (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    message NVARCHAR (1000) NOT NULL,
    collaborator_id INT UNSIGNED NOT NULL,
    task_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (collaborator_id) REFERENCES collaborator (id),
    FOREIGN KEY (task_id) REFERENCES task (id)
);

CREATE TABLE assigned_to (
    collaborator_id INT UNSIGNED NOT NULL,
    task_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (collaborator_id) REFERENCES collaborator (id),
    FOREIGN KEY (task_id) REFERENCES task (id)
);

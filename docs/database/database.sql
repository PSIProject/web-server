CREATE DATABASE team_tasks;
USE team_tasks;

CREATE TABLE user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nick NVARCHAR (25) NOT NULL,
    email NVARCHAR (30) NOT NULL,
    name NVARCHAR (15) NOT NULL,
    last_name NVARCHAR (15) NOT NULL,
    password NVARCHAR (64) NOT NULL
);

CREATE TABLE group (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name NVARCHAR (50) NOT NULL
);

CREATE TABLE manager (
    user_id INT UNSIGNED NOT NULL,
    group_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (group_id) REFERENCES group (id)
);

CREATE TABLE collaborator (
    user_id INT UNSIGNED NOT NULL,
    group_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (group_id) REFERENCES group (id)
);

CREATE TABLE goal (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name NVARCHAR (50) NOT NULL,
    group_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (group_id) REFERENCES group (id)
);

CREATE TABLE activity (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name NVARCHAR (50) NOT NULL,
    description NVARCHAR (100) NOT NULL,
    init_date DATE NOT NULL,
    finish_date DATE NOT NULL,
    state TINYINT UNSIGNED NOT NULL,
    delivery_description NVARCHAR (100) NOT NULL,
    delivery NVARCHAR (50) NOT NULL,
    group_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (group_id) REFERENCES group (id),=
);

CREATE TABLE comment (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    message NVARCHAR (1000) NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    activity_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (activity_id) REFERENCES activity (id)
);

CREATE TABLE assigned_to (
    user_id INT UNSIGNED NOT NULL,
    activity_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (activity_id) REFERENCES activity (id)
);

CREATE DATABASE IF NOT EXISTS TastyRecipes;
USE TastyRecipes;

CREATE TABLE IF NOT EXISTS users (
  user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS recipes (
  recipe_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
);

CREATE TABLE IF NOT EXISTS comments (
  comment_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  recipe_id INT,
  comment VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id)
);

INSERT INTO recipes(recipe_id) VALUES (NULL), (NULL);

INSERT INTO comments(user_id, recipe_id, comment) VALUES (1, 1, 'Hello'), (1, 2, 'What is this?')
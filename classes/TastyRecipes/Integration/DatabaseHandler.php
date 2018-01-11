<?php

namespace TastyRecipes\Integration;

use TastyRecipes\Model\Comment;
use TastyRecipes\Util\Constants;

class DatabaseHandler {
    private $con;

    public function __construct() {}

    public function connect() {
        $this->con = mysqli_connect(Constants::DB_HOST, Constants::DB_USER, Constants::DB_PASSWORD, Constants::DB_NAME);
        if($this->con === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    }

    public function addUser($username, $password) {
        $this->connect();
        $sql = "SELECT user_id FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($this->con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $paramUsername);
            $paramUsername = trim($username);
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1) {
                    return false;
                } else {
                    $username = trim($username);
                }
            }

            mysqli_stmt_close($stmt);
        }

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if($stmt = mysqli_prepare($this->con, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $paramUsername, $paramPassword);
            $paramUsername = $username;
            $paramPassword = password_hash($password, PASSWORD_DEFAULT);
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($this->con);

                return true;
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($this->con);

        return false;
    }

    public function getUser($username, $password) {
        $this->connect();
        $sql = "SELECT username, password FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($this->con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $paramUsername);
            $paramUsername = $username;
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $username, $hashedPassword);
                    if(mysqli_stmt_fetch($stmt)) {
                        if(password_verify($password, $hashedPassword)) {
                            return $username;

                        } else {
                            return false;
                        }
                    }

                } else {
                    return false;
                }
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($this->con);

        return false;
    }

    public function getComments($recipe) {
        $this->connect();
        $sql = "SELECT comment_id, username, comment FROM comments JOIN users ON comments.user_id = users.user_id
            WHERE recipe_id = ? ORDER BY comment_id";

        $comments = array();

        if($stmt = mysqli_prepare($this->con, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $paramRecipe);
            $paramRecipe = $recipe;
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    $comments[] = new Comment($row['comment_id'], $row['username'], $recipe, $row['comment']);
                }

            } else {
                return false;
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($this->con);

        if(empty($comments)) {
            return false;
        } else {
            return $comments;
        }
    }

    public function addComment($recipe_id, $username, $comment) {
        $this->connect();
        $sql = "SELECT user_id FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($this->con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $paramUsername);
            $paramUsername = $username;
            if(mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $user_id = $row['user_id'];

            } else {
                return false;
            }

            mysqli_stmt_close($stmt);
        }

        if(empty($user_id)) {
            return false;
        }

        $sql = "INSERT INTO comments (user_id, recipe_id, comment) VALUES (?, ?, ?)";
        if($stmt = mysqli_prepare($this->con, $sql)) {
            mysqli_stmt_bind_param($stmt, "iis", $param_user_id, $param_recipe_id, $param_comment);
            $param_user_id = $user_id;
            $param_recipe_id = $recipe_id;
            $param_comment = $comment;
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($this->con);

                return true;
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($this->con);

        return false;
    }

    public function deleteComment($comment_id) {
        $this->connect();
        $sql = "DELETE FROM comments WHERE comment_id = ?";
        if($stmt = mysqli_prepare($this->con, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_comment_id);
            $param_comment_id = $comment_id;
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($this->con);
                return true;
            } else {
                mysqli_stmt_close($stmt);
                mysqli_close($this->con);
                return false;
            }

        } else {
            return false;
        }
    }
}
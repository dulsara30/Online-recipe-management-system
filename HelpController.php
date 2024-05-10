<?php require('connection.php'); ?>

<?php

class HelpController
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAllFAQ()
    {
        $query = "SELECT * FROM frequently_asked_questions";
        $result = $this->connection->query($query);
        return $result;
    }

    public function isUser($email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM regictered_user WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->num_rows > 0;
    }

    public function createUser($name, $email)
    {
        $stmt = $this->connection->prepare("INSERT INTO regictered_user (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function createQuestion($question, $userId)
    {
        $stmt = $this->connection->prepare("INSERT INTO message (message, user_id) VALUES (?, ?)");
        $stmt->bind_param("si", $question, $userId);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function getUserId($email)
    {
        $stmt = $this->connection->prepare("SELECT id FROM regictered_user WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ? $row["id"] : -1;
    }

    public function getUserMessages($userId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM message WHERE user_id=?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function deleteQuestion($questionId)
    {
        $stmt = $this->connection->prepare("DELETE FROM message WHERE id=?");
        $stmt->bind_param("i", $questionId);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function updateQuestion($questionId, $updatedQuestion)
    {
        $stmt = $this->connection->prepare("UPDATE message SET message=? WHERE id=?");
        $stmt->bind_param("si", $updatedQuestion, $questionId);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}

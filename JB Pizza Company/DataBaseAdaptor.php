<?php

class DatabaseAdaptor
{

    private $DB;

    public function __construct()
    {
        $db = 'mysql:dbname=JBpizza;host=127.0.0.1;charset=utf8';
        $user = 'root';
        $password = '';
        
        try {
            $this->DB = new PDO($db, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo ('Error establishing Connection');
            exit();
        }
    }

    // TODO
    public function getItems()
    {
        $stmt = $this->DB->prepare("SELECT ID FROM items;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkUser($username)
    {
        $stmt = $this->DB->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam('username', $username);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return is_null($info[0]);
    }

    public function verifyUser($username, $pwd)
    {
        $stmt = $this->DB->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam('username', $username);
        $stmt->execute();
        $hash = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return password_verify($pwd, $hash[0]['password']);
    }

    public function register($username, $pwd)
    {
        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt = $this->DB->prepare("SELECT COUNT(ID) FROM users");
        $stmt->execute();
        $customID = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($customID);
        $stmt = $this->DB->prepare("INSERT INTO users (ID, username, password, CH, PP, SG, HA, CB) VALUES (:x, :y, :z, 0, 0, 0, 0, 0)");
        $stmt->bindParam(x, $customID[0]['COUNT(ID)']);
        $stmt->bindParam(y, $username);
        $stmt->bindParam(z, $hashed_pwd);
        $stmt->execute();
    }

    // TODO
    public function addToCart($userID, $itemID, $qty)
    {
        $trueID;
        if ($itemID == 0) {
            $trueID = 'CH';
        } else if ($itemID == 1) {
            $trueID = 'PP';
        } else if ($itemID == 2) {
            $trueID = 'SG';
        } else if ($itemID == 3) {
            $trueID = 'HA';
        } else {
            $trueID = 'CB';
        }
        $stmt = $this->DB->prepare("UPDATE users SET " . $trueID . " = " . $trueID . " + " . $qty . " WHERE username = '" . $userID . "'");
        $stmt->execute();
    }

    // TODO
    public function emptyCart($id)
    {
        $stmt = $this->DB->prepare("UPDATE users SET CH = 0, PP = 0, SG = 0, HA = 0, CB = 0 WHERE ID = ?");
        $stmt->bindParam("s", $id);
        $stmt->execute();
    }
    
    public function getReviews()
    {
    	$stmt = $this->DB->prepare( "SELECT reviews FROM items" );
    	$stmt->execute();
    	return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
}

$theDBA = new DatabaseAdaptor();
?>
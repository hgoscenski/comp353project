<?php
include_once 'db.inc.php';
/**
 * Created by PhpStorm.
 * User: hgoscenski
 * Date: 4/5/17
 * Time: 19:45
 */
if(isset($_GET['password'])){
    try{
        echo $_GET['userid'];

        $sql = 'INSERT INTO loginuser SET 
            EmailAddress = :email,
            SaltedPassword = :password,
            UserID = :userid';

        $s = $GLOBALS['pdo']->prepare($sql);

        $s->bindValue(':email', $_GET['email']);
        $s->bindValue(':password', password_hash($_GET['password'], PASSWORD_DEFAULT));
        $s->bindValue(':userid', $_GET['userid']);

        $s->execute();

        echo "Password set!";

//        echo password_hash($_GET['password'], PASSWORD_DEFAULT)."\n";
    } catch (PDOException $e){

    }
}
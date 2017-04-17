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

        $sql = 'UPDATE user SET 
            PasswordHash = :password
            WHERE UserID = :userid';

        $s = $GLOBALS['pdo']->prepare($sql);

        $s->bindValue(':password', password_hash($_GET['password'], PASSWORD_DEFAULT));
        $s->bindValue(':userid', $_GET['userid']);

        $s->execute();

        echo "Password set!";
        include 'userLogin.php';

//        echo password_hash($_GET['password'], PASSWORD_DEFAULT)."\n";
    } catch (PDOException $e){

    }
}
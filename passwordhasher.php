<?php 
if(isset($_POST['hash'])){
    $hashed = password_hash($_POST['hash'], PASSWORD_DEFAULT);
    echo $hashed;
}


?>
<form action="passwordhasher.php" method="post">
    <label for="hash">Soon to be hashed <input type="text" name="hash" id="hash" required></label>
</form>

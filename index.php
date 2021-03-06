<?php
// Inkluderar klassen
include_once("class-users.php");

$users = new Users();

// Om man klickar på registrera knappen
if (isset($_POST['addUser'])) {
  $userName = $_POST['userName'];
  $userPassword = $_POST['userPassword'];

  $passLenght = strlen($userPassword);

  // Gör en koll så att Användarnamn och lösenord inte är tomt och tillräckligt långt
  if ($userName != '' && $userPassword != '' && $passLenght > 5) {
    //Salt
    $hashedPass = password_hash($userPassword, PASSWORD_DEFAULT);

    $users->addUser($userName, $hashedPass);
  }
  elseif ($passLenght < 5 && $passLenght > 0) {
    echo '<p class="message red">För kort lösenord</p>';
  }
  else {
    echo '<p class="message red">Användarnamn och lösenord får inte vara tomt</p>';
  }

}

// Om man klickar på logga in
if (isset($_POST['login'])) {
  $userName = $_POST['userName'];
  $userPassword = $_POST['userPassword'];

  $users->login($userName, $userPassword);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Labb 2 Jonatan</title>
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <main>
      <h1>Logga in</h1>
      <p style="color: silver;">Lösenordet måste vara minst 5 tecken</p>
      <form class="" action="index.php" method="post">
        <label for="userName">Användarnamn</label>
        <input style="margin-bottom: 10px;" type="text" name="userName" value="">
        <br>
        <label for="userPassword">Lösenord</label>
        <input type="password" name="userPassword" value="">
        <br>
        <input class="button" type="submit" name="addUser" value="Registrera">
        <input class="button" type="submit" name="login" value="Logga in">
      </form>
    </main>
  </body>
</html>

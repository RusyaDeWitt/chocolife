<!DOCTYPE hmtl>
<html>
  <head>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <?php 
      session_start();
      require_once("../connection.php");
      if(isset($_POST["login"])){

        if(!empty($_POST['phone']) && !empty($_POST['password'])) {
            $phone=htmlspecialchars($_POST['phone']);
            $password=htmlspecialchars($_POST['password']);
            $query =mysqli_query($con,"SELECT * FROM users WHERE phone_number='".$phone."' AND password='".$password."'");
            $numrows=mysqli_num_rows($query);
            if($numrows!=0){
                while($row=mysqli_fetch_assoc($query)){
                    $dbphone=$row['phone_number'];
                    $dbpassword=$row['password'];
                }
                if($phone == $dbphone && $password == $dbpassword){
                    $_SESSION['session_phone']=$phone;
                    header("Location: ../Home/home.php");
                    die();
                }
        }
      }
    }
    ?>
    <div class="login">
      <img src="../images/chocolife_logo.svg" height="54px" id="logo"/>
      <form class="login__form" method="post" >
        <h1 id="login__form__label">Авторизация</h1>
        <input class="login__form__input" name="phone" placeholder="+ 7 (__) __-__-__" />
        <input class="login__form__input" name="password" placeholder="Введите пароль" />
        <button class="login__form__button-submit" type="submit" name="login">Войти</button>
      </form>
    </div>
  </body>
</html>
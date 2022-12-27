<!DOCTYPE hmtl>
<html>
  <head>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <?php require_once("../connection.php"); ?>
    <?php
        if(isset($_POST["register"])){
            if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['password'])){
                $full_name= htmlspecialchars($_POST['full_name']);
                $email=htmlspecialchars($_POST['email']);
                $phone=htmlspecialchars($_POST['phone']);
                $password=htmlspecialchars($_POST['password']);
                $query=mysqli_query($con,"SELECT * FROM users WHERE phone_number='".$phone."'");
                $numrows=mysqli_num_rows($query);
                if($numrows==0){
                    $sql="INSERT INTO users (full_name, email, phone_number, password)
                        VALUES('$full_name','$email', '$phone', '$password')";
                    $result=mysqli_query($con,$sql);
                    if($result){
                        header("Location: login.php");
                    }else{
                        $message=1;//Ошибка
                    }
                }else{
                    $message=2;//Это имя уже существует
                }
            }else{
                $message=3;//Заполните все поля
            }
        }
	?>
    <div class="login">
      <img src="../images/chocolife_logo.svg" height="54px" id="logo"/>
      <form class="login__form" method="post" name="registerform">
        <h1 id="login__form__label">Регистрация</h1>
        <input class="login__form__input" name="phone" placeholder="+ 7 (__) __-__-__" />
        <input class="login__form__input" name="full_name" placeholder="Введите имя" />
        <input class="login__form__input" name="email" placeholder="Введите почту" />
        <input class="login__form__input" name="password" placeholder="Введите пароль" />
        <button class="login__form__button-submit" type="submit" name="register">Зарегистрироваться</button>
      </form>
    </div>
  </body>
</html>
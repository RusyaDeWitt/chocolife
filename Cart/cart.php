<!DOCTYPE !html>
<html>
  <head>
    <link rel="stylesheet" href="style.css"  type="text/css" />
  </head>
  <body>
    <?php 
        require_once("../connection.php");
        session_start();
        $sum = 0;

        if(isset($_POST["delete"])){
          $id=htmlspecialchars($_POST['id']);
          $phone = $_SESSION["session_phone"];
          $sql="DELETE FROM users_cart WHERE certificate_id = '".$id."' AND user_id='".$phone."' ";
          $result=mysqli_query($con,$sql);
        }
    ?>
  <header>
      <div class="header">
        <div class="menu">
          <img src="../images/chocolife_logo.svg" id="logo"/>
          <div class="menu__location">
            <img src="../images/map_point.png" width="20px" height="20px"/>
            <h2 id="menu__city">Алматы</h2>
          </div>
          <div class="menu__search">
            <input class="menu__search__input" placeholder="Я ищу..." />
            <button class="menu__search__button">Найти</button>
          </div>
          <div class="menu__login">
          <?php 
              if(isset($_SESSION["session_phone"])){
                 echo "
                 <div class='dropdown'>
                  <button class='dropbtn'>Мой профиль</button>
                  <div class='dropdown-content'>
                    <a href='#'>Мои данные</a>
                    <a href='../Purchased/purchased.php'>Мои покупки</a>
                    <form method='post' action='../Login/logout.php'>
                      <button type='submit' style='background-color: transparent; border: none;'><a>Выйти</a></button>
                    </form>
                  </div>
                 </div>
                 "; 
                 echo "
                 <div class='menu__basket'>
                    <img id='bookmark__img' src='../images/bookmark.png'/>
                      <button class='menu__basket__button'>
                        <a id='menu__city' href='../Cart/cart.php'>
                          Избранное
                        </a>
                      </button>
                  </div>"; 
              } else {
                 echo '<a class="menu__login__button" href="../Login/login.php">Войти</a>
                <a id="menu__login__signup"  href="../Login/register.php">Создать аккаунт</a>';
              }
            
            ?>
          </div>
          <div class="menu__basket">
            <img src="../images/shopping_cart.png"/>
            <button class="menu__basket__button">
              <h2 id="menu__city">
               Корзина
             </h2>
          </button>
          </div>
        </div>
        <div class="categories">

        </div>
      </div>
    </header>
    <div class="main">
      <div class="main__header">
        <h3>Покупка дисконта</h3>
      </div>
      <div class="main__body">
        <div class="main__left">
          <div class="main__item">
            <?php
              if(isset($_SESSION["session_phone"])){
                $phone = $_SESSION["session_phone"];
                $existCartQuery = mysqli_query($con, "SELECT certificate_id FROM users_cart WHERE user_id='".$phone."' ");
                $existCart = mysqli_fetch_all($existCartQuery ,MYSQLI_ASSOC);
                $temp =  array();
                foreach($existCart as $item){
                  array_push($temp, $item["certificate_id"]);
                }
                $certificateQuery = mysqli_query($con, "SELECT * FROM certificates WHERE id in ('" 
                . implode("','", array_map('intval', $temp)) 
                . "') ");
                $certificates = mysqli_fetch_all($certificateQuery ,MYSQLI_ASSOC);

                if(count($existCart) > 0){
                  foreach($certificates as $item){
                    $sum += $item["price"];
                    echo '
                      <div class="main__item__card">
                        <div class="main__item__card__title">
                          <h3></h3>
                        </div>
                        <div class="main__item__quantity">
                          <h5 id="item__name">'.$item["name"].'</h5>
                          <h5>'.$item["price"].' ₸</h5>
                          <div class="amount">
                            <div id="round">-</div>
                            <p> 1 </p>
                            <div id="round">+</div>
                          </div>
                          <h5>'.$item["price"].' ₸</h5>
                          <form method="post">
                            <input style="display: none" name="id" value='.$item["id"].' />
                            <button type="submit" name="delete" id="delete__button">
                              <img src="../images/bin.png" />
                            </button>
                          </form>
                        </div>
                      </div>
                    ';
                  }
                }else{
                  echo '
                  <div class="cart">
                    <div class="cart__content">
                      <h5>Корзина пуста ...</h5>
                    </div>
                  </div>';
                }
              };
            ?>
          </div>
          <div class="main__option">
          <div class="main__option__title">
            <h3>ВЫБОР СПОСОБА ОПЛАТЫ</h3>
          </div>
          <div class="main__option__items">
            <div class="main__option__item">
              <img src="../images/credit-card.png" />
              <h4>Банковской картой</h4>
              <h6>Visa, MasterCard</h6>
            </div>
          </div>
        </div>
        </div>
        <div class="main__right">
        <div class="main__payment">
          <div class="main__option__title">
            <h5>СПИСАНИЕ СРЕДСТВ</h5>
          </div>
          <div class="main__payment__title">
            <h5>С банковской карты</h5>
            <h5><?php 
                echo ''.$sum.'₸';
            ?></h5>
          </div>
          <div class="main__payment__title">
            <h5>Сумма к оплате</h5>
            <h5><?php 
                echo ''.$sum.'₸';
            ?></h5>
          </div>
          <a href="../Payment/payment.php">
            <button class="main__payment__submit">Оплатить</button>
          </a>
        </div>
      </div>
    </div>
  </body>
</html>
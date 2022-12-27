<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css"  type="text/css" />
  </head>
  <body>
    <?php 
      session_start();
      require_once("../connection.php");
      $id = $_GET['id'];

      $detailQuery = mysqli_query($con, "SELECT * FROM certificates WHERE id='".$id."' ");
      $items = mysqli_fetch_all($detailQuery ,MYSQLI_ASSOC);


    if(isset($_POST["add"])) {
        addToCart($items, $id, $con);
      }
      function addToCart($items, $id, $con) {
        $phone = $_SESSION["session_phone"];
        $existCartQuery = mysqli_query($con, "SELECT certificate_id FROM users_cart WHERE user_id='".$phone."' ");
        $existCart = mysqli_fetch_all($existCartQuery ,MYSQLI_ASSOC);
          if(in_array(array_values($items)[0]["id"], $existCart)){
            echo '<div>Уже есть в корзине</div>';
          }else{
            $sql="INSERT INTO users_cart (user_id, certificate_id)
            VALUES('$phone','$id')";
            $result=mysqli_query($con,$sql);
          };
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
                    <a href='#'>Мои покупки</a>
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
              <a id="menu__city" href="../Cart/cart.php">
                Корзина
             </a>
          </button>
          </div>
        </div>
        <div class="categories">
          <a>ВСЕ</a>
          <a href="../Home/home.php">НОВЫЕ</a>
          <a>КУПОНЫ СНОСО</a>
          <a href="../Categories/entertaiment.php">РАЗВЛЕЧЕНИЯ</a>
          <a>ЕДА</a>
          <a>ЗДОРОВЬЕ</a>
          <a>КРАСОТА</a>
          <a href="../Categories/sport.php">СПОРТ</a>
          <a>ТУРИЗМ, ОТЕЛИ</a>
          <a>УСЛУГИ</a>
          <a>ТОВАРЫ </a>
        </div>
      </div>
    </header>
    <div class="main__detail">
        <?php 
            foreach($items as $item){?>
                <?php 
                  echo '
                  <div class="main__detail__header">
                    <img src="data:image/jpeg;charset=utf8;base64, '.base64_encode($item["image"]).'" />
                    <div class="main__detail__header__info">
                      <h2>'.$item["name"].'</h2>
                      <p>'.$item["studio"].'</p>
                      <div class="main__detail__header__price">
                        <button class="tag__discount">
                          -'.$item["discount"].'%
                        </button>
                        <button class="tag__price">
                         От '.$item["price"].' Тг
                        </button>
                    </div>
                    <div>
                      <button class="tag__price" id="address">
                        '.$item["address"].'
                      </button>
                      <div style="display:flex; gap: 20px">
                      <a href="../Purchase/purchase.php?id='.$item["id"].'">
                        <button class="tag__discount" id="discount">
                          Купить
                       </button>
                      </a>
                      <form method="post">
                        <button class="tag__price" id="address" type="submit" name="add">
                            В корзину
                        </button>
                      </form>
                      </div>
                    </div>
                    </div>
                  </div>

                  <div class="main__detail__info">
                    <div class="main__detail__addinfo">
                      <h3>ВАЖНАЯ ИНФОРМАЦИЯ!</h3>
                      <ul>
                        <li>'.$item["addinfo"].'</li>
                      </ul>
                      <div id="googleMap" style="width:100%;height:400px;"></div>
                    </div>
                    <div class="main__detail__decription">
                      <h3>'.$item["name"].'</h3>
                      <ul>
                        <li>'.$item["description"].'</li>
                      </ul>
                    </div>
                  </div>
                '
                
                ?>     
            <?php
            };

          ?>
    </div>
    <footer class="footer">
    <div class="footer__upper">
          <div>
            <ul>
              <li><h5>КОМПАНИЯ</h5></li>
              <li>O Chocolife.me</li>
              <li>Пресса о нас</li>
              <li>Контакты</li>
            </ul>
          </div>
          <div>
            <ul>
              <li><h5>КЛИЕНТАМ</h5></li>
              <li>Обратная связь</li>
              <li>Вопросы и ответы</li>
              <li>Публичная оферта</li>
            </ul>
          </div>
          <div>
            <ul>
              <li><h5>ПАРТНЕРАМ</h5></li>
              <li>Для Вашего бизнеса</li>
            </ul>
          </div>
          <div>
            <ul>
              <li><h5>КОНТАКТЫ</h5></li>
              <li>+7 (771) 930-02-02</li>
              <li>+7 (727) 339-91-00</li>
            </ul>
            <div class="logos">
              <img src="../images/facebook.png"/>
              <img src="../images/instagram.png"/>
              <img src="../images/tik-tok.png"/>
              <img src="../images/youtube.png"/>
            </div>
          </div>
          <div>
            <ul>
              <li><h5>НАШЕ ПРИЛОЖЕНИЕ</h5></li>
              <li>Chocolife.me теперь еще удобнее и всегда под рукой!</li>
            </ul>
            <div class="appstores">
              <div class="appstores__upper">
                <img src="../images/googleplay.png"/>
                <img src="../images/appstore.png" width="153px" height="45px"/>
              </div>
              <img src="../images/appgallery.png"  width="153px" height="45px"/>
            </div>
          </div>
      </div>
      <div class="footer__down">
          <h5>Chocolife.me 2011-2022 · Карта сайта</h5>
          <img src="../images/depositphoto.svg" height="30px"/>
      </div>
    </footer>
  </body>
</html>
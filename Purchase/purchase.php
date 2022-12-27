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
      $items = mysqli_fetch_all($detailQuery ,MYSQLI_ASSOC)
      
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
          <a class="active">НОВЫЕ</a>
          <a>КУПОНЫ СНОСО</a>
          <a href="../Categories/entertaiment.php">РАЗВЛЕЧЕНИЯ</a>
          <a>ЕДА</a>
          <a>ЗДОРОВЬЕ</a>
          <a>КРАСОТА</a>
          <a href="../Categories/sport.php">СПОРТ</a>
          <a href="../Categories/travel.php">ТУРИЗМ, ОТЕЛИ</a>
          <a>УСЛУГИ</a>
          <a>ТОВАРЫ </a>
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
              foreach($items as $item){
                echo '
                  <div class="main__item__card">
                    <div class="main__item__card__title">
                      <h3>Ваш заказ</h3>
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
                    </div>
                  </div>
                ';
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
              foreach($items as $item){
                echo ''.$item["price"].'₸';
              }
            ?></h5>
          </div>
          <div class="main__payment__title">
            <h5>Сумма к оплате</h5>
            <h5><?php 
              foreach($items as $item){
                echo ''.$item["price"].'₸';
              }
            ?></h5>
          </div>
          <button class="main__payment__submit">Оплатить</button>
        </div>
      </div>
      </div>
    </div>
  </body>
</html>
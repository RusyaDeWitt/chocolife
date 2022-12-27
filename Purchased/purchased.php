<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css"  type="text/css" />
  </head>
  <body>
    <?php 
      session_start();
      
      require_once("../connection.php");
      $certificateQuery = mysqli_query($con, "SELECT * FROM certificates");
      $certificates = mysqli_fetch_all($certificateQuery ,MYSQLI_ASSOC);
        
      if (isset($_SESSION["session_phone"])) {
          $phone = $_SESSION["session_phone"];
          $existCartQuery = mysqli_query($con, "SELECT certificate_id FROM users_cart WHERE user_id='".$phone."' ");
          $existCart = mysqli_fetch_all($existCartQuery ,MYSQLI_ASSOC);
    
          $temp =  array();
          foreach($existCart as $item){
            array_push($temp, $item["certificate_id"]);
          };
          
          $certificateQuery = mysqli_query($con, "SELECT * FROM certificates WHERE id in ('" 
          . implode("','", array_map('intval', $temp)) 
          . "') ");
          $certificates = mysqli_fetch_all($certificateQuery ,MYSQLI_ASSOC);
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
      <div class="new">
        <div class="new__label">
          <a id="new__label">Мои сертификаты</h1>
        </div>
        <div class="cards">
          <?php 
            foreach($certificates as $item){?>
                <?php 
                  echo '
                  <a class="card__wrap" href="../CertificateDetail/detail.php?id='.$item["id"].'">
                    <div class="card__item">
                    <div class="card">
                      <img class="card" src="data:image/jpeg;charset=utf8;base64, '.base64_encode($item["image"]).'" />
                      <div class="card__head">
                      <div class="card__tag">
                        <img src="../images/map_point.png" width="20px" height="20px" />
                        <span>'.$item["address"].'</span>
                      </div> 
                        <div class="card__bookmark">
                          <img src="../images/bookmark.png" />
                        </div>
                      </div>
                    </div>
                    <div class="card__info">
                      <h4>'.$item["name"].'</h4>
                      <h5>'.$item["studio"].'</h5>
                      <div class="card__subinfo">
                        <div class="card__review">
                          <img src="../images/star.png" />
                          <h5>'. $item["rating"] .'/'. $item["reviews"] .' отзывов</h5>
                        </div>
                      </div>
                    </div>
                  </div>
              </a>'
                
                ?>     
            <?php
            };

          ?>
          
        </div>
      </div>

        </div>
      </div>
    </div>
    <footer class="footer">
    <div class="additional__info">
      <div class="additional__info__header">
        <img src="../images/addinfo.jpg"/>
        <p>Все скидки и акции в одном месте!
        Человеку для счастья нужно совсем мало: оставаться здоровым, иметь крепкую семью и хорошую работу, хранить гармонию души. Но иногда это не все. Не хватает какого-то приятного дополнения, например, получить бешеную скидку на популярную услугу. И этот бонус можем подарить вам именно мы! Благодаря купонам, приобретенным в нашем сервисе, вы сможете стать самым счастливым человеком в любой точке в Алматы.
        Мы предлагаем скидки в Алматы на самые разнообразные виды деятельности и услуги, которые распределены по таким рубрикам:
      </p>
      </div>
      <div class="additional__info__sub">
        <ul id="addinfo__ul">  
          <li>новые (самые свежие предложения);</li>
          <li>развлечения (караоке, кинотеатры, активный отдых и досуг);</li>
          <li>еда (рестораны, кафе, доставка и т. д.);</li>
          <li>здоровье (врачи, анализы, медцентры, обследования);</li>
          <li>красота (салоны красоты, а также отдельных мастеров);</li>
          <li>спорт (услуги спортзалов, фитнес-клубов и т. д.);</li>
          <li>туризм (туры выходного дня, гостиницы, санатории и т. д.).</li>
          <li>услуги (авто-услуги, обучающие курсы, быт. услуги и т. д.);</li>
          <li>товары (для школы, для дома и т. д.);</li>
        </ul>
        <p>
        Покупайте купоны и экономьте на услугах и товарах!
        B купонном сервисе Chocolife (Чоколайф) можно приобрести горящие скидки и купоны в Алматы и Казахстане с самым разным акционным диапазоном: от 30% до 90%. На сайте представлено более 500 разных возможностей для реализации личных планов. Например, вы можете в очередной раз посетить любимое кафе, но теперь со скидочным купоном на 50% оставить там намного меньшую сумму. Такой купон обойдется вам всего от 200 тенге.
        Срок действия каждой акции в Алматы указан на нашем сайте. Эта информация поможет приобрести купон для посещения вами не только интересного предложения, но и оптимального во времени. Чтобы быстрее отыскать нужную акцию в нашем агрегаторе скидок, воспользуйтесь удобным поиском сайта онлайн по всем имеющимся рубрикам.
        Отныне и навсегда сайт акций и скидок в Алматы должен стать вашим лучшим другом и помощником! С нашей помощью вы сэкономите уйму денежных средств, невозвратимое время и дорогое здоровье. Удобное оформление сайта, правильно подобранная цветовая гамма, удобство в расположении рубрик не оставят равнодушным ни молодежь, ни людей преклонного возраста.
        Скидочные купоны в Алматы, представленные у нас — это гарантия настоящего качества. Мы ручаемся за каждого своего компаньона, уверены в безупречности каждого предложения, ведь все проверено лично нами! Если вы не успели применить скидку по назначению, или вас не устроило обслуживание — звоните по телефону, указанному на сайте, и наша служба заботы о пользователях обязательно даст вам все разъяснения. При возникновении вопросов или предложений также можно связаться с нами через СЗП и форму обратной связи. ❤
        </p>
      </div>
    </div>
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
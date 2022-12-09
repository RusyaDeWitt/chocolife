<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
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
            <a class="menu__login__button" href="../Login/login.php">Войти</a>
            <a id="menu__login__signup"  href="../Login/register.php">Создать аккаунт</a>
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
          <a>ВСЕ</a>
          <a>НОВЫЕ</a>
          <a>КУПОНЫ СНОСО</a>
          <a>РАЗВЛЕЧЕНИЯ</a>
          <a>ЕДА</a>
          <a>ЗДОРОВЬЕ</a>
          <a>КРАСОТА</a>
          <a>СПОРТ</a>
          <a>ТУРИЗМ, ОТЕЛИ</a>
          <a>УСЛУГИ</a>
          <a>ТОВАРЫ </a>
        </div>
      </div>
    </header>
    <div class="main">
      <div class="banners">
        <img src='../images/banner_first.png' class="banner" />
        <img src='../images/banner_second.png' class="banner" />
      </div>
      <div class="new">
        <div class="new__label">
          <a id="new__label">Новые</h1>
          <a id="new__label__show-all">Показать все</a>
        </div>
        <div class="card">
          
        </div>
      </div>
    </div>
  </body>
</html>
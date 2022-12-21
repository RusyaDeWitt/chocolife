<!DOCTYPE !html>
<html>
  <head>
    <link rel="stylesheet" href="style.css"  type="text/css" />
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

        </div>
      </div>
    </header>
    <div class="cart">
      <h2>Корзина</h2>
      <div class="cart__content">
        <h5>Корзина пуста ...</h5>
      </div>
    </div>
  </body>
</html>
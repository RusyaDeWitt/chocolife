<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css"  type="text/css" />
  </head>
  <body>

    <?php 
      session_start();
      require('../connection.php');

      $sum = 0;

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

      foreach($certificates as $item){
        $sum += $item["price"];
      }
    
      if(isset($_POST["buy"])){
        foreach($temp as $item){
          $sql="INSERT INTO purchased (user_id, certificate_id)
          VALUES('$phone','$item')";
          $result=mysqli_query($con,$sql);
        }
      }

    ?>
    <header class="header">
      <div class="header__title">
        <img src="../images/logo_chocolife.svg" />
        <div id="halyk">
          <p>Безопасность транзакций гарантирует</p>
          <img src="../images/logo_main_halyk.svg" />
        </div>
      </div>
    </header>
    <div class="main">
      <div class="main__title">
        <h3>Введите данные банковской карты</h3>
      </div>
      <div class="main__content">
      <div class="main__left">
      <div class="wrapper">
        <div class="payment_form_wrapper">
            <div class="payment_form">
                <div class="back_card">
                    <div class="stripe"></div>
                    <div class="input_field">
                      <label>CVC/CVV</label>
                      <input type="text" name="cvc-cvv" class="input"
                      placeholder="XXX" maxlength="3" 
                      >
                    </div>
                </div>
                <div class="front_card">
                    <div class="pay_sec">
                        <div class="visa_img">
                          <img src="../images/visa.png" alt="visa">
                        </div>
                    </div>
                    <div class="form">
                      <div class="input_top">
                          <label>CARD NUMBER</label>
                          <div class="input_grp">
                            <div class="input_field">
                              <input type="text" name="cardNumber" class="input"
                              placeholder="XXXX" maxlength="4" 
                              >
                            </div>
                            <div class="input_field">
                              <input type="text" name="cardNumber" class="input"
                              placeholder="XXXX" maxlength="4" 
                              >
                            </div>
                            <div class="input_field">
                              <input type="text" name="cardNumber" class="input"
                              placeholder="XXXX" maxlength="4" 
                              >
                            </div>
                            <div class="input_field">
                              <input type="text" name="cardNumber" class="input"
                              placeholder="XXXX" maxlength="4" 
                              >
                            </div>
                          </div>
                      </div>
                      <div class="input_bottom">
                          <div class="input_left">
                            <div class="input_field">
                              <label>CARD HOLDER</label>
                              <input type="text" name="cvc-cvv" class="input"
                              placeholder="CODING MARKET" 
                              >
                            </div>
                          </div>
                          <div class="input_right">
                              <label>EXPRIATION DATE</label>
                              <div class="input_grp">
                                <div class="input_field">
                                  <input type="text" name="month" class="input"
                                  placeholder="XX" maxlength="2" 
                                  >
                                </div>
                                <div class="input_field">
                                  <input type="text" name="date" class="input"
                                  placeholder="XX" maxlength="2" 
                                  >
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
          </div>
      </div>
      </div>
    </div>
    <div class="main__right">
        <div class="main__payment__sum">
          <p>Сумма к оплате</p>
          <?php echo ''.$sum.'₸'; ?>
        </div>
        <form method="post">
          <button type="submit" class="submit__button" name="buy">
            Оплатить
          </button>
        </form>
        <a href="../Cart/cart.php">< Вернуться к оформлению заказа</a>
    </div>
  </body>
</html>
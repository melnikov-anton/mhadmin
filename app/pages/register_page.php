<!DOCTYPE html>
<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--изменить ссылку на файл стилей-->
    <link rel="stylesheet" type="text/css" href="../css/mhadmin.css">

  </head>

  <body>
  <div class="Container">
    <div class="Description">
      <h4>Регистрация пользователя</h4>

    </div>

    <div class="Form">
      <form action="/user/register" method="post">
        <label for="fn">*Имя</label>
        </br>
        <input type="text" id="fn" name="fname" required>
        </br>
        <label for="ln">*Фамилия</label>
        </br>
        <input type="text" id="ln" name="lname" required>
        </br>
        <label for="em">E-Mail</label>
        </br>
        <input type="email" id="em" name="email">
        </br>
        <label for="pw">*Пароль</label>
        </br>
        <input type="password" id="pw" name="password" required>
        </br>
        <label for="rpw">*Повторите пароль</label>
        </br>
        <input type="password" id="rpw" name="rep_pass" required>
        </br>
        <label for="pr">Примечание</label>
        </br>
        <textarea name="rest" id="pr"
            title="Поле может быть использовано, если нужно зарегистрировать группу учащихся."
            maxlength="250"></textarea>
        </br>
        </br>
        <input type="submit" value="Регистрация">

      </form>
    </div>
    
    <div class="Message">

    </div>

    <div class="Footer">
      <p>Anton Melnikov <?php echo date("Y") ?></p>
    </div>
  </div>
  </body>
</html>

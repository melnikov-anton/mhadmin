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
      <h3>Добро пожаловать в приложение Mini Hosting Admin!</h3>
      <p>Приложение предназначено для размещения Web-сайтов на локальном Web-сервере.</p>
      <p>Зарегистрированные пользователи могут создавать и настраивать Web-сайты,
      реализованные на Web-сервере Apache, используя скриптовые языки программирования
      и реляционные базы данных.
      </p>

    </div>

    <div class="Form">
      <form action="/user/login" method="post">
        <label for="un">Имя пользователя</label>
        </br>
        <input type="text" id="un" name="username" required>
        </br>
        <label for="pw">Пароль</label>
        </br>
        <input type="password" id="pw" name="password" required>
        </br></br>
        <input type="submit" value="Войти">
        <a href="/home/regpage">Регистрация</a>
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

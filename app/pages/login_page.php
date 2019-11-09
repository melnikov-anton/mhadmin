<!DOCTYPE html>
<html>

  <head>
    <title>MH Admin: Вход</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/mhadmin.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap_4.3.1.min.css">

  </head>

  <body>

  <div class="container-fluid">

    <div class="row mt-5">
      <div class="col-md-8 mx-auto border border-primary rounded-lg p-4 bg-light shadow-lg">
        <h3 class="text-center">Добро пожаловать в приложение Mini-Hosting Admin!</h3>
        <p class="text-center">Приложение предназначено для размещения Web-сайтов на локальном Web-сервере.</p>
        <p class="text-center">Зарегистрированные пользователи могут создавать и настраивать Web-сайты,
        реализованные на Web-сервере Apache, используя скриптовые языки программирования
        и реляционные базы данных.
        </p>
      </div>
   </div>

    <div class="row mt-5">
      <div class="col-md-4 mx-auto border border-primary rounded-lg p-4 bg-light shadow-lg">
        <h5 class="text-center">Войдите, что бы начать использовать.</h5>

        <form action="/user/login" method="post" class="p-2 mt-3">
          <div class="form-group">
            <label for="un">Имя пользователя</label>
            <input type="text" class="form-control" id="un" name="username" required>
          </div>
          <div class="form-group mb-5">
            <label for="pw">Пароль</label>
            <input type="password" class="form-control" id="pw" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Войти</button>
          <a href="/home/regpage" class="btn btn-link float-right mt-4">Регистрация</a>
        </form>

      </div>
    </div>

  </div>

  </body>
</html>

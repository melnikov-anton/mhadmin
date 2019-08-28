<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--изменить ссылку на файл стилей-->
    <link rel="stylesheet" type="text/css" href="../css/mhadmin.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap_4.3.1.min.css">

  </head>

  <body>
    <div class="container-fluid h-100">

      <div class="row mt-4">
        <div class="col-md-8 mx-auto">
          <h4 class="text-center">Регистрация пользователя</h4>
        </div>
      </div>

    <div class="row mt-4">
      <div class="col-md-4 mx-auto border border-primary rounded-lg p-4 bg-light">
        <form action="/user/register" method="post">
          <div class="form-group">
            <label for="fn">*Имя</label>
            <input type="text" id="fn" name="fname" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="ln">*Фамилия</label>
            <input type="text" id="ln" name="lname" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="em">E-Mail</label>
            <input type="email" id="em" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="pw">*Пароль</label>
            <input type="password" id="pw" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="rpw">*Повторите пароль</label>
            <input type="password" id="rpw" name="rep_pass" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="pr">Примечание</label>
            <textarea name="rest" id="pr"
                title="Поле может быть использовано, если нужно зарегистрировать группу учащихся."
                maxlength="250" class="form-control"></textarea>
          </div>

            <button type="submit" class="btn btn-primary btn-block mt-5">Регистрация</button>

        </form>
      </div>
    </div>

      <div class="row">
        <div class="col-md-8 mx-auto">
          <p id="message"><p>
        </div>
      </div>

    </div>

  </body>
</html>

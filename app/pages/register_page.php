<!DOCTYPE html>
<html>

  <head>
    <title>MH Admin: Регистрация</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/js/mhadmin.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/mhadmin.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap_4.3.1.min.css">

  </head>

  <body>
    <div class="container-fluid h-100">

      <div class="row mt-4">
        <div class="col-md-8 mx-auto">
          <h4 class="text-center">Регистрация пользователя</h4>
        </div>
      </div>

    <div class="row mt-4">
      <div class="col-md-4 mx-auto border border-primary rounded-lg p-4 bg-light shadow-lg">
        <form action="/user/register" id="regform" method="post" onSubmit='return checkPass("regform", "pw", "rpw", "msg")'>
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
          <div class="col-md-8 mx-auto" style="min-height: 1.5em;">
            <h5 id="msg" class="text-center text-danger"><h5>
          </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Регистрация</button>
            <a href="/" class="btn btn-link float-links mt-4">Назад</a>
        </form>
      </div>
    </div>

    </div>



  </body>
</html>

<?php
// если админ - добавить выбор пользователя?!
?>

<div class="Form">
  <form action="/site/create" method="post">
    <label for="tit">*Имя сайта</label>
    </br>
    <input type="text" id="tit" name="title" required>
    </br>

    <label for="desc">Краткое описание</label>
    </br>
    <textarea name="description" id="desc"
        maxlength="250"></textarea>
    </br>
    </br>
    <input type="submit" value="Создать сайт">

  </form>

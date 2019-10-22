#!/usr/bin/env bash

# Скрипт получает в качестве параметров:
# 1) Имя пользователя
# 2) Пароль пользователя
# 3) Путь к директории пользователя
# 4) Путь (и имя) к файлу с учетными записями пользователей
# Скрипт создает:
# 1) Запись в файле с учетными записями пользователей
# 2) Перезагружает FTP сервер
# Коды возврата:
# 0 - все хорошо
# 1 - не все аргументы заданы
# 6 - не удалось создать запись


p_amount=4

if [[ $# -eq $p_amount ]]
then
  username="$1"
  userpass="$2"
  userdir="$3"
  passfile="$4"

  if [ -d "$userdir" ]
  then
    echo ""
  else
    mkdir "$userdir"
  fi

  echo $userpass | ftpasswd --passwd --stdin --file="$passfile" --name="$username" --uid=33 --gid=33 --home="$userdir" --shell=/bin/false
  if [[ $? -eq 0 ]]
  then
    service proftpd reload
    exit 0
  else
    exit 6
  fi

else
  exit 1
fi

#!/usr/bin/env bash

# Скрипт получает в качестве параметров:
# 1) Путь и имя файла-архива
# 2) Путь к директории c виртуальными хостами
# 3) Путь к директории виртуальным хостом
# Скрипт создает:
# 1) Архив с директорией виртуального хоста
# Коды возврата:
# 0 - все хорошо
# 1 - не все аргументы заданы
# 4 - не удалось создать архив
# 5 - директории не существует

p_amount=3

if [[ $# -eq $p_amount ]]
then
  file_name=$1
  vhosts_dir=$2
  sitedir=$3
  if [ -d "$vhosts_dir/$sitedir" ]
  then
    cd "$vhosts_dir"

    tar cfz "$file_name" "$sitedir"
    if [[ $? -ne 0 ]]
    then
        exit 4
    fi
  else
    exit 5
  fi
else
  exit 1
fi

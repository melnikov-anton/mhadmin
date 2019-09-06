#!/usr/bin/env bash

# Скрипт получает в качестве параметров:
# 1) Путь для виртуального хоста
# 2) Путь где хранится файл конфига виртуального хоста
# 3) Имя файла-конфига виртуального хоста
# Скрипт создает:
# 1) Директорию для виртуального хоста
# 2) Символическую ссылку на файл-конфиг, чтобы апач смог его прочитать
# Коды возврата:
# 0 - все хорошо
# 1 - не все аргументы заданы
# 2 - не удалось создать каталог
# 3 - не удалось создать символическую ссылку на файл-конфиг

apache_site_enabled="/etc/apache2/sites-enabled"
p_amount=3

if [[ $# -eq $p_amount ]]
then
    sitedir="$1"
    confdir="$2"
    conffile="$3"
    if [ ! -d $sitedir ]
    then
        mkdir -p "$sitedir"
        if [[ $? -ne 0 ]]
        then
            exit 2
        fi
    fi
    ln -sf "$confdir/$conffile" "$apache_site_enabled/$conffile"
    if [[ $? -ne 0 ]]
    then
        exit 3
    fi
else
  exit 1
fi

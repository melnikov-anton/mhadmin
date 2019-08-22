<?php


// транслитерация
function translit($stroka) {
  $converter = array(
'а' => 'a', 'б' => 'b', 'в' => 'v',
'г' => 'g', 'д' => 'd', 'е' => 'e',
'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
'и' => 'i', 'й' => 'y', 'к' => 'k',
'л' => 'l', 'м' => 'm', 'н' => 'n',
'о' => 'o', 'п' => 'p', 'р' => 'r',
'с' => 's', 'т' => 't', 'у' => 'u',
'ф' => 'f', 'х' => 'kh', 'ц' => 'ts',
'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch',
'ь' => '', 'ы' => 'y', 'ъ' => '',
'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
'А' => 'A', 'Б' => 'B', 'В' => 'V',
'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
'И' => 'I', 'Й' => 'Y', 'К' => 'K',
'Л' => 'L', 'М' => 'M', 'Н' => 'N',
'О' => 'O', 'П' => 'P', 'Р' => 'R',
'С' => 'S', 'Т' => 'T', 'У' => 'U',
'Ф' => 'F', 'Х' => 'Kh', 'Ц' => 'Ts',
'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Shch',
'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
);
 return strtr($stroka, $converter);
}

// создание юзернейма
function create_username($fname, $lname) {
  $fname=translit($fname);
  $lname=translit($lname);
  $str = substr($fname, 0, 3) . substr($lname, 0, 3);
  $str = strtolower($str) . substr(strval(time()), -2, 2);
  return $str;
}

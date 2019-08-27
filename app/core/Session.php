<?php

class Session {

  public static function startSession() {
    session_name('MHASESSIONID');
    session_start();
  }
}

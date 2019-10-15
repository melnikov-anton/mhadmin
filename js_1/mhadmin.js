
function checkPass(form_id, pass1_id, pass2_id, message_id) {
  var pass1 = document.forms[form_id].elements[pass1_id].value;
  var pass2 = document.forms[form_id].elements[pass2_id].value;
  var message = document.getElementById(message_id);
  if(pass1 != pass2){
    message.innerHTML = "Введенные пароли не совпадают!";
    return false;
  }
}

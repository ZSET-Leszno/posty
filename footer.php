<?php
$footer = "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js'></script>
<script>
let isup = false;
function slideUp() {
    var footer = document.querySelector('.footer');
    
    if (isup === false){
      isup = true
      footer.style.transform = 'translateY(-580%)';
    } else {
      isup = false;
    footer.style.transform = 'translateY(70%)';
    }
  }
  </script>
<div class='footer'>
<text>Autorzy: K Michalski, G Wełyczko, T Piwoński 4TI2  |  </text>
  <button class='button-50' style='padding:2px;margin-top:3px;' onclick='slideUp()'>Kontakt</button><hr>
  <form action='send_email.php' method='post' name='form' id='form' onsubmit='return sendEmail();'>
  <table>
<thead>
  <tr>
    <th><label for='name'>Imię i nazwisko:</label></th>
    <th><input type='text' name='name' id='name' required><br></th>
  </tr>
</thead>
<tbody>
  <tr>
    <th><label for='email'>Twój adres e-mail:</label></th>
    <th><input type='email' name='email' id='email' required><br></th>
  </tr>
  <tr>
    <th><label for='message'>Wiadomość:</label></th>
    <th> <textarea name='message' id='message' required></textarea>
</th>
  </tr>
</tbody>
</table>
  <input class='button-50' style='padding:2px 50px;margin-bottom:40px;' name='send-email' type='submit' value='Wyślij'>
  

</form>
<script>
  function sendEmail() {
    var form = document.querySelector('form');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'send_email.php', true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        alert(xhr.responseText);
        form.reset();
      } else {
        alert('Wystąpił błąd podczas wysyłania wiadomości.');
      }
    };
    xhr.send(formData);
    return false;
  }
</script>
</div>";

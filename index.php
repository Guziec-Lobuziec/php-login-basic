<!DOCTYPE html>
<html>

<head>
  <title>Logowanie</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" crossorigin="anonymous"></script>
  <script>

  $(document).ready(() => {

   $('#login-form').submit(function(e) {
     e.preventDefault();
   }).validate({
     submitHandler: function(form) {
        $.ajax({
          url: form.action,
          type: form.method,
          dataType: 'json',
          data: $(form).serialize(),
          success: function(data) {
                   $('#login-message').empty();
                   $('#login-message').append(
                     "<div class='"+
                     ((data.login > 0) ? 'text-danger' : 'text-success')+
                     "'>"+data.message+"</div>"
                   );
                 },
          error: function(jqXHR, textStatus, errorThrown) {
               console.log(JSON.stringify(jqXHR));
               console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
           }
        });

      },
      errorPlacement: function(label, element) {
        label.addClass('text-danger');
        label.insertAfter(element);
      },
      rules: {
        login: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 12
        }
      },
      messages: {
        login: {
          required: "Wymagany jest login",
          email: "Login musi być adresem email"
        },
        password: {
          required: "Wymagane jest hasło",
          minlength: "Hasło musi mieć conajmniej 12 znaków"
        }
      }
    });

  });
  </script>
</head>

<body>
  <div class="container mt-2">
    <div class="row">
      <div class="col"></div>
      <div class="col border border-primary rounded bg-light">
        <form id="login-form" class="text-center" action="api/login.php" method="post">
            <div class="row h-25 mb-5">
              <div class="col form-group">
                <label for="login">Login</label>
                <input name="login" id="login" class="form-control" type="email">
              </div>
            </div>
            <div class="row h-25 mb-5">
              <div class="col form-group">
                <label for="password">Hasło</label>
                <input name="password" id="password" class="form-control" type="password">
              </div>
            </div>
            <div class="row h-auto">
              <div class="col">
                <input class="btn btn-primary" type="submit" value="Zaloguj">
              </div>
            </div>
            <div class="row h-auto">
              <div class="col">
                <span id="login-message"></span>
              </div>
            </div>
        </form>
      </div>
      <div class="col"></div>
    </div>
  </div>
</body>

</html>

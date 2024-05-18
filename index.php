<?php 
  require 'loginLogic.php';   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid ps-md-0">
        <div class="row g-0">
          <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
          <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
              <div class="container">
                <div class="row">
                  <div class="col-md-9 col-lg-8 mx-auto">
                    <h2 class="text-center login-heading my-5 fw-bold">Online Exam</h2>
                    <!-- Sign In Form -->
                    <form id="loginForm" method="post">
                        <?php 
                            if(isset($error)){
                                foreach($error as $error){
                                    echo '<div class="alert alert-danger" role="alert">'
                                        .$error
                                    .'</div>';
                                }
                            }
                        ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-3 hidden" id="2faDiv">
                            <input type="text" class="form-control" name="2facode" id="2facode" placeholder="2FA Code">
                            <label for="2facode">2FA Code</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                            <label class="form-check-label" for="rememberPasswordCheck">
                              Remember password
                            </label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-login text-uppercase fw-bold mb-2" name="loginBtn" style="background: #1d1b31;color:white" type="submit">Log in</button>
                            <div class="my-3 row d-flex justify-content-between">
                                <a class="small col" href="#" style="color:#1d1b31">Forgot password?</a>
                                <p class="login-heading mb-4 col-auto">Don't have an account? <a href="signup.php" style="color:#1d1b31">Register here</a></p>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
      document.getElementById('loginForm').addEventListener('submit', function(event) {
          event.preventDefault();

          const form = event.target;
          const formData = new FormData(form);

          // Determine which action to take based on whether 2FA is pending
          if (document.getElementById('2faDiv').classList.contains('hidden')) {
              // Add the loginBtn field to the form data for the login attempt
              formData.append('loginBtn', true);
          } else {
              formData.delete('loginBtn');
              // Add the verify2FA field to the form data for 2FA verification
              formData.append('verify2FA', true);
          }

          fetch(form.action, {
              method: 'POST',
              body: formData
          })
          .then(response => response.json())
          .then(data => {
              if (data.success && data.pending2FA) {
                  document.getElementById('2faDiv').classList.remove('hidden');
                  alert('A 2FA code has been sent to your email. Please enter it to proceed.');
              } else if (data.success) {
                  window.location.href = data.redirectUrl;
              } else {
                  alert(data.message);
              }
          })
          .catch(error => console.error('Error:', error));
      });
      </script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>

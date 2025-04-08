<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>

  <body class="bg-secondary">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-mg-6">
          <div class="container bg-white rounded my-2 px-0">
            <div class="py-1 bg-primary bg-gradient text-white">
              <h1 style="text-align: center">LOGIN</h1>
            </div>
            <div class="mt-3" style="text-align: center">
              <img src="assets/login.jpg" width="100px" alt="" />
            </div>

            <form action="../../index.php" method="POST">
              <div class="py-3 mx-5">
                <input type="email" name="useremail" class="form-control border-info" placeholder="Enter your email" />
              </div>

              <div class="py-3 mx-5">
                <input type="password" name="userpassword" class="form-control border-info"
                  placeholder="Enter password" />
              </div>

              <div class="py-3 mx-5">
                <input type="submit" name="login" class="form-control border-info btn bg-primary bg-gradient text-white"
                  value="Login" />
              </div>
              <div class="py-3 mx-5">
                <a href="signup.php" style="text-decoration: none"><input type="button"
                    class="form-control border-info btn bg-warning bg-gradient text-white" value="Registration" /></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>
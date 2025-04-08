<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>

  <body class="bg-secondary">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-mg-6">
          <div class="container bg-white rounded my-2 px-0">
            <div class="py-1 bg-warning bg-gradient text-white">
              <h1 style="text-align: center">REGISTRATION</h1>
            </div>
            <div class="mt-3" style="text-align: center">
              <img src="assets/download.png" width="100px" alt="" />
            </div>

            <form method="POST" action="../../index.php">
              <div class="py-3 mx-5">
                <input type="text" name="name" required class="form-control border-info"
                  placeholder="Enter full name" />
              </div>
              <div class="py-3 mx-5">
                <input type="email" name="email" required class="form-control border-info"
                  placeholder="Enter your email" />
              </div>
              <div class="py-3 mx-5">
                <input type="number" name="number" class="form-control border-info" placeholder="Enter phone number" />
              </div>
              <div class="py-3 mx-5">
                <input type="password" name="password" required class="form-control border-info"
                  placeholder="Enter password" />
              </div>
              <div class="py-3 mx-5">
                <input type="submit" name="submit"
                  class="form-control border-info btn bg-warning bg-gradient text-white" value="Registration" />
              </div>
              <div class="py-3 mx-5">
                <a href="login.php" style="text-decoration: none"><input type="button"
                    class="form-control border-info btn bg-primary bg-gradient text-white" value="Login" /></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>
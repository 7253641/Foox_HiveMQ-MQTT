<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
    	.login-form {
    		width: 340px;
        margin: 50px auto;
        font-family: 'Roboto', sans-serif;
    	}
        .login-form form {
        	 margin-bottom: 15px;
            background: #19aa8d;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
  </head>

  <body>

    <!-- Navigation -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <a class="navbar-brand" href="index.php" >Foox - Smart Food Box</a>
          <form class="navbar-form navbar-right">
          </form>
          </div>
        </div>
      </nav>

    <div class="login-form">
        <form method="post">
            <h2 class="text-center">Register</h2>
    		<div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="name" required="required">
            </div>
    		<div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" required="required">
            </div>
    		<div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" required="required">
            </div>
    		<div class="form-group">
                <input type="text" class="form-control" placeholder="Phone Number" name="phonenum" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
            </div>
            <div class="form-group">
                <button name="register" value="Register" type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <div class="clearfix">
            </div>
        </form>
    </div>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
        }

        p {
            color: #666666;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #dddddd;
            text-align: center;
            color: #888888;
        }
        img{
          width: 250px;
        }
    </style>
</head>
<body>
    <div class="container">
      {{-- <center><img src="public/assets/img/38204.png" alt="img"></center> --}}
      <center><img src="https://whatech.b-cdn.net/media/com_mtree/images/listings/m/38204.png" alt="img"></center>
        <h1>Email Template</h1>
        <p>Hello {{$user->name}},</p>
        <p>Thank you for registering with Your App. We're excited to have you on board!</p>
        <p>Your account has been successfully created. You can log in using your credentials and start exploring our services.</p>

       <br>
       <br>
       <p>Thank You</p>
    <div class="footer">
        <p>&copy; 2024 Your Company</p>
    </div>
</body>
</html>

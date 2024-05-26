<!DOCTYPE HTML5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h1>Register</h1>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" placeholder="Example: emily123" autocomplete="off" required>
        <label for="email_alias">Email:</label>
        <input type="email" class="form-control" name="user-email" placeholder="name@email.com" autocomplete="off" required>
        <label for="phone_alias">Phone (optional):</label>
        <input type="tel" name="phone_alias" id="phone_alias"><br>
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="user-pass" placeholder="*********" autocomplete="off" required>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="*********" autocomplete="off" required><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>

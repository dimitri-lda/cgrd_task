<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/login.js"></script>
</head>
<body>

<div class="login-container">
    <img src="/assets/img/logo.svg" alt="cgrd" width="70" height="70">
    <p id="errorMessage" class="error-message" style="display: none;"></p>
    <form id="loginForm">
        <input type="text" placeholder="Username" id="username" required>
        <br>
        <input type="password" placeholder="Password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

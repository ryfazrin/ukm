<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="<?= base_url('/auth')?>" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" required>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
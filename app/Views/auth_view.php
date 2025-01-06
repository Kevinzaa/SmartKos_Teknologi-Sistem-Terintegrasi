<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<body>
    <!-- Header Section -->
    <header>
        <a href="<?= base_url('/'); ?>">← Back to Home</a>
    </header>

    <div class="container">
        <h1>Authentication</h1>

        <!-- Register Section -->
        <div class="card">
            <h2>Register</h2>
            <form id="registerForm">
                <div class="form-group">
                    <label for="regUsername">Username</label>
                    <input type="text" id="regUsername" name="username" required>
                </div>
                <div class="form-group">
                    <label for="regPassword">Password</label>
                    <input type="password" id="regPassword" name="password" required>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>

        <!-- Login Section -->
        <div class="card">
            <h2>Login</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label for="logUsername">Username</label>
                    <input type="text" id="logUsername" name="username" required>
                </div>
                <div class="form-group">
                    <label for="logPassword">Password</label>
                    <input type="password" id="logPassword" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script src="<?= base_url('js/auth.js'); ?>"></script>
</body>
</html>

<h1>Administrator Login</h1>

<?php if (!empty($login_error)): ?>
    <div><?= $login_error ?></div>
<?php endif; ?>

<form method="post">
    <div>
        <label>Username</label>
        <input type="text" name="username">
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password">
    </div>

    <input type="hidden" name="action" value="login">
    <button>Login</button>
</form>

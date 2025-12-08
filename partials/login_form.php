<h1>Administrator Login</h1>

<?php if (!empty($login_error)): ?>
    <div><?= $login_error ?></div>
<?php endif; ?>

<form method="post">
    <div>
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control">
    </div>

    <div>
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <input type="hidden" name="action" value="login">
    <button class="btn btn-primary">Login</button>
</form>

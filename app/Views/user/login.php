<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-5 m-5 shadow bg-light">
                <h2>Login</h2>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <?= form_open('/user/processLogin') ?>
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                <?= form_close() ?>
                <p class="mt-3">Don't have an account? <a href="/user/register">Register</a></p>
                <p class="mt-3"><a href="/user/forgotPassword">Forgot password?</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
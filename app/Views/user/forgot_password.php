<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Forgot Password</h2>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <?= form_open('/user/sendResetLink') ?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                <?= form_close() ?>
                <p class="mt-3">Remember your password? <a href="/user">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
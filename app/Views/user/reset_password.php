<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Reset Password</h2>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if (isset($validation)) : ?>
                    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif; ?>
                <?= form_open('/user/processResetPassword') ?>
                    <input type="hidden" name="reset_token" value="<?= $resetToken ?>">
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control <?= isset($validation) && $validation->hasError('new_password') ? 'is-invalid' : '' ?>" id="new_password" name="new_password" required>
                        <?php if (isset($validation) && $validation->hasError('new_password')) : ?>
                            <div class="invalid-feedback"><?= $validation->getError('new_password') ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control <?= isset($validation) && $validation->hasError('confirm_password') ? 'is-invalid' : '' ?>" id="confirm_password" name="confirm_password" required>
                        <?php if (isset($validation) && $validation->hasError('confirm_password')) : ?>
                            <div class="invalid-feedback"><?= $validation->getError('confirm_password') ?></div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</body>
</html>
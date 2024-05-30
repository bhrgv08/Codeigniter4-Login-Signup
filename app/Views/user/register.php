<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>
        <section id="register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-sm-12">
                    <div class="card m-5 p-4 shadow bg-light">
                            <h2 class="text-center">Register</h2>
                            <?php if (isset($validation)) : ?>
                                <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                            <?php endif; ?>
                            <?= form_open('/user/processRegister') ?>
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('username')) : ?>
                                        <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('email')) : ?>
                                        <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>" id="password" name="password" required>
                                    <?php if (isset($validation) && $validation->hasError('password')) : ?>
                                        <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control <?= isset($validation) && $validation->hasError('confirm_password') ? 'is-invalid' : '' ?>" id="confirm_password" name="confirm_password" required>
                                    <?php if (isset($validation) && $validation->hasError('confirm_password')) : ?>
                                        <div class="invalid-feedback"><?= $validation->getError('confirm_password') ?></div>
                                    <?php endif; ?>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 d-block mx-auto">Register</button>
                            <?= form_close() ?>
                            <p class="mt-3 text-center">Already have an account? <a href="/user">Login</a></p>
                        </div>
                </div>
            </div>
        </div>
        </section>    

</body>
</html>
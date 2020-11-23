<div class="login-wrapper container h-100">

    <div class="row justify-content-center align-items-center h-100">

        <div class="col-md-8 col-xs-12 m-3 pt-5 pb-5 bg-white" align="center">

            <div class="container">

                <form action="<?php echo base_url('account/login') ?>" method="post" autocomplete="off">

                    <h1 class="mb-5">Login to your account..</h1>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" placeholder="Email" value="<?= set_value('email'); ?>" />

                        <?php if (isset($errors) && isset($errors['email'])): ?>

                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $errors['email']; ?>
                            </div>

                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off" />

                        <?php if (isset($errors) && isset($errors['password'])): ?>

                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $errors['password']; ?>
                            </div>

                        <?php endif ?>
                    </div>

                    <?php if (isset($errors) && isset($errors['wrong_credentials'])): ?>

                        <div class="alert alert-danger mt-3" role="alert">
                            <?php echo $errors['wrong_credentials']; ?>
                        </div>

                    <?php endif ?>

                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-secondary w-100 mt-3" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
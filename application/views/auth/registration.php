<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">
            <form method="post" action="<?= base_url('auth/registration'); ?>">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First name" required="required" autofocus="autofocus" value="<?= set_value('firstname'); ?>">
                                <?= form_error('firstname', '<small class="text-danger">', '</small>'); ?>
                                <label for="firstname">First name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last name" required="required" value="<?= set_value('lastname'); ?>">
                                <?= form_error('lastname', '<small class="text-danger">', '</small>'); ?>
                                <label for="lastname">Last name</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email address" required="required" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        <label for="email">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" required="required">
                                <?= form_error('confirmpassword', '<small class="text-danger">', '</small>'); ?>
                                <label for="confirmpassword">Confirm password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="<?= base_url('auth'); ?>">Login Page</a>
                <a class="d-block small" href="<?= base_url('auth/forgot'); ?>">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <form method="post" action="<?= base_url('auth') ?>">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        <label for="email">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                        <label for="password">Password</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="<?= base_url('auth/registration'); ?>">Register an Account</a>
                <a class="d-block small" href="<?= base_url('auth/forgot'); ?>">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
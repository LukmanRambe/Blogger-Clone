<div id="flash" class="container col-5">
    <?php Flasher::flash(); ?>
</div>
<div class="signup-form">
    <div class="brand text-center">
        <a href="<?= BASEURL; ?>/home">Blogger</a>
    </div>
    <div class="container card shadow">
        <div class="card-body">
            <h3 class="card-title text-center">Sign Up</h3>
            <form action="<?= BASEURL; ?>/signup/signUp" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div>
                    <label for="re-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                </div>
                <div class="bottom-section text-center">
                    <button type="submit" class="btn btn-primary">Create Account</button>
                    <p>Already Have an Account? <a href="<?= BASEURL; ?>/login/index">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
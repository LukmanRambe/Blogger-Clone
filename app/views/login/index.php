<div id="flash" class="container col-5">
    <?php Flasher::flash(); ?>
</div>
<div class="hero login-form">
    <div class="brand text-center">
        <a href="<?= BASEURL; ?>/home">Blogger</a>
    </div>
    <div class="container card">
        <div class="card-body">
            <h3 class="card-title text-center">Login</h3>
            <form action="<?= BASEURL; ?>/login/login" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="Username" autofocus>
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="text-center bottom-section">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <p>New to Blogger? <a href="<?= BASEURL; ?>/signup/index">Create an account</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
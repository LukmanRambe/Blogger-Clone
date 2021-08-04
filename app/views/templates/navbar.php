<?php if (isset($_SESSION['user_id'])) : ?>
    <nav class="navbar navbar-expand navbar-loggedin">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="<?= BASEURL; ?>/blog/posts">Blogger</a>
        <?php else : ?>
            <nav class="navbar navbar-expand">
                <div class="container d-flex justify-content-between">
                    <a class="navbar-brand" href="<?= BASEURL; ?>">Blogger</a>
                    <div class="circle"></div>
                    <div class="circle-two"></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php if ($_SERVER['REQUEST_URI'] == '/Blogger/public/blog/posts' || $_SERVER['REQUEST_URI'] == '/Blogger/public/blog/posts/searchPosts') : ?>
                        <form class="search-bar d-flex" action="<?= BASEURL; ?>/blog/posts/searchPosts" method="POST">
                        <?php else : ?>
                            <form class="search-bar d-flex" action="<?= BASEURL; ?>/online/posts/searchPosts" method="POST">
                            <?php endif; ?>
                            <input class="form-control" type="search" placeholder="Search posts" aria-label="Search" name="keyword" autocomplete="off">
                            <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                            </form>
                            <div class="navbar-nav">
                                <a class="nav-link" href="<?= BASEURL; ?>/home/logout" id="logoutBtn">Logout</a>
                            </div>
                        <?php else : ?>
                            <div class="navbar-nav">
                                <a class="nav-link" href="<?= BASEURL; ?>/login/index">Login</a>
                                <a class="nav-link" href="<?= BASEURL; ?>/signup/index" id="signupBtn">Sign Up</a>
                            </div>
                        <?php endif; ?>
                </div>
            </nav>
        </div>
    </nav>
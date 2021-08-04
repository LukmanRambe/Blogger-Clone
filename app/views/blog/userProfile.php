<div id="flash" class="container col-5">
    <?php Flasher::flash(); ?>
</div>
<div class="main user-profile">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">User Profile</h4>
            <div class="row profile-upper-section">
                <div class="email d-flex justify-content-between align-items-center">
                    <h5 class="col-2">Email</h5>
                    <input class="form-control col" type="email" placeholder="<?= $data['user']['email']; ?>" disabled>
                </div>
                <form action="<?= BASEURL; ?>/blog/editProfile/editProfile" method="POST" enctype="multipart/form-data">
                    <div class="username d-flex justify-content-between align-items-center">
                        <h5 class="col-2">Username</h5>
                        <input class="form-control" type="text" value="<?= $data['user']['username']; ?>" name="username" autocomplete="off">
                    </div>
                    <div class="profile-picture d-flex justify-content-between">
                        <h5 class="col-2">Profile Picture</h5>
                        <div class="col">
                            <div class="row">
                                <figure class="col-3">
                                    <img src="<?= BASEURL . '/img/userProfilePicture/' . $data['user']['profile_picture']; ?>" alt="<?= $data['user']['profile_picture']; ?>">
                                </figure>
                                <div class="col">
                                    <input class="form-control form-control-sm" type="file" name="profilePicture">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row profile-bottom-section">
            <div class="d-flex align-items-center justify-content-end">
                <a href="<?= BASEURL; ?>/blog/settings">Cancel</a>
                <button type="submit" class="btn btn-primary">Edit Profile</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="main user-profile">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">User Profile</h4>
            <div class="d-flex container px-5 py-3">
                <div>
                    <figure>
                        <img src="<?= BASEURL . '/img/userProfilePicture/' . $data['user']['profile_picture']; ?>" id="user-profile-picture" alt="<?= $data['user']['profile_picture']; ?>">
                    </figure>
                </div>
                <div>
                    <div class="user-info">
                        <h5 class="mt-5"><?= $data['user']['username']; ?></h5>
                        <p><?= $data['user']['email']; ?></p>
                        <p>Member since <?= date('F j, Y', strtotime($data['user']['created_at'])); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
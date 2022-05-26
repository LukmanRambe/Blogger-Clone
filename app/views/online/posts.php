<div class="sidebar">
    <figure class="container text-center">
        <img src="<?= BASEURL . '/img/userProfilePicture/' . $data['user']['profile_picture'] ?>" alt="">
        <figcaption><?= $data['user']['username']; ?></figcaption>
    </figure>
    <div class=" profile-link container text-center">
        <a href="<?= BASEURL . '/online/userProfile/' . $data['user']['id']; ?>">Visit Profile</a>
    </div>
</div>
<div class="main online">
    <div class="posts-list">
        <div class="posts">
            <?php if (empty($data['posts'])) : ?>
                <p>There is no post</p>
            <?php else : ?>
                <?php foreach ($data['posts'] as $post) : ?>
                    <div class="post">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="post-info">
                                    <h4 class="post-title"><?= $post['title']; ?></h4>
                                    <p class="posted-time">Published by <?= $post['username']; ?> - <?= date('F j, Y h.i', strtotime($post['created_at'])); ?></p>
                                </div>
                                <div class="post-action">
                                    <a href="<?= BASEURL . '/online/post/' . $post['post_id'] . '/#comment-input'; ?>" class="float-start">Post a Comment</a>
                                    <a href="<?= BASEURL . '/online/post/' . $post['post_id']; ?>" class="float-end" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $post['title']; ?>" data-bs-animation="true">Read Blog</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
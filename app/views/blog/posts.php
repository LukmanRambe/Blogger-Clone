<div id="flash" class="container col-5">
    <?php Flasher::flash(); ?>
</div>
<div class="main">
    <div class="posts-list">
        <div class="posts">
            <div class="posts-header d-flex justify-content-start">
                <h4>My Posts</h4>
            </div>
            <?php if (empty($data['posts'])) : ?>
                <p>There is no post</p>
            <?php else : ?>
                <?php foreach ($data['posts'] as $post) : ?>
                    <div class="post">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="float-start post-info">
                                    <h4 class="post-title"><?= $post['title']; ?></h4>
                                    <p class="posted-time">Published - <?= date('F j, Y', strtotime($post['created_at'])); ?></p>
                                </div>
                                <div class="float-end post-action">
                                    <span>
                                        <a href="<?= BASEURL . '/post/edit/' . $post['post_id']; ?>"><i class="fas fa-edit px-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit post" data-bs-animation="true"></i></a>
                                        <a href="<?= BASEURL . '/online/post/' . $post['post_id']; ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-eye px-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View post" data-bs-animation="true"></i></a>
                                        <a href="<?= BASEURL . '/post/deletePost/' . $post['post_id']; ?>"><i class="fas fa-trash px-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete post" data-bs-animation="true"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
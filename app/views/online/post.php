<div class="sidebar">
    <figure class="container text-center">
        <img src="<?= BASEURL . '/img/userProfilePicture/' . $data['post']['profile_picture']; ?>" alt="">
        <figcaption><?= $data['post']['username']; ?></figcaption>
    </figure>
    <div class="profile-link container text-center">
        <a href="<?= BASEURL . '/online/userProfile/' . $data['post']['user_id']; ?>">Visit Profile</a>
    </div>
</div>
<div class="main online">
    <div class="posts-list">
        <div class="posts">
            <div class="post online">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="post-info">
                            <h4 class="post-title"><?= $data['post']['title']; ?></h4>
                            <p class="posted-time">Published by <?= $data['post']['username']; ?> - <?= date('F j, Y h.i', strtotime($data['post']['created_at'])); ?></p>
                        </div>
                        <article class="post-content">
                            <p><?= $data['post']['content']; ?></p>
                        </article>
                        <hr>
                        <div class="users-comments">
                            <h5>Comments</h5>
                            <?php if (empty($data['comments'])) : ?>
                                <p>There is no comment</p>
                            <?php else : ?>
                                <?php foreach ($data['comments'] as $comment) : ?>
                                    <div class="user-comment d-flex">
                                        <figure class="user-avatar">
                                            <img src="<?= BASEURL . '/img/userProfilePicture/' . $comment['profile_picture']; ?>" alt="User Avatar">
                                        </figure>
                                        <div class="comment-content">
                                            <div class="comment-header mb-1">
                                                <span><?= $comment['username']; ?></span>
                                                <span class="posted-time ms-2">
                                                    <?php

                                                    $estimatedTime = time() - strtotime($comment['created_at']);
                                                    $minutes       = round($estimatedTime / 60);
                                                    $hours         = round($estimatedTime / (60 * 60));
                                                    $days          = round($estimatedTime / (60 * 60 * 24));
                                                    $weeks         = round($estimatedTime / (60 * 60 * 24 * 7));
                                                    $months        = round($estimatedTime / (60 * 60 * 24 * 30));
                                                    $years         = round($estimatedTime / (60 * 60 * 24 * 30 * 12));

                                                    if ($estimatedTime < 60) {
                                                        echo 'Just now';
                                                    } else if ($minutes < 60) {
                                                        echo $minutes . ($minutes == 1 ? ' minute' : ' minutes') . ' ago';
                                                    } else if ($hours < 24) {
                                                        echo $hours . ($hours == 1 ? ' hour' : ' hours') . ' ago';
                                                    } else if ($days <= 7) {
                                                        echo $days . ($days == 1 ? ' day' : ' days') . ' ago';
                                                    } else if ($weeks <= 4.3) {
                                                        echo $weeks . ($weeks == 1 ? ' week' : ' weeks') . ' ago';
                                                    } else if ($months <= 12) {
                                                        echo $months . ($months == 1 ? ' month' : ' months') . ' ago';
                                                    } else {
                                                        echo $years . ($years == 1 ? ' year' : ' years') . ' ago';
                                                    }

                                                    ?>
                                                </span>
                                            </div>
                                            <div class="comment-body">
                                                <p><?= $comment['comment']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <hr>
                        <div id="flash" class="container flash col-5">
                            <?php Flasher::flash(); ?>
                        </div>
                        <div class="comment-input" id="comment-input">
                            <form action="<?= BASEURL . '/online/addComment/' . $data['post']['id']; ?>" method="POST" id="comment-input">
                                <label for="comment" class="mb-2">Comment as <?= $_SESSION['username']; ?></label>
                                <textarea type="text" id="commentInput" class="form-control" name="comment" placeholder="Type your comment..."></textarea>
                                <button type="submit" id="submitComment" class="btn btn-primary">Publish</button>
                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
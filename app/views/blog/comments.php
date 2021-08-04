<div id="flash" class="container col-5">
    <?php Flasher::flash(); ?>
</div>
<div class="main">
    <div class="comments-list">
        <div class="users-comments">
            <div class="comments-header d-flex justify-content-start">
                <h4>My Comments</h4>
            </div>
            <?php if (empty($data['comments'])) : ?>
                <p>There is no comment</p>
            <?php else : ?>
                <?php foreach ($data['comments'] as $comment) : ?>
                    <div class="comment">
                        <div class="card shadow">
                            <div class="card-header comment-header">
                                <div class="float-start">
                                    <p><a href="<?= BASEURL . '/online/userProfile/' .  $comment['user_id']; ?>"><?= $comment['username']; ?></a> commented on <a href="<?= BASEURL . '/online/post/' . $comment['post_id']; ?>" target="_blank" rel="noopener noreferrer">"<?= $comment['post_title']; ?>"</a></p>
                                    <p class="posted-time">
                                        <?php

                                        $estimatedTime = time() - strtotime($comment['created_at']);

                                        if ($estimatedTime < 60) {
                                            echo 'Just now';
                                        } else {
                                            $minutes      = round($estimatedTime / 60);
                                            $hours        = round($estimatedTime / (60 * 60));
                                            $days         = round($estimatedTime / (60 * 60 * 24));
                                            $weeks        = round($estimatedTime / (60 * 60 * 24 * 7));
                                            $months       = round($estimatedTime / (60 * 60 * 24 * 30));
                                            $years        = round($estimatedTime / (60 * 60 * 24 * 30 * 12));

                                            if ($minutes < 60) {
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
                                        }

                                        ?>
                                    </p>
                                </div>
                                <div class="float-end comment-action">
                                    <a href="<?= BASEURL . '/blog/deleteComment/' . $comment['comment_id']; ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete comment"><i class="fas fa-trash px-2"></i></a>
                                </div>
                            </div>
                            <div class="card-body comment-body">
                                <?php if (strlen($comment['comment']) >= 50) : ?>
                                    <p class="card-text">"<?= $comment['comment']; ?>..."</p>
                                <?php else : ?>
                                    <p class="card-text">"<?= $comment['comment']; ?>"</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
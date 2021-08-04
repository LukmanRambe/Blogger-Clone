<div class="edit-post">
    <div id="flash" class="container flash col-5">
        <?php Flasher::flash(); ?>
    </div>
    <div class="container card shadow">
        <div class="card-body">
            <h4 class="card-title text-center">Edit Post</h4>
            <form action="<?= BASEURL . '/post/editPost/' . $data['post']['id']; ?>" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" value="<?= $data['post']['title']; ?>">
                </div>
                <div class="mb-3">
                    <label for="title">Content</label>
                    <textarea class="form-control" name="content"><?= $data['post']['content']; ?></textarea>
                </div>
                <div class="card-action mt-3 d-flex justify-content-center align-items-center text-center">
                    <div class="col-6">
                        <a href="<?= BASEURL; ?>/blog/posts">Cancel</a>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
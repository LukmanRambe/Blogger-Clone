<div class="create-post">
    <div id="flash" class="container col-5">
        <?php Flasher::flash(); ?>
    </div>
    <div class="container card shadow">
        <div class="card-body">
            <h4 class="card-title text-center">Create New Post</h4>
            <form action="<?= BASEURL; ?>/post/createPost" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" placeholder="Title" autofocus>
                </div>
                <div class="mb-3">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" placeholder="Enter your content"></textarea>
                </div>
                <div class="card-action mt-3 d-flex justify-content-between col-12 align-items-center text-center">
                    <div class="col-6">
                        <a href="<?= BASEURL; ?>/blog/posts">Cancel</a>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Create Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
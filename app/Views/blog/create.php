<div class="blog-save-wrapper container h-100">

    <div class="row justify-content-center align-items-center h-100">

        <div class="col-md-8 col-xs-12 m-3 pt-5 pb-5 bg-white" align="center">

            <div class="container">

                <form action="<?php echo base_url('blogs/create') ?>" method="post" autocomplete="off">

                    <h1 class="mb-5">Create a blog</h1>

                    <div class="form-group">
                        <label for="email">Title</label>
                        <input class="form-control" type="text" name="title" placeholder="Title" value="<?= set_value('title'); ?>" />

                        <?php if (isset($errors) && isset($errors['title'])): ?>

                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $errors['title']; ?>
                            </div>

                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Content</label>
                        <textarea class="form-control" name="body" placeholder="Content" rows="5"></textarea>

                        <?php if (isset($errors) && isset($errors['body'])): ?>

                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $errors['body']; ?>
                            </div>

                        <?php endif ?>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-secondary w-100 mt-3" type="submit">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="blog-single-wrapper container h-100">

    <div class="row justify-content-center align-items-center h-100">

        <div class="col-md-8 col-xs-12 m-3 pt-5 pb-5 bg-white" align="center">

            <div class="container">

                <?php if(isset($post)): ?>
                    <h1><?php echo $post['title'] ?></h1>
                    <p><strong><?php echo date("d/m/Y H:i A", strtotime($post['created_at'])); ?></strong></p>
                <?php endif ?>

                <?php if (session()->has("login_data")): ?>
                    <a class="btn btn-warning mb-5" href="<?php echo base_url('blogs/' . $post['slug'] . '/edit') ?>">Edit</a>
                    <a class="btn btn-danger mb-5" href="<?php echo base_url('blogs/' . $post['slug'] . '/delete') ?>">Delete</a>
                <?php endif; ?>

                <a class="btn btn-primary mb-5" href="<?php echo base_url('blogs') ?>">Back</a>

                <div class="posts">

                    <div class="container-fluid">

                        <div class="row">

                            <?php if(isset($post)): ?>

                                <div class="col-12 blog-post" align="left">
                                    <?php foreach(preg_split("/\r\n|\n|\r/", $post['body']) as $line): ?>
                                        <p class="m-0"><?php echo $line; ?></p>
                                    <?php endforeach; ?>
                                </div>

                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
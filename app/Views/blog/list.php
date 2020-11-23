<div class="blog-list-wrapper container h-100">

    <div class="row justify-content-center align-items-center h-100">

        <div class="col-md-8 col-xs-12 m-3 pt-5 pb-5 bg-white" align="center">

            <div class="container">

                <h1 class="mb-5">Blog posts</h1>

                <?php if (session()->has("login_data")): ?>
                    <a class="btn btn-primary mb-5" href="<?php echo base_url('blogs/create') ?>">Create new post</a>
                    <a class="btn btn-primary mb-5" href="<?php echo base_url('account/logout') ?>">Logout</a>
                <?php else: ?>
                    <a class="btn btn-primary mb-5" href="<?php echo base_url('account/login') ?>">Login</a>
                <?php endif; ?>

                <div class="posts">

                    <div class="container-fluid">

                        <div class="row">

                            <?php if(isset($posts) && count($posts) > 0): ?>

                                <?php foreach ($posts as $post): ?>
                                    <div class="col-12 blog-post" align="left">
                                        <h2><?php echo $post['title']; ?></h2>
                                        <p><strong><?php echo date("d/m/Y H:i A", strtotime($post['created_at'])); ?></strong></p>
                                        <p><?php echo substr($post['body'], 0, strpos($post['body'], ' ', 150)); ?></p>
                                        <a href="<?php echo base_url('blogs/' . $post['slug']) ?>">View post</a>
                                    </div>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <p>There are no blogs!</p>
                            <?php endif; ?>
                        </div>

                       <?php if (isset($pager)): ?>

                           <div class="row">

                               <div class="pages col-12 p-0" align="left">
                                   <?php $pagi_path = '/blogs'; ?>
                                   <?php $pager->setPath($pagi_path); ?>
                                   <p>Pages </p>
                                   <?= $pager->links() ?>
                               </div>
                           </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
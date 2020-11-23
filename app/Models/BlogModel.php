<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model {

    protected $table = 'blog_posts';

    protected $allowedFields = [ 'title', 'body', 'slug' ];

    public function getBlogBySlug($slug) {
        return $this->asArray()->where(['slug' => $slug])->first();
    }
}

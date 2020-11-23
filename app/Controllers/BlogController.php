<?php namespace App\Controllers;

use App\Models\BlogModel;

class BlogController extends BaseController
{

    /**
     * Handle default page.
     */
	public function index()
	{

	    $model = new BlogModel();

	    // Load blog posts
	    $data = [
	        'posts' => $model->paginate(5),
            'pager' => $model->pager
        ];

	    // Blog listing
        echo view('templates/header', $data);
		echo view('blog/list');
	}

    /**
     * Create a new post.
     *
     * @return bool|\CodeIgniter\HTTP\RedirectResponse
     * @throws \ReflectionException
     */
	public function create() {

	    // Check if user is not logged in, to stop access to this page.
        if (!session()->has("login_data"))
            return redirect()->to('/');

        helper(['form']);

        $model = new BlogModel();

        // Validate rules
        $validation = [
            'title' => 'required|min_length[5]|max_length[225]',
            'body' => 'required'
        ];

        // Check if validation failed.
        if (!$this->validate($validation)) {
            // Blog Creator listing

            // Store errors.
            $data['errors'] = $this->validator->getErrors();

            // Show appropriate views.
            echo view('templates/header', $data);
            echo view('blog/create');
        } else {

            // Save the post.
            $model->save([
                'title' => $this->request->getVar('title'),
                'body' => $this->request->getVar('body'),
                'slug' => url_title(strtolower($this->request->getVar('title'))),
            ]);

            // Redirect to the main listing page
            return redirect()->to('/');
        }

        return false;
    }

    /**
     *
     * Edit a post by slug.
     *
     * @param $slug - slug.
     * @return bool|\CodeIgniter\HTTP\RedirectResponse
     * @throws \ReflectionException
     */
    public function edit($slug) {

        // Check if user is not logged in, to stop access to this page.
        if (!session()->has("login_data"))
            return redirect()->to('/');

        helper(['form']);

        $model = new BlogModel();

        // Validate rules
        $validation = [
            'title' => 'required|min_length[5]|max_length[225]',
            'body' => 'required',
            'slug' => 'required|min_length[5]|max_length[50]'
        ];

        // Check if validation failed.
        if (!$this->validate($validation)) {
            // Blog Creator listing

            // Store post and errors to pull in specific fields.
            $data['post'] = $model->getBlogBySlug($slug);
            $data['errors'] = $this->validator->getErrors();

            // Blog listing
            echo view('templates/header', $data);
            echo view('blog/edit');
        } else {

            // Update blog post data.
            $found_data = $model->getBlogBySlug($slug);
            $update_data = [
                'id' => $found_data['id'],
                'title' => $this->request->getVar('title'),
                'body' => $this->request->getVar('body'),
                'slug' => url_title(strtolower($this->request->getVar('slug'))),
            ];

            $model->save($update_data);

            // Redirect back to the blog.
            return redirect()->to('/blogs/' . $update_data['slug']);
        }

        return false;
    }

    /**
     * Delete a blog post by slug.
     * @param $slug - slug.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($slug) {

        // Check if user is not logged in, to stop access to this page.
        if (!session()->has("login_data"))
            return redirect()->to('/');

        $model = new BlogModel();

        // Get the data for the blog so I can get the id.
        $found_data = $model->getBlogBySlug($slug);

        // Delete the blog post.
        $model->delete([
            'id' => $found_data['id']
        ]);

        // Blog listing
        echo view('templates/header');
        return redirect()->to('/blogs');
    }

    /**
     * Get the single page of a post.
     * @param $slug
     */
    public function get($slug) {
        $model = new BlogModel();
        $data['post'] = $model->getBlogBySlug($slug);

        // Blog listing
        echo view('templates/header', $data);
        echo view('blog/single');
    }
}

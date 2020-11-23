<?php namespace App\Controllers;

use App\Models\BlogModel;

class BlogController extends BaseController
{
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

	public function create() {

        if (!session()->has("login_data"))
            return redirect()->to('/');

        helper(['form']);

        $model = new BlogModel();

        $validation = [
            'title' => 'required|min_length[5]|max_length[225]',
            'body' => 'required'
        ];

        if (!$this->validate($validation)) {
            // Blog Creator listing

            $data['errors'] = $this->validator->getErrors();

            echo view('templates/header', $data);
            echo view('blog/create');
        } else {

            $model->save([
                'title' => $this->request->getVar('title'),
                'body' => $this->request->getVar('body'),
                'slug' => url_title(strtolower($this->request->getVar('title'))),
            ]);

            session()->setFlashdata('success', "Your post has been created!");
            return redirect()->to('/');
        }

        return false;
    }

    public function edit($slug) {

        if (!session()->has("login_data"))
            return redirect()->to('/');

        helper(['form']);

        $model = new BlogModel();

        $validation = [
            'title' => 'required|min_length[5]|max_length[225]',
            'body' => 'required',
            'slug' => 'required|min_length[5]|max_length[50]'
        ];

        if (!$this->validate($validation)) {
            // Blog Creator listing

            $data['post'] = $model->getBlogBySlug($slug);
            $data['errors'] = $this->validator->getErrors();

            // Blog listing
            echo view('templates/header', $data);
            echo view('blog/edit');
        } else {

            $found_data = $model->getBlogBySlug($slug);
            $update_data = [
                'id' => $found_data['id'],
                'title' => $this->request->getVar('title'),
                'body' => $this->request->getVar('body'),
                'slug' => url_title(strtolower($this->request->getVar('slug'))),
            ];

            $model->save($update_data);

            session()->setFlashdata('success', "Your post has been updated!");
            return redirect()->to('/blogs/' . $update_data['slug']);
        }

        return false;
    }

    public function delete($slug) {

        if (!session()->has("login_data"))
            return redirect()->to('/');

        $model = new BlogModel();

        $found_data = $model->getBlogBySlug($slug);

        $model->delete([
            'id' => $found_data['id']
        ]);

        // Blog listing
        echo view('templates/header');
        return redirect()->to('/blogs');
    }

    public function get($slug) {
        $model = new BlogModel();
        $data['post'] = $model->getBlogBySlug($slug);

        // Blog listing
        echo view('templates/header', $data);
        echo view('blog/single');
    }
}

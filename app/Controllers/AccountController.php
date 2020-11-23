<?php namespace App\Controllers;

use App\Models\AccountModel;

class AccountController extends BaseController
{
	public function index()
	{
		$data = [];

		helper(['form']);

		if ($this->request->getMethod() === 'post') {

		    $validation = [
		        'email' => 'required|valid_email',
                'password' => 'required|min_length[8]|max_length[255]'
            ];

		    $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

		    if ($this->validate($validation)) {
		        $model = new AccountModel();
		        $logged_in_data = $model->login($email, $password);

                session()->set("login_data", $logged_in_data);
            } else {
                $data['errors'] = $this->validator->getErrors();
            }
        }

		echo view('templates/header', $data);
		echo view('Login', $data);
	}

	//--------------------------------------------------------------------
}

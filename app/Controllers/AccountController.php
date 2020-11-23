<?php namespace App\Controllers;

use App\Models\AccountModel;

class AccountController extends BaseController
{
	public function login()
	{
		$data = [];

		helper(['form']);

		// Stops logging in multiple times
		if (session()->has("login_data")) {
		    // TODO Redirect to admin panel
            return redirect()->to('/');
        }

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

		        if ($logged_in_data) {
                    session()->set("login_data", $logged_in_data);
                    session()->setFlashdata('success', "You have successfully logged in!");
                    return redirect()->to('/');
                }

                $data['errors'] = [
                    "wrong_credentials" => "You entered the wrong email or password."
                ];
            } else {
                $data['errors'] = $this->validator->getErrors();
            }
        }

		echo view('templates/header');
		echo view('Login', $data);
	}

    public function logout() {

	    if (session()->has("login_data"))
	        session()->remove('login_data');

        session()->setFlashdata('success', "You have been logged out!");

        return redirect()->to('/');
    }
}

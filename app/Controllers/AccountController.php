<?php namespace App\Controllers;

use App\Models\AccountModel;

class AccountController extends BaseController
{

    /**
     * Handle login of a user
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function login()
	{
		$data = [];

		helper(['form']);

		// Stops logging in multiple times
		if (session()->has("login_data")) {
            return redirect()->to('/');
        }

		// Handle post method.
		if ($this->request->getMethod() === 'post') {

		    // Requirements
		    $validation = [
		        'email' => 'required|valid_email',
                'password' => 'required|min_length[8]|max_length[255]'
            ];

		    $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Validate email and password meets above requirements.
		    if ($this->validate($validation)) {
		        $model = new AccountModel();
		        $logged_in_data = $model->login($email, $password);

		        // Check if the user is now logged in.
		        if ($logged_in_data) {
                    session()->set("login_data", $logged_in_data);
                    return redirect()->to('/');
                }

		        // Pass wrong credentials error.
                $data['errors'] = [
                    "wrong_credentials" => "You entered the wrong email or password."
                ];
            } else {
                $data['errors'] = $this->validator->getErrors();
            }
        }

		// Show the login view.
		echo view('templates/header');
		echo view('Login', $data);
	}

    /**
     * Handle logout of a user.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function logout() {

        // Check if they are logged in already, then remove.
	    if (session()->has("login_data"))
	        session()->remove('login_data');

        return redirect()->to('/');
    }
}

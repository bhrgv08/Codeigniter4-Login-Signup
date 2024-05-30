<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class User extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [
            'error' => session()->getFlashdata('error')
        ];
        echo view('user/login', $data);
    }

    public function register()
    {
        helper(['form']);
        $data = [
            'validation' => session()->getFlashdata('validation')
        ];
        echo view('user/register', $data);
    }

    public function processRegister()
    {
        $userModel = new UserModel();
        $data = $this->request->getPost();

        if (!$this->validate($userModel->validationRules, $userModel->validationMessages)) {
            $validation = $this->validator;
            session()->setFlashdata('validation', $validation);
            return redirect()->to('/user/register');
        }

        $userModel->save($data);
        return redirect()->to('/user')->with('success', 'Registration successful. You can now login.');
    }

    public function processLogin()
    {
        helper('cookie');
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('/user')->with('error', 'Invalid email or password.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->to('/user')->with('error', 'Invalid email or password.');
        }

        $sessionData = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'isLoggedIn' => true
        ];

        session()->set($sessionData);
        $rememberMe = $this->request->getPost('remember_me');
        if ($rememberMe) {
            $rememberToken = bin2hex(random_bytes(16));
            set_cookie('remember_me', $rememberToken, time() + (86400 * 30)); // 30 days
            // Store the remember token in the database
        }

        return redirect()->to('/dashboard');
    }

    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/user');
        }

        return view('user/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user');
    }

    public function forgotPassword()
    {
        helper(['form']);
        echo view('user/forgot_password');
    }

    public function sendResetLink()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');

        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('/user/forgotPassword')->with('error', 'Email not found in our records.');
        }

        $resetToken = $userModel->generateResetToken($email);

        if (!$resetToken) {
            return redirect()->to('/user/forgotPassword')->with('error', 'Failed to generate reset token.');
        }

        $resetLink = base_url('/user/resetPassword/' . $resetToken);

        // Load the email library
        $email = \Config\Services::email();

        // Configure the email
        $email->setFrom('darkmist274@gmail.com', 'RISA');
        $email->setTo($user['email']);
        $email->setSubject('Password Reset Request');

        // Set the email message
        $message = view('user/reset_password_email', ['resetLink' => $resetLink]);
        $email->setMessage($message);

            // Make sure email content type is set to HTML
        $email->setMailType('html');

        // Send the email
        if ($email->send()) {
            return redirect()->to('/user/forgotPassword')->with('success', 'A password reset link has been sent to your email address.');
        } else {
            $data = $email->printDebugger(['headers']);
            log_message('error', 'Failed to send password reset email. Error: ' . $data);
            return redirect()->to('/user/forgotPassword')->with('error', 'Failed to send password reset email. Please try again.');
        }
    }

    public function resetPassword($resetToken = null)
    {
        helper(['form']);
        $userModel = new UserModel();

        $user = $userModel->validateResetToken($resetToken);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'Invalid or expired reset token.');
        }

        $data = [
            'resetToken' => $resetToken,
            'validation' => session()->getFlashdata('validation')
        ];

        echo view('user/reset_password', $data);
    }

    public function processResetPassword()
    {
        $userModel = new UserModel();
        $resetToken = $this->request->getPost('reset_token');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $validation = $this->validate([
            'new_password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/]',
            'confirm_password' => 'required|matches[new_password]'
        ], [
            'new_password' => [
                'regex_match' => 'Password must contain at least one uppercase, one lowercase, one digit, and one special character.'
            ]
        ]);

        if (!$validation) {
            session()->setFlashdata('validation', $this->validator);
            return redirect()->to('/user/resetPassword/' . $resetToken);
        }

        $success = $userModel->resetPassword($resetToken, $newPassword);

        if ($success) {
            return redirect()->to('/user')->with('success', 'Your password has been reset successfully.');
        } else {
            return redirect()->to('/user/resetPassword/' . $resetToken)->with('error', 'Failed to reset password. Please try again.');
        }
    }
}
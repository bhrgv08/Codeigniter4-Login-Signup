<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password', 'reset_token', 'reset_token_expired_at'];
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/]',
        'confirm_password' => 'required|matches[password]'
    ];
    protected $validationMessages = [
        'password' => [
            'regex_match' => 'Password must contain at least one uppercase, one lowercase, one digit, and one special character.'
        ]
    ];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }

    public function generateResetToken($email)
    {
        $user = $this->where('email', $email)->first();

        if (!$user) {
            return false;
        }

        $resetToken = bin2hex(random_bytes(32));
        $resetTokenExpiredAt = date('Y-m-d H:i:s', strtotime('+1 day')); // Token valid for 1 day

        $this->update($user['id'], ['reset_token' => $resetToken, 'reset_token_expired_at' => $resetTokenExpiredAt]);

        return $resetToken;
    }

    public function validateResetToken($resetToken)
    {
        $user = $this->where('reset_token', $resetToken)->first();

        if (!$user || strtotime($user['reset_token_expired_at']) < time()) {
            return false;
        }

        return $user;
    }

    public function resetPassword($resetToken, $newPassword)
    {
        $user = $this->validateResetToken($resetToken);

        if (!$user) {
            return false;
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password and reset token
        $this->update($user['id'], [
            // 'password' => $hashedPassword,
            'password' => $newPassword,
            'reset_token' => null,
            'reset_token_expired_at' => null
        ]);

        return true;
    }
}
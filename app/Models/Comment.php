<?php

namespace App\Models;

use App\Core\Model;

class Comment
{
    use Model;

    /**
     * @var string
     */
    protected string $table = 'comments';


    /**
     * @var array|string[]
     */
    protected array $allowedColumns = [
        'subject',
        'name',
        'comment',
        'email',
        'created_at',
    ];


    /**
     * @param $data
     * @return bool
     */
    public function validate($data): bool
    {
        $this->errors = [];

        if (empty($data['email'])) {
            $this->errors['email'] = "email is required";
        } else
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "email is not valid";
            }

        if (empty($data['subject'])) {
            $this->errors['subject'] = "subject is required";
        }

        if (empty($data['comment'])) {
            $this->errors['comment'] = "comment is required";
        }


        if (empty($data['name'])) {
            $this->errors['name'] = "name is required";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}

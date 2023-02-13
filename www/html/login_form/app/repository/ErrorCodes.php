<?php

class ErrorCodes
{
    public const REQUEST_BODY_REQUIRED = [
        'messages' => 'Incorrect request body.',
        'status' => 401,
        'code' => 1
    ];

    public const USER_EMAIL_SYSTEM = [
        'messages' => 'User with email are already registered in the system.',
        'status' => 401,
        'code' => 2
    ];

    public const CHECK_FIELDS = [
        'messages' => 'Please fill in all fields!',
        'status' => 401,
        'code' => 3
    ];

    public const EMAIL_NOT_EXIST = [
        'messages' => 'User with this email not exist!',
        'status' => 401,
        'code' => 5
    ];

    public const WRONG_PASSWORD = [
        'messages' => 'Wrong password!',
        'status' => 401,
        'code' => 6
    ];

    public const EMAIL_NOT_VALIDATION = [
        'messages' => 'User with this email not exist!',
        'status' => 401,
        'code' => 7
    ];

    public const PASSWORDS_NOT_MATCH = [
        'messages' => 'Passwords do not match!',
        'status' => 401,
        'code' => 8
    ];

    public const ERROR_SAVE_USER = [
        'messages' => 'An error occurred while saving, please try again!',
        'status' => 401,
        'code' => 9
    ];
}
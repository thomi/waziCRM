<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Error Messages
    |--------------------------------------------------------------------------
    |
    | The following language lines are used through out the app for various
    | error messages that the API encounters internaly. You're welcome!!
    |
    */

    'AuthError' => "permission denied to perform this action.",
    'MethodNotAllowed' => 'the specified method for the request is invalid',
    'ModelNotFound' => 'no :modelName could be found with the specified ID',
    'SuspiciousOperation' => 'user has performed a suspicious operation from a security perspective.',
    'NotFound' => 'the requested resource could not be found.',
    'QueryException' => 'cannot remove this resource, It\'s related to another resource',
    'ServerError' => 'server error. please try again later',
];

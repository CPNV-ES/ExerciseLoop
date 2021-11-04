<?php

namespace App\Controllers;

abstract class Error
{
    const NOT_FOUND = [
        'code' => 404,
        'message' => "Cette page n'existe pas, vous êtes perdu dans la boucle."
    ];
    const METHOD_NOT_ALLOWED = [
        'code' => 405,
        'message' => "La méthode d'accès utilisée n'est pas autorisée."
    ];
    const INTERNAL_SERVER_ERROR = [
        'code' => 500,
        'message' => "Le serveur a rencontré une condition inattendue qui l'a empêché de répondre à la demande."
    ];
    const DATABASE_ERROR = [
        'code' => 500,
        'message' => "Problème de connexion à la base de données."
    ];
}

class ErrorController extends Controller
{
    /**
     * 
     */
    public function index($error)
    {
        (int) $code = $error['code'];
        (string) $message = htmlspecialchars($error['message']);

        http_response_code($code);

        return $this->render('error', [
            'code' => $code,
            'message' => $message
        ]);
    }
}

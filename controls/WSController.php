<?php

namespace controls;

class WSController
{
    public function __construct()
    {
    }

    public function connexionWS(): void
    {
        $identificationMessage = array(
            'action' => 'identify',
            'id' => $_SESSION['id'] ?? 1,
            'admin' => !empty($_SESSION['admin']),
            'username' => $_SESSION['username'] ?? 'Anonyme',
        );

        // Convertir le tableau associatif en JSON
        $jsonIdentificationMessage = json_encode($identificationMessage);

        echo $jsonIdentificationMessage;
    }
}
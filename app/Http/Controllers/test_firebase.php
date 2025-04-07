<?php

namespace App\Http\Controllers;

require '../../../vendor/autoload.php'; // Path relatif ke autoload.php

use Kreait\Firebase\Factory;

try {
    // Inisialisasi Firebase Firestore
    $firebase = (new Factory)
        ->withServiceAccount(__DIR__ . '/../../../firebase_credentials.json') // Path ke file kredensial
        ->createFirestore();

    echo "Firebase initialized successfully!";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
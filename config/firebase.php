<?php

return [
    'credentials' => env('GOOGLE_APPLICATION_CREDENTIALS', base_path('firebase_credentials.json')),

    'firestore' => [
        'project_id' => env('FIREBASE_PROJECT_ID', 'dombaku-974fe'),
    ],
];

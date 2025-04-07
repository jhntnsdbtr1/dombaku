<?php
require 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

putenv('GOOGLE_APPLICATION_CREDENTIALS=C:/xampp/htdocs/dombaku/firebase_credentials.json');

try {
    // Membuat koneksi ke Firestore
    $firestore = new FirestoreClient([
        'projectId' => 'dombaku-974fe',
    ]);
    echo "✅ Firestore berhasil terhubung!\n";

    // Membuat dokumen dan set data
    $docRef = $firestore->collection('test_collection')->document('test_php');
    $docRef->set([
        'nama' => 'DombaKu',
        'status' => 'Tes via PHP',
        'waktu' => date('Y-m-d H:i:s')
    ]);
    
    echo "✅ Data berhasil ditulis ke Firestore!\n";

    // Verifikasi apakah data berhasil disimpan
    $retrievedDoc = $docRef->snapshot();
    if ($retrievedDoc->exists()) {
        echo "Data berhasil disimpan: \n";
        var_dump($retrievedDoc->data());  // Gunakan var_dump untuk melihat data yang disimpan
    } else {
        echo "Dokumen tidak ditemukan.\n";
    }

} catch (Exception $e) {
    echo "🚨 ERROR: " . $e->getMessage() . "\n";
}

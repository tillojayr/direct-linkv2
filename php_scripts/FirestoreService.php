<?php

require __DIR__.'/vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Firestore\FieldValue;

class FirestoreService
{
    private $firestore;

    public function __construct()
    {
        $serviceAccountPath = __DIR__ . '/app-test-773a5-firebase-adminsdk-ljmal-8836f70d82.json';

        // Initialize Firestore
        $this->firestore = new FirestoreClient([
            'projectId' => 'app-test-773a5',
            'keyFilePath' => $serviceAccountPath
        ]);
    }

    public function insertData($collection, $document, $documentId = null)
    {
        $collectionRef = $this->firestore->collection($collection);

        if($collection == 'employers'){
            $document['posted_jobs'] = [];
        }

        if ($documentId) {
            $docRef = $collectionRef->document($documentId);
            $docRef->set($document);
        } else {
            $docRef = $collectionRef->add($document);
            $documentId = $docRef->id();
        }

        return $documentId;
    }


    public function updateData($collection, $data, $id)
    {
        $documentReference = $this->firestore->collection($collection)->document($id);

        $documentReference->set($data, ['merge' => true]);

        return $id;
    }

    public function fetchData($collection, $id)
    {
        $documentReference = $this->firestore->collection($collection)->document($id);

        $snapshot = $documentReference->snapshot();
        $data = $snapshot->data();

        return $data;
    }

    public function fetchDataWhere($collection, $conditions = [])
    {
        $collectionReference = $this->firestore->collection($collection);

        if (!empty($conditions)) {
            foreach ($conditions as $field => $value) {
                $collectionReference = $collectionReference->where($field, '=', $value);
            }
        }

        $documents = $collectionReference->documents();
        $results = [];
        $count = 0;

        foreach ($documents as $document) {
            if ($document->exists()) {
                $results[$count] = $document->data();
                $results[$count]['id'] = $document->id();
            }
            $count++;
        }

        return $results;
    }

    public function addPostedJobToEmployer($employerId, $jobId)
    {
        $docRef = $this->firestore->collection('employers')->document($employerId);

        // Use Firestore's arrayUnion to add the job ID to the posted_jobs array
        $docRef->update([
            ['path' => 'posted_jobs', 'value' => FieldValue::arrayUnion([$jobId])]
        ]);
    }
}
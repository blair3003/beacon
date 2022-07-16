<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Event;
use App\Models\Trainee;

class DocumentService
{
    public function addDocument($document, $documentable_type, $documentable_id)
    {

        $documentable = $documentable_type::find($documentable_id);

        if ( $documentable->documents->contains( function($doc) use ($document) {
            return $doc->title == $document->getClientOriginalName();
        })) {
            throw new \Exception('Document exists!');
        }

        $doc = new Document([
            'title' => $document->getClientOriginalName(),
            'path' => $document->store('documents', 'public')
        ]);

        $documentable->documents()->save($doc);


    }


}

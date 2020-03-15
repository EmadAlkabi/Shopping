<?php

return [
    'column' => [
        'type'  => 'Type',
        'state' => 'State',
    ],

    'placeholder' => [
        'type'       => 'Select Document Type',
        'state'      => 'Select Document State',
        'image'      => 'Select Document Image',
    ],

    'index' => [
        'title'        => 'Documents',
        'message'      => 'There are no documents to review.',
        'btn-loadMore' => 'Load More'
    ],

    'create' => [
        'title'    => 'Add Document',
        'btn-back' => 'Back To The Student\'s File',
        'btn-send' => "Send",

        'note-after-upload-image' => 'Image quality will be reduced after uploading for display purpose only.',
        'note-image-type'         => 'It should be an image (jpeg, png, bmp, gif, svg, or webp).',
    ],

    'store' => [
        'success' => 'Document successfully created.',
        'failed'  => 'The document was not created, try again.',
    ],

    'share' => [
        'user-documents' => [
            'btn-add'  => 'Add Document',
            'message'  => 'The listener account does not contain any document.',
        ],
    ],

    'components' => [
        'documents' => [
            'btn-view' => 'Click To View Document',

            'modal-error-header' => 'Warning !!!',
            'modal-error-body'   => 'There is no document, please reload the page.',

            'modal-accept-body' => 'Do you agree to accept the document?',
            'modal-reject-body' => 'Do you agree to reject the document?',
            'modal-delete-body' => 'Do you agree to delete the document?',

            'modal-btn-yes' => 'Yes',
            'modal-btn-no'  => 'No',

            'toast-title-accept' => 'Document accepted ',
            'toast-title-reject' => 'Document rejected ',
            'toast-title-delete' => 'Document deleted ',
            'toast-title-error'  => 'Document not found.',
        ]
    ],
];

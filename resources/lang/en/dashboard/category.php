<?php

return [
    "index" => [
        "title"  => "Categories",
        "filter" => [
            "header" => "Categories Filter",
            "all"    => "All Categories",
            "main"   => "Main Categories",
            "sub"    => "Sub Categories"
        ]
    ],

    "create" => [
        "title"    => "Add Category",
        "note"     => "The main category is not under any other category.",
        "btn-send" => "Send"
    ],

    "store" => [
        "success" => "The category was created successfully.",
        "failed"  => "The category was not created, try again."
    ],

    "edit" => [
        "note"         => "The main category is not under any other category.",
        "change-info"  => "Change information",
        "change-image" => "Change image",
        "btn-save"     => "Save"
    ],

    "update" => [
        "success" => "The category was updated successfully.",
        "failed"  => "The category was not updated, try again."
    ],

    "components" => [
        "datatable" => [
            "header-all"  => "All Categories",
            "header-main" => "Main Categories",
            "header-sub"  => "Sub Categories",
            "btn-add"     => "Add",
            "column"      => [
                "number" => "No.",
                "name"   => "Name",
                "parent" => "Parent Category"
            ]
        ]
    ],

    "label" => [
        "name"   => "Name",
        "image"  => "Image",
        "parent" => "Parent Category"
    ],

    "placeholder" => [
        "name"   => "category name",
        "image"  => "select image",
        "parent" => "select parent category"
    ]
];

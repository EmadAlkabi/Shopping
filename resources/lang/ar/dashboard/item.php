<?php

return [
    "index" => [
        "title"  => "المواد",
        "filter" => "فلتر المواد حسب الصنف"
    ],

    "create" => [
        "title"    => "اضافة مادة",
        "fill"     => "التعبئة",
        "note-1"   => "سيضهر اسم المادة اذا كان الاسم الشائع فارغ",
        "note-2"   => "يرجى تفعيل الخيار لملئ الحقول",
        "btn-send" => "ارسال"
    ],

    "store" => [
        "success" => "تم انشاء المادة بنجاح.",
        "failed"  => "لم يتم انشاء المادة، اعد المحاولة.",
    ],

    "edit" => [
        "btn-save" => "حفظ"
    ],

    "update" => [
        "1" => "تم تحديث المادة.",
        "0" => "لم تحدث تغييرات على المادة."
    ],

    "change-deleted" => [
        "success-0" => "تم تفعيل المادة بنجاح.",
        "success-1" => "تم تعطيل المادة بنجاح.",
        "failed-0"  => "لم يتم تفعيل المادة، اعد المحاولة.",
        "failed-1"  => "لم يتم تعطيل المادة، اعد المحاولة."
    ],

    "components" => [
        "datatable" => [
            "header-all"     => "جميع المواد",
            "header-deleted" => "المواد المحذوفة (المؤرشفة)",
            "btn-add"        => "اضافة",
            "column"         => [
                "number"   => "رقم",
                "name"     => "الاسم",
                "quantity&price" => "الكمية والسعر"
            ]
        ],

        "modal-change-deleted" => [
            "header"          => "حالة مادة",
            "active-message"  => "هل تريد تفعيل المادة رقم (:number)؟",
            "disable-message" => "هل تريد تعطيل المادة رقم (:number)؟",
            "error-message"   => "المادة غير موجودة",
            "btn-yes"         => "نعم",
            "btn-no"          => "لا"
        ]
    ],

    "label" => [
        "name"         => "الاسم",
        "public-name"  => "الاسم الشائع (العام)",
        "company"      => "الشركة",
        "tags"         => "الكلمات الدلالية",
        "category"     => "الصنف",
        "barcode"      => "Barcode",
        "code"         => "Code",
        "currency"     => "العملة",
        "details"      => "التفاصيل",
        "main-image"   => "الصورة الرئيسية",
        "other-images" => "صور اخرى",
        "video"        => "الفديو",

        "unit"         => "التعبئة",
        "main-unit"    => "التعبئة الرئيسية"
    ],

    "placeholder" => [
        "name"         => "اسم المادة",
        "public-name"  => "الاسم الشائع (العام)",
        "company"      => "اسم الشركة",
        "tags"         => "اكتب بعض الاسماء الاخرى للمادة لغرض تسهيل عملية البحث",
        "category"     => "اختر الصنف",
        "currency"     => "اختر العملة",
        "details"      => "بعض التفاصيل حول المادة",
        "main-image"   => "اختر الصورة",
        "other-images" => "اختر الصور",
        "video"        => "YouTube Video Id",

        "unit"          => [
            "quantity" => "الكمية او العدد",
            "name"     => "كارتون، قطعه ...",
            "price"    => "السعر",
            "content"  => "التعبئة"
        ],
        "main-unit"    => "اختر التعبئة الرئيسية"
    ]
];

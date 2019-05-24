<?php

return [
    'schema' => [
        'default' => [
            \App\Utilites\Repositories\Criterias\Contracts\DefaultCriteriaDictionary::BY_KEY =>
                \App\Utilites\Repositories\Criterias\DefaultCriterias\ByKey::class,

            \App\Utilites\Repositories\Criterias\Contracts\DefaultCriteriaDictionary::WITH_RELATION =>
                \App\Utilites\Repositories\Criterias\DefaultCriterias\WithRelation::class,

            \App\Utilites\Repositories\Criterias\Contracts\DefaultCriteriaDictionary::BY_RELATION =>
                \App\Utilites\Repositories\Criterias\DefaultCriterias\ByRelation::class,

            \App\Utilites\Repositories\Criterias\Contracts\DefaultCriteriaDictionary::WITH_DELETED =>
                \App\Utilites\Repositories\Criterias\DefaultCriterias\WithDeleted::class,
        ],

        'booking' => [
            \App\Src\Booking\Repository\Contracts\BookingCriteriaDictionary::BY_WORKSHOP_ID =>
                \App\Src\Booking\Repository\Criterias\ByWorkshopID::class,
        ],

        'booking_visitor' => [
            \App\Src\BookingVisitor\Repository\Contracts\BookingVisitorCriteriaDictionary::BY_BOOKING_ID =>
                \App\Src\BookingVisitor\Repository\Criterias\ByBookingID::class,
            \App\Src\BookingVisitor\Repository\Contracts\BookingVisitorCriteriaDictionary::BY_VISITOR_ID =>
                \App\Src\BookingVisitor\Repository\Criterias\ByVisitorID::class,
            \App\Src\BookingVisitor\Repository\Contracts\BookingVisitorCriteriaDictionary::BY_PARENT_ID =>
                \App\Src\BookingVisitor\Repository\Criterias\ByParentID::class,
        ],

        'user' => [],

        'visitor' => [
            \App\Src\Visitor\Repository\Contracts\VisitorCriteriaDictionary::BY_NAME =>
                \App\Src\Visitor\Repository\Criterias\ByName::class,
            \App\Src\Visitor\Repository\Contracts\VisitorCriteriaDictionary::BY_PHONE =>
                \App\Src\Visitor\Repository\Criterias\ByPhone::class,
            \App\Src\Visitor\Repository\Contracts\VisitorCriteriaDictionary::BY_EMAIL =>
                \App\Src\Visitor\Repository\Criterias\ByEmail::class,
        ],

        'workshop' => [
            \App\Src\Workshop\Repository\Contracts\WorkshopCriteriaDictionary::BY_DT_START =>
                \App\Src\Workshop\Repository\Criterias\ByDateTimeStart::class,
            \App\Src\Workshop\Repository\Contracts\WorkshopCriteriaDictionary::ORDER_BY_DT_START =>
                \App\Src\Workshop\Repository\Criterias\OrderByDatetimeStart::class,
        ],

        'weather' => [],

    ],
];

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
        ],

        'user' => [
        ],

    ]
];

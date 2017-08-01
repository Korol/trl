<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

    'modules' =>[

        /////////////////////////////////////////// аплоуд файдлв
        'attachments' => [
            'class' => nemmo\attachments\Module::className(),
            'tempPath' => '@frontend/uploads/temp',
            'storePath' => '@frontend/uploads/store',
            'rules' => [ // Rules according to the FileValidator
                // не более 10!!
                'maxFiles' => 1, // Allow to upload maximum 3 files, default to 3
//                'mimeTypes' => 'image/png', // Only png images
                //'maxSize' => 1024 * 1024 // 1 MB
            ],
            //'tableName' => '{{%attachments}}', // Optional, default to 'attach_file'
        ],


    ],

    'sourceLanguage' => 'en',
    'language' => 'en',

    'components' => [


        'i18n' => [
            'translations' => [
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
            ],
        ],


        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

       /* 'urlManager' => [

            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en', 'he'],
            'ignoreLanguageUrlPatterns' => [
                '#^site/(login|register)#' => '#^(login|register)#',
                '#^api/#' => '#^api/#',
                '#^site/furniture-ajax#' => '#^site/furniture-ajax#',
                '#^site/login#' => '#^site/login#',
                '#^mfiles/markedphoto#' => '#^mfiles/markedphoto#',
            ],
            //'enableDefaultLanguageUrlCode' => true,

//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//            ],
        ],*/



    ],
];

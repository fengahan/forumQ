<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=;dbname=question',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix'=>'community_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'ssl',
                'host' => 'smtp.qq.com',
                'port' => '465',
                'username' => 'studyiris@vip.qq.com',
                'password' => 'jwmscjnjkzdgebac',
            ],

        ],
    ],
];

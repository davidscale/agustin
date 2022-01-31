<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',

            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,

            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'localhost',
                'username' => 'arm.group.utn@gmail.com',
                'password' => 'arm_group@123',
                'port' => '587',
                'encryption' => 'tls',

                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'confirm_peer' => false,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ]
                ]
            ],
        ],
    ],
];

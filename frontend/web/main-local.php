<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Wvbu5-EhKujZU9z7Uld29r1yitf-ZsAjkjhkjhkjhS',
        ],
    ],
];

if (!YII_ENV_TEST) {
    

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;

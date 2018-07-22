# bancodeprovas

Banco de Provas InfoJr UFBA

## Configuração

O arquivo de configuração (para acesso ao banco e envio de emails) está em `app/config.php` com o conteúdo:

~~~ php
<?php
return [
    'siteUrl' => 'siteurl', // com http (ou https)
    'email' => [
        'username' => 'sistemabdp@gmail.com',
        'password' => 'emailpassword',
        'protocol' => 'ssl',
        'port' => 465
        // SSL = Port 465
        // TLS = Port 587
    ],
    'database' => [
        'driver' => 'mysql',
        'mysql' => [
            'host' => 'localhost',
            'database' => 'nomebd',
            'username' => 'userbd',
            'password' => 'passwordbd',
            'charset' => 'utf8',
            'collation' =>'utf8_unicode_ci'
        ]
    ]
];
~~~

## Deploy

Via DeployHQ: `infra+bancodeprovas@infojr.com.br`

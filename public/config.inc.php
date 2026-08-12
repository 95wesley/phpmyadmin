<?php

declare(strict_types=1);

// Função simples para carregar variáveis de arquivo .env
function loadEnvValues(string $filePath): array
{
    $env = [];
    if (file_exists($filePath)) {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }
            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value, " \t\n\r\0\x0B\"'");
                $env[$name] = $value;
            }
        }
    }
    return $env;
}

// 1. Tenta ler o .env local do phpmyadmin; se não existir, tenta o .env do g5
$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    $envFile = __DIR__ . '/../../g5/.env';
}

$envData = loadEnvValues($envFile);

$cfg['blowfish_secret'] = '8d9399030ac961dc3d933dc66a970007';

/* Idioma padrão Português do Brasil */
$cfg['DefaultLang'] = 'pt_BR';
$cfg['Lang'] = 'pt_BR';

$i = 0;

/* Servidor MySQL dinâmico via .env */
$i++;
$cfg['Servers'][$i]['verbose'] = 'MySQL Local (' . ($envData['DB_PORT'] ?? '3307') . ')';
$cfg['Servers'][$i]['host'] = $envData['DB_HOST'] ?? '127.0.0.1';
$cfg['Servers'][$i]['port'] = $envData['DB_PORT'] ?? '3307';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['user'] = $envData['DB_USERNAME'] ?? 'root';
$cfg['Servers'][$i]['password'] = $envData['DB_PASSWORD'] ?? 'password';
$cfg['Servers'][$i]['AllowNoPassword'] = true;

#!/bin/bash

# Função simples para ler variáveis do .env
get_env() {
    local key=$1
    local default_val=$2
    if [ -f .env ]; then
        local val=$(grep -E "^${key}=" .env | tr -d '\r' | cut -d '=' -f2- | cut -d '#' -f1 | xargs)
        if [ -n "$val" ]; then
            echo "$val"
            return
        fi
    fi
    echo "$default_val"
}

PORT=$(get_env "PMA_PORT" "8080")
UPLOAD_LIMIT=$(get_env "PHP_UPLOAD_MAX_FILESIZE" "2048M")
POST_LIMIT=$(get_env "PHP_POST_MAX_SIZE" "2048M")
MEMORY_LIMIT=$(get_env "PHP_MEMORY_LIMIT" "2048M")
EXEC_TIME=$(get_env "PHP_MAX_EXECUTION_TIME" "0")

echo "🚀 Iniciando phpMyAdmin em http://127.0.0.1:$PORT..."
echo "⚙️ Configurações PHP: Upload Max=$UPLOAD_LIMIT | Memory Limit=$MEMORY_LIMIT | Exec Time=Sem Limite (0)"

php -d upload_max_filesize=$UPLOAD_LIMIT \
    -d post_max_size=$POST_LIMIT \
    -d memory_limit=$MEMORY_LIMIT \
    -d max_execution_time=0 \
    -d max_input_time=0 \
    -S 127.0.0.1:$PORT -t ./public

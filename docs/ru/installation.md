## Composer

Рекомендуем установку используя [Composer](https://getcomposer.org/).

В корне вашего проекта запустите:

```bash
composer req GlorifiedKing/laravel-wallet
```

Убедитесь, что проект настроен на [autoload Composer-installed packages](https://getcomposer.org/doc/01-basic-usage.md#autoloading).

## Если вам нужна кастомизация

Иногда это полезно...

### Миграции
Опубликуйте миграции с помощью этой команды artisan:
```bash
php artisan vendor:publish --tag=laravel-wallet-migrations
```

### Конфигурации
Файл конфигурации можно опубликовать с помощью этой команды artisan:
```bash
php artisan vendor:publish --tag=laravel-wallet-config
```

После установки пакета можно перейти к [использованию](basic-usage).

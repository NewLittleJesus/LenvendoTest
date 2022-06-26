# Console Application
#### Тестовое задание для Lenvendo

## Технологический стек

1. Docker 20.10
1. Docker-compose 1.29
1. PHP 8.0
1. Nginx 1.19 (latest)

## Запуск приложения

1. В корневой директории проекта выполнить команду
    ```shell script
    docker-compose up --build -d
    ```
    Если контейнеры не поднимаются - проверьте доступность портов

1. Подключиться к контейнеру с помощью
    ```shell script
    docker-compose exec (название контейнера) bash
    ```
1. Для установки автозагрузки выполните
    ```shell script
    composer install
    ```

1. Для запуска приложения выполните 
    ```shell script
      php public/index.php
    ```

1. Введите название команды, например:
    ```shell script
        Enter the command: command_one
    ```

1. Для остановки контейнеров используйте
    ```
    docker-compose stop
    ```
   
## Библиотека CommandLibrary

Приложение использует библиотеку CommandLibrary, подробнее о ней можно узнать в файле ```readme.md```, лежащем в
директории библиотеки.

Список доступных в приложении команд хранится в константе ```COMMAND_LIST```
интерфейса ```App\Contract\CommandListInterface```.
При добавлении новой команды в приложение, помимо класса команды, нужно добавить команду в эту константу.

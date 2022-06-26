# Command Library

Библиотека реализует функционал добавления консольных команд в приложение.

Для добавления команды в приложение, создайте класс команды, отнаследованный от класса ```AbstractCommand```,
лежащий в неймспейсе ```CommandLibrary\Contract```

В библиотеку включён функционал парсинга входной строки для определения входящей команды, её аргументов и параметров.
Он реализован в классе ```CommandLibrary\Service\CommandService```, который реализует интерфейс
```CommandLibrary\Contract\CommandServiceInterface```.

Для регистрации команд в приложении, вызовите метод ```setCommandList```, передав параметром массив со списком команд,
где ключ элемента — название команды, а значение - класс команды.

Например:
```
[
    command_one => App\Command\CommandOne
]
```
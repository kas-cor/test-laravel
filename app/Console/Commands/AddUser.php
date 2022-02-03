<?php

namespace App\Console\Commands;

use App\Jobs\AddUserJob;
use Illuminate\Console\Command;

class AddUser extends Command
{
    /**
     * @var string Консольная команда
     */
    protected $signature = 'user:add {name?} {email?} {password?}';

    /**
     * @var string Описание команды
     */
    protected $description = 'Добавление пользователя';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function handle()
    {
        if ((!$name = $this->argument('name')) && !$name = $this->ask('Имя')) {
            $this->error("Имя не должно быть пустым...");
            return 1;
        }

        if ((!$email = $this->argument('email')) && !$email = $this->ask('E-mail')) {
            $this->error("E-mail не должен быть пустым...");
            return 1;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error("E-mail не валидный...");
            return 1;
        }

        if ((!$password = $this->argument('password')) && !$password = $this->ask('Пароль')) {
            $this->error("Пароль не должен быть пустым...");
            return 1;
        }

        $this->info('Проверьте данные');
        $this->info('Имя: ' . $name);
        $this->info('E-mail: ' . $email);
        $this->info('Пароль: ' . $password);
        if ($this->confirm('Верно?')) {
            AddUserJob::dispatch($name, $email, $password);

            $this->info("Пользователь будет добавлен.");
        }

        return 0;
    }
}

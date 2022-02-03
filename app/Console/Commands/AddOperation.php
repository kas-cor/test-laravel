<?php

namespace App\Console\Commands;

use App\Jobs\AddOperationJob;
use App\Models\User;
use Illuminate\Console\Command;

class AddOperation extends Command
{
    /**
     * @var string Консольная команда
     */
    protected $signature = 'user:operation {email?} {sum?}';

    /**
     * @var string Описание команды
     */
    protected $description = 'Добавление операции пользователя';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function handle()
    {
        if ((!$email = $this->argument('email')) && !$email = $this->ask('E-mail')) {
            $this->error("E-mail не должен быть пустым...");
            return 1;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error("E-mail не валидный...");
            return 1;
        }

        if (!$user = User::query()->firstWhere('email', $email)) {
            $this->error("Пользователь не найден...");
            return 1;
        }

        if ((!$sum = $this->argument('sum')) && !$sum = $this->ask('Сумма операции')) {
            $this->error("Сумма операции не должена быть пустой...");
            return 1;
        }

        if (!filter_var($sum, FILTER_VALIDATE_FLOAT)) {
            $this->error("Сумма операции не валидная...");
            return 1;
        }

        if ($user->getSum() + $sum < 0) {
            $this->error("Сумма операции выводит баланс в минус...");
            return 1;
        }

        if (!$description = $this->ask('Описание операции')) {
            $this->error("Описание операции не должено быть пустым...");
            return 1;
        }

        AddOperationJob::dispatch($user, $sum, $description);

        $this->info("Операция будет добавлена.");

        return 0;
    }
}

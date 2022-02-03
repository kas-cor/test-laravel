<?php

namespace App\Jobs;

use App\Models\Operation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddOperationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User Пользователь
     */
    protected User $user;

    /**
     * @var float Сумма операции
     */
    protected float $sum;

    /**
     * @var string Описание операции
     */
    protected string $description;

    /**
     * Create a new job instance.
     *
     * @param User $user Пользователь
     * @param float $sum Сумма операции
     * @param string $description Описание операции
     */
    public function __construct(User $user, float $sum, string $description)
    {
        $this->user = $user;
        $this->sum = $sum;
        $this->description = $description;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Operation::create([
            'user_id' => $this->user->id,
            'sum' => $this->sum,
            'description' => $this->description,
        ]);
    }
}

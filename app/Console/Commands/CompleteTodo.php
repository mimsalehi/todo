<?php

namespace App\Console\Commands;

use App\Models\Todo;
use Illuminate\Console\Command;
use Throwable;

class CompleteTodo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Todos that have been completed for two days are automatically completed in the background';

    /**
     * Execute the console command.
     * @throws Throwable
     */
    public function handle()
    {
        $todos = Todo::where('completed', false)
            ->where('created_at', '<=', now()->subDays(2))
            ->cursor();

        /** @var Todo $todo */

        foreach ($todos as $todo){
            $todo->completed = true;
            $todo->saveOrFail();
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CreateTrainer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fitness-api:create:trainer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a Trainer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask("Insert name");
        $surname = $this->ask("Insert surname");
        $username = $this->ask("Insert username");
        $email = $this->ask("Insert email");
        
        $collection = collect(
            [
                'name' => $name,
                'surname' => $surname,
                'username' => $username,
                'email' => $email,
                'active' => 1
            ]
        );

        $request = Request::create('api/create-trainer', 'POST', $collection->toArray());
        $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));

        return 0;
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CreateCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fitness-api:create:course';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a Course';

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
        $limitPartecipant = $this->ask("Insert maximum number of partecipats");
        
        $collection = collect(
            [
                'name' => $name,
                'limitPartecipant' => $limitPartecipant,
                'active' => 1
            ]
        );

        $request = Request::create('api/create-course', 'POST', $collection->toArray());
        $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));

        return 0;
    }
}

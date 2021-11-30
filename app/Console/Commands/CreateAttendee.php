<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CreateAttendee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fitness-api:create:attendee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create an Attendee';

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
        $username = $this->ask("Insert username");
        $email = $this->ask("Insert email");
        
        $collection = collect(
            [
                'username' => $username,
                'email' => $email,
            ]
        );

        $request = Request::create('api/create-attendee', 'POST', $collection->toArray());
        $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));

        return 0;
    }
}

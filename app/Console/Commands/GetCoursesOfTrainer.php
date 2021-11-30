<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Trainer;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class GetCoursesOfTrainer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fitness-api:get:courses-of-trainer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get courses of a specific Trainer';

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
        $trainers = Trainer::where('active', 1)->get();
        $trainersName = collect();

        foreach ($trainers as $trainer) {
            $trainersName->push($trainer->name);
        }

        $trainersName = $trainersName->toArray();
        $selectedTrainer = $this->choice(
            'Select trainer:',
            $trainersName,
            $trainersName[0]
        );
        $trainerId = Trainer::where('name', $selectedTrainer)->pluck('id');

        $collection = collect(['trainer_id' => $trainerId]);
        $request = Request::create('api/get-courses-of-trainer', 'GET', $collection->toArray());
        $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));
    }
}

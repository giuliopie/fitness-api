<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Trainer;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class LinkCourseTrainer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fitness-api:link:course-trainer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to link one course to one trainer';

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
        $courses = Course::where('active', 1)->get();
        $coursesName = collect();

        foreach ($courses as $course) {
            $coursesName->push($course->name);
        }

        $coursesName = $coursesName->toArray();
        $selectedCourse = $this->choice(
            'Select course:',
            $coursesName,
            $coursesName[0]
        );

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

        $join = $this->choice(
            'Do you want to join '.$selectedTrainer.' to '.$selectedCourse.'?',
            ['Yes', 'No'],
            'Yes'
        );

        if($join == 'Yes') {
            $trainerId = Trainer::where('name', $selectedTrainer)->pluck('id');
            $courseId = Course::where('name', $selectedCourse)->pluck('id');

            $collection = collect(
                [
                    'trainer_id' => $trainerId[0],
                    'course_id' => $courseId[0]
                ]
            );
    
            $request = Request::create('api/link-course-trainer', 'POST', $collection->toArray());
            $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));
        } else {
            $this->info('Bye');
        }




    }
}

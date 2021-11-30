<?php

namespace App\Console\Commands;

use App\Models\Attendee;
use App\Models\Course;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class LinkAttendeeCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fitness-api:link:attendee-course';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to link one attendee to one course';

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

        if($courses->count() == 0) return false;

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

        $attendees = Attendee::where('active', 1)->get();

        if($attendees->count() == 0) return false;

        $attendeesName = collect();

        foreach ($attendees as $attendee) {
            $attendeesName->push($attendee->username);
        }

        $attendeesName = $attendeesName->toArray();
        $selectedAttendee = $this->choice(
            'Select attendee:',
            $attendeesName,
            $attendeesName[0]
        );

        $join = $this->choice(
            'Do you want to join '.$selectedAttendee.' to '.$selectedCourse.'?',
            ['Yes', 'No'],
            'Yes'
        );

        if($join == 'Yes') {
            $attendeeId = Attendee::where('username', $selectedAttendee)->pluck('id');
            $courseId = Course::where('name', $selectedCourse)->pluck('id');

            $collection = collect(
                [
                    'attendee_id' => $attendeeId[0],
                    'course_id' => $courseId[0],
                    'active' => 1
                ]
            );
    
            $request = Request::create('api/link-attendee-course', 'POST', $collection->toArray());
            $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));
        } else {
            $this->info('Bye');
        }

    }
}

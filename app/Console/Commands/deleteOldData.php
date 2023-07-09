<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use App\Models\Grade;
use App\Models\Host;
use App\Models\HostAvailable;
use App\Models\Partner;
use App\Models\PasswordReset;
use App\Models\Student;
use App\Models\User;
use App\Models\UserAgent;
use App\Models\UserCode;

class deleteOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:data {year} {--v=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete data older than the specified year';

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
        $year = $this->argument('year');
        $verbos = $this->option('v') != 'false';

        if (!$this->confirm("Are you sure to want deleting all data older than $year ?")) {
            return 0;
        }

        if ($this->confirm("Do you want to backup the database and the documents ?")) {
            $this->call('backup:run');
        }

        echo "Deleting all data older than $year ...\n";

        if ($verbos) {
            DB::enableQueryLog();
        }

        // Tables that contain the semester field
        $models = array(
            'App\Models\RHCourse',
            'App\Models\RHCourseAssignment',
            'App\Models\CourseChoice',
            'App\Models\RHCoursePublish',
            'App\Models\RHCourseLock',
            'App\Models\UnivCourse',
            'App\Models\Dates',
            'App\Models\Evaluation',
            'App\Models\EvaluationEnabled',
            'App\Models\Grade',
            'App\Models\Housing',
            'App\Models\HousingTerm',
            'App\Models\HousingAssignment',
            'App\Models\HousingClosed',
            'App\Models\Internship',
            'App\Models\Student',
            'App\Models\Tutoring',
            'App\Models\UnivReg',
            'App\Models\UnivReg2',
            'App\Models\UnivReg3',
            'App\Models\UnivRegLock',
            'App\Models\UnivRegShow',
            'App\Models\UnivReg',
        );

        foreach ($models as $model) {
            if ($verbos) {
                echo $model . "\n";
            }

            for ($current = 2011; $current < $year; $current++) {

                foreach (array('Spring ', 'Fall ') as $elem) {
                    $semester = $elem . $current;

                    $model::where('semester', $semester)
                        ->orWhereNull('semester')
                        ->delete();
                }
            }
        }

        // Documents
        $students = Student::all();
        $max = $students->max('id');

        $deleted_students = array();

        for ($i = 1; $i < $max; $i++) {
            if (!$students->find($i)) {
                $deleted_students[] = $i;
            }
        }

        Document::whereIn('student', $deleted_students)
            ->orWhereNull('student')
            ->delete();

        $documents = Document::all();
        $max = $documents->max('id');

        $deleted_documents = array();

        for ($i = 1; $i < $max; $i++) {
            if (!$documents->find($i)) {
                $deleted_documents[] = $i;
            }
        }

        if (!empty($deleted_documents)) {

            foreach (scandir(storage_path('app/')) as $folder1) {
                if (!is_numeric($folder1)) {
                    continue;
                }

                foreach (scandir(storage_path('app/') . $folder1) as $folder2) {
                    if (!is_numeric($folder2)) {
                        continue;
                    }

                    foreach ($deleted_documents as $doc) {
                        if (file_exists (storage_path('app/') . $folder1 . '/' . $folder2 . '/' . $doc)) {
                            echo 'Deleting storage/app/' . $folder1 . '/' . $folder2 . '/' . $doc . "\n";
                            unlink(storage_path('app/') . $folder1 . '/' . $folder2 . '/' . $doc);
                        }
                    }

                    if (count(scandir(storage_path('app/') . $folder1 . '/' . $folder2)) == 2) {
                        echo "Deleting folder $folder1/$folder2\n";
                        rmdir(storage_path('app/') . $folder1 . '/' . $folder2);
                    }
                }
                if (count(scandir(storage_path('app/') . $folder1)) == 2) {
                    echo "Deleting folder $folder1\n";
                    rmdir(storage_path('app/') . $folder1);
                }
            }
        }

        // Hosts
        HostAvailable::where('end', '<>', 0)
            ->where('end', '<', $year . '1')
            ->delete();

        $hosts = HostAvailable::all();
        $max = Host::max('id');

        $deleted_hosts = array();

        for ($i = 1; $i < $max; $i++) {
            if (!$hosts->where('logement_id', $i)->first()) {
                $deleted_hosts[] = $i;
            }
        }

        Host::whereIn('id', $deleted_hosts)->delete();

        // Partners
        Partner::where('end', '<>', 0)
            ->where('end', '<', $year . '1')
            ->delete();

        // Users
        $students = Student::pluck('user_id');
        $users = User::where('admin', 0)
            ->whereNotIn('id', $students)
            ->delete();

        $emails = User::pluck('email');
        PasswordReset::whereNotIn('email', $emails)->delete();

        // User agents and user codes
        $userIds = User::pluck('id');
        UserAgent::whereNotIn('user_id', $userIds)->delete();
        UserCode::whereNotIn('user_id', $userIds)->delete();

        if ($verbos) {
            dd(DB::getQueryLog());
        }

        return 0;
    }
}

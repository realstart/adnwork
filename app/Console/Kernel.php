<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Poster;
use App\Models\Contact;
use App\User;
use Illuminate\Support\Facades\Mail;

use App\Mail\AdminSend;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {            
            $temp = date('Y-m-d', strtotime('-30 days'));          
            $all_poster = Poster::where('status','1')->whereDate('created_at',$temp)->get();
            foreach ($all_poster as $item)
            {
                $user_id = $item->user_id;
                $item->status = '3';
                $item->save();
                
                $comment = array();        
                $comment["lname"] = User::find($user_id)->lname;                
                $comment["task_status"] = "del";
                $comment["adminmail"] = Contact::find(1)->support;
                
                $toEmail = User::find($user_id)->email;
               
                Mail::to($toEmail)->send(new AdminSend($comment));
            }               
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Console\Commands;

use App\Mail\sendWelcomeMail;
use App\Models\User;
use Illuminate\Console\Command;

class welcomeMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendWelcomeMail {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command is use for send a mail to recepinet when signup successfully';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        $userDetail = User::selectRaw('tbl_user.id,tbl_user.first_name,tbl_user.last_name,tbl_user.profile_image,tbl_user.email,tbl_user.country_code,tbl_user.phone,tbl_user.otp_code')
            ->where('tbl_user.id',$userId)
            ->first();

        \Mail::to($userDetail->email)->send(new sendWelcomeMail($userDetail));
    
        return 0;
        
        // return Command::SUCCESS;
    }
}
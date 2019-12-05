<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Handler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'handle:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to test slicer with larage data';

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
     * @return mixed
     */
    public function handle()
    {   
        if (!$this->confirm('Do you know what you are doing?')) {
            die();
        }

        $this->line("Menu");
        $this->info("1 to add values");
        $this->info("2 to process values");
        $opt = $this->anticipate('what can I do for you?', ['1', '2']);
        switch($opt)
        {
            case 1:
                $counter = $this->ask('How many values you expect');
                if($counter == 0 || empty($counter))
                {
                    die();
                }
                $this->line("Please wait removing the old values");
                User::truncate();
                $this->info("Adding new values");
                $bar = $this->output->createProgressBar($counter);
                $bar->start();
                for($i = 0; $i<$counter;$i++)
                {
                    $user = $this->createMyUser($i);
                    $bar->advance();
                    //$this->info("$i th user inserted");
                }

                $bar->finish();

            break;
            case 2:
                $i = 0;
                User::orderBy('id')->chunk(10,function($users,$i)
                {   
                    $bar = $this->output->createProgressBar(10);
                    $bar->start();
                    foreach($users as $user)
                    {
                        
                        // echo "\n processing";
                        // echo $user->name;
                        $bar->advance();
                    }
                    $i++;
                    $bar->finish();
                    echo "end of my $i th foreach\n\n\n";
                });
            break;
            default:
            break;
        }
        echo "\n";
    }

    public function createMyUser()
    {
        $user = new User();
        $user->name = $this->getMyUsername();
        $user->email = $user->name.rand(1,99).rand(1,99).rand(1,99).rand(1,99).'@yopmail.com';
        $user->password = Hash::make("17091993");
        $user->save();
        return 1;
    }

    public function getMyUsername()
    {
        $names = array(
                'Juan',
                'Luis',
                'Pedro',
                'Akhil',
                'Alen',
                'Liza',
                'priya',
                'Aparna',
                'Gopu',
                'kumar',
                'Laya',
                'Noel',
                'Mithra',
                'Anju',
                'Anu',
                'Anetta',
                'Bindhu',
                'Bibin',
                'Abin',
                'Amal',
                'Anas'
            );
        return $names[rand(0,count($names)-1)];
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class activateForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'round:activate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate sign form';

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
        $now = date('Y-m-d H:i:00');

        $closest = \App\Round::where('sign_date', $now)->orderBy('date', 'asc')->first();
        
        if($closest && !$closest->form->active){
            $closest->form->active = 1;
            $closest->form->save();
        }
    }
}

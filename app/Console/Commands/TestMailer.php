<?php

namespace App\Console\Commands;

use App;
use Config;
use Illuminate\Console\Command;
use Mail;

class TestMailer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testmail:run {class} {--locale=?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send test email with the specified class.';

    /**
     * Create a new command instance.
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
        if (!empty($this->option('locale'))) {
            App::setLocale($this->option('locale'));
        }

        $class = $type = $this->argument('class');
        if (!empty($class)) {
            $class = 'App\\Mail\\' . $class;
            try {
                $address = explode(';', Config::get('settings.root_admin'))[0];
                $instance = new $class();
                Mail::to($address)
                    ->send($instance);

                echo "\033[32m Email sent.\033[0m\n";

                return;
            } catch (\Exception $exception) {
                echo "\033[31m ERROR: " . $exception->getMessage() . "\e[0m\n";

                return;
            }
        }
        echo "\033[31m Class is required. Please try `testmail:run {className}`\e[0m\n";
    }
}

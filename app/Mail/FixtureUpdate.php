<?php

namespace App\Mail;

use App\Repositories\MatchRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use URL;

class FixtureUpdate extends BaseMailer
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $this->actionUrl = URL::route('dota2.fixture.index');
        $this->actionText = trans('contents.btn-call-fixtures');

        parent::__construct();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $today = Carbon::tomorrow(config('app.timezone'))
                       ->subSecond(1); // at 23:59:59 because Carbon diff functions do round down
        $matches = MatchRepository::getUpcomingMatchesInRange($today->addDays(3));

        $this->subject('Test fixtures & results update')
             ->view('emails.fixture_test')
             ->with('matches', $matches);

        return parent::build();
    }
}

<?php

namespace App\Http\Controllers\Front;

use App;
use Carbon\Carbon;
use CountryList;
use App\Http\Controllers\Controller as BaseController;
use App\Repositories\MatchRepository;
use Suin\RSSWriter;
use URL;

class FixtureController extends BaseController
{
    public function index()
    {
        return view('match.fixtures');
    }

    public function data($kind)
    {
        $matches = [];
        switch ($kind) {
            case 'live':
                $matches = MatchRepository::getLiveMatches();
                break;
            case 'upcoming':
                $matches = MatchRepository::getUpcomingMatches();
                break;
            case 'recent':
                $matches = MatchRepository::getRecentMatches(config('settings.past_matches_count'));
                break;
        }

        return view('match/_fixtures')->with('matches', $matches);
    }

    public function results()
    {
        $matches = MatchRepository::getRecentMatches();

        return view('match.fixture_results')->with('matches', $matches);
    }

    public function rss($locale)
    {
        App::setLocale($locale);

        $feed = new RSSWriter\Feed();
        $channel = new RSSWriter\Channel();
        $channel->title(trans('contents.channel_title'))
                ->description(trans('contents.channel_description'))
                ->url(URL::route('front.fixture.index'))
                ->language($locale)
                ->ttl(60);

        $last_updated = Carbon::minValue()->timestamp;

        $matches = MatchRepository::getLiveMatches();
        foreach ($matches as $match) {
            $item = new RSSWriter\Item();

            $item->title($this->getRssTitle($match, 'live'))
                 ->description($this->getRssDescription($match, $locale, 'live'))
                 ->pubDate(strtotime($match->updated_at))
                 ->category(trans('pages.live'))
                 ->url($this->getRssUrl($match))
                 ->appendTo($channel);

            $last_updated = max($last_updated, strtotime($match->updated_at));
        }

        $matches = MatchRepository::getUpcomingMatches();
        foreach ($matches as $match) {
            $item = new RSSWriter\Item();

            $item->title($this->getRssTitle($match, 'upcoming'))
                 ->description($this->getRssDescription($match, $locale, 'upcoming'))
                 ->pubDate(strtotime($match->updated_at))
                 ->category(trans('pages.upcoming'))
                 ->url($this->getRssUrl($match))
                 ->appendTo($channel);

            $last_updated = max($last_updated, strtotime($match->updated_at));
        }

        $channel->lastBuildDate($last_updated)
                ->pubDate($last_updated)
                ->appendTo($feed);

        return $feed->render();
    }

    private function getRssTitle($match, $type)
    {
        $title = (empty($match->opponent) ? 'TBD' : $match->opponent->short) . ', ' . $match->tournament->short;
        if ($type == 'upcoming') {
            $title .= ', ' . $match->formatted_schedule;
        }

        return $title;
    }

    private function getRssDescription($match, $locale, $type)
    {
        $desc = (empty($match->opponent) ? 'TBD' : ($match->opponent->name . ' (' . CountryList::getOne($match->opponent->country, $locale) . ') ')) . ', ' . $match->tournament->name;
        if ($type == 'live') {
            $desc .= ', ' . trans('contents.live_now');
        }
        elseif ($type == 'upcoming') {
            $desc .= ', ' . $match->formatted_schedule;
        }

        return $desc;
    }

    private function getRssUrl($match)
    {
        return !empty($match->stream) ? $match->stream : URL::route('front.fixture.index') . '#' . $match->id;
    }
}

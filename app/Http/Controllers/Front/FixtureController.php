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
        return view('front.fixtures');
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
                $matches = MatchRepository::getRecentMatches(config('settings.past-matches-count'));
                break;
        }

        return view('front/_fixtures')->with('matches', $matches);
    }

    public function results()
    {
        $matches = MatchRepository::getRecentMatches();

        return view('front.fixture_results')->with('matches', $matches);
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

            $item->title((empty($match->opponent) ? 'TBD' : $match->opponent->short) . ', ' . $match->tournament->short)
                 ->description((empty($match->opponent) ? 'TBD' : ($match->opponent->name . ' (' . CountryList::getOne($match->opponent->country, $locale) . ') ')) . ', ' . $match->tournament->name . ', ' . trans('contents.live_now'))
                 ->pubDate(strtotime($match->updated_at))
                 ->category(trans('pages.live'))
                 ->url(!empty($match->stream) ? $match->stream : URL::route('front.fixture.index') . '#' . $match->id)
                 ->appendTo($channel);

            $last_updated = max($last_updated, strtotime($match->updated_at));
        }

        $matches = MatchRepository::getUpcomingMatches();
        foreach ($matches as $match) {
            $item = new RSSWriter\Item();

            $item->title((empty($match->opponent) ? 'TBD' : $match->opponent->short) . ', ' . $match->tournament->short . ', ' . $match->formatted_schedule)
                 ->description((empty($match->opponent) ? 'TBD' : ($match->opponent->name . ' (' . CountryList::getOne($match->opponent->country, $locale) . ') ')) . ', ' . $match->tournament->name . ', ' . $match->formatted_schedule)
                 ->pubDate(strtotime($match->updated_at))
                 ->category(trans('pages.upcoming'))
                 ->url(!empty($match->stream) ? $match->stream : URL::route('front.fixture.index') . '#' . $match->id)
                 ->appendTo($channel);

            $last_updated = max($last_updated, strtotime($match->updated_at));
        }

        $matches = MatchRepository::getRecentMatches();
        foreach ($matches as $match) {
            $item = new RSSWriter\Item();

            $item->title((empty($match->opponent) ? 'TBD' : $match->opponent->short) . ', ' . $match->tournament->short . ', ' . $match->for . ' - ' . $match->against)
                 ->description((empty($match->opponent) ? '?' : ($match->opponent->name . ' (' . CountryList::getOne($match->opponent->country, $locale) . ') ')) . ', ' . $match->tournament->name . ', ' . $match->date . ', ' . $match->for . ' - ' . $match->against)
                 ->pubDate(strtotime($match->updated_at))
                 ->category(trans('pages.recent'))
                 ->url(!empty($match->stream) ? $match->stream : URL::route('front.fixture.index') . '#' . $match->id)
                 ->appendTo($channel);

            $last_updated = max($last_updated, strtotime($match->updated_at));
        }

        $channel->lastBuildDate($last_updated)
                ->pubDate($last_updated)
                ->appendTo($feed);

        return $feed->render();
    }
}

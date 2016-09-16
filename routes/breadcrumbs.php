<?php
use DaveJamesMiller\Breadcrumbs\Generator;

// Home / Dashboard
    Breadcrumbs::register('home', function (Generator $breadcrumbs) {
        $breadcrumbs->push(trans('pages.back_dashboard'), route('back.dashboard'));
    });

// Home > Authenticated User Profile
    Breadcrumbs::register('user_profile', function (Generator $breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push(trans('pages.profile'), route('back.profile'));
    });
// Home > Profile > User Settings
    Breadcrumbs::register('user_settings', function (Generator $breadcrumbs) {
        $breadcrumbs->parent('user_profile');
        $breadcrumbs->push(trans('pages.settings'), route('back.user_settingss'));
    });

/** Staffs */
    Breadcrumbs::register('manage_staffs', function (Generator $breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push(trans('pages.manage_staffs'), route('back.staff.index'));
    });
    Breadcrumbs::register('create_staff', function (Generator $breadcrumbs) {
        $breadcrumbs->parent('manage_staffs');
        $breadcrumbs->push(trans('pages.create', ['model' => 'Staff']), route('back.staff.create'));
    });
    Breadcrumbs::register('update_staff', function (Generator $breadcrumbs, $staff) {
        $breadcrumbs->parent('manage_staffs');
        $breadcrumbs->push(trans('pages.update', ['model' => 'staff']) . ' ' . $staff['name'], route('back.staff.update', $staff['id']));
    });
    Breadcrumbs::register('delete_staff', function (Generator $breadcrumbs, $staff) {
        $breadcrumbs->parent('manage_staffs');
        $breadcrumbs->push(trans('pages.delete', ['model' => 'staff']) . ' ' . $staff['name'], route('back.staff.delete', $staff['id']));
    });

/** Matches */
    Breadcrumbs::register('manage_matches', function (Generator $breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push(trans('pages.manage_matches'), route('back.match.index'));
    });
    Breadcrumbs::register('create_match', function (Generator $breadcrumbs) {
        $breadcrumbs->parent('manage_matches');
        $breadcrumbs->push(trans('pages.create', ['model' => 'match']), route('back.match.create'));
    });
    Breadcrumbs::register('update_match', function (Generator $breadcrumbs, $match) {
        $breadcrumbs->parent('manage_matches');
        $breadcrumbs->push(trans('pages.update', ['model' => 'match']) . ' ' . $match['formatted_schedule'], route('back.match.update', $match['id']));
    });
    Breadcrumbs::register('delete_match', function (Generator $breadcrumbs, $match) {
        $breadcrumbs->parent('manage_matches');
        $breadcrumbs->push(trans('pages.delete', ['model' => 'match']) . ' ' . $match['formatted_schedule'], route('back.match.delete', $match['id']));
    });

/** Tournaments */
Breadcrumbs::register('manage_tournaments', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('pages.manage_tournaments'), route('back.tournament.index'));
});
Breadcrumbs::register('update_tournament', function (Generator $breadcrumbs, $model) {
    $breadcrumbs->parent('manage_tournaments');
    $breadcrumbs->push(trans('pages.update', ['model' => 'tournament']) . ' ' . $model['name'], route('back.tournament.update', $model['id']));
});
Breadcrumbs::register('delete_tournament', function (Generator $breadcrumbs, $model) {
    $breadcrumbs->parent('manage_tournaments');
    $breadcrumbs->push(trans('pages.delete', ['model' => 'tournament']) . ' ' . $model['name'], route('back.tournament.delete', $model['id']));
});

/** Opponents */
Breadcrumbs::register('manage_opponents', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('pages.manage_opponents'), route('back.opponent.index'));
});
Breadcrumbs::register('update_opponent', function (Generator $breadcrumbs, $model) {
    $breadcrumbs->parent('manage_opponents');
    $breadcrumbs->push(trans('pages.update', ['model' => 'opponent']) . ' ' . $model['name'], route('back.opponent.update', $model['id']));
});
Breadcrumbs::register('delete_opponent', function (Generator $breadcrumbs, $model) {
    $breadcrumbs->parent('manage_opponents');
    $breadcrumbs->push(trans('pages.delete', ['model' => 'opponent']) . ' ' . $model['name'], route('back.opponent.delete', $model['id']));
});

    /*
     * Others
     */
// Home > Site Settings
    Breadcrumbs::register('site_settings', function (Generator $breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push(trans('pages.site_settings'), route('back.siteSettings'));
    });

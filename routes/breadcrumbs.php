<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 15:38.
 */

// Home / Dashboard
    Breadcrumbs::register('home', function ($breadcrumbs) {
        $breadcrumbs->push(trans('pages.home'), route('back.home'));
    });

// Home > Authenticated User Profile
    Breadcrumbs::register('user_profile', function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push(trans('pages.profile'), route('back.profile'));
    });
// Home > Profile > User Settings
    Breadcrumbs::register('user_settings', function ($breadcrumbs) {
        $breadcrumbs->parent('user_profile');
        $breadcrumbs->push(trans('pages.settings'), route('back.user_settingss'));
    });

    /*
     * Staff
     */
// Home > Manage Staffs
    Breadcrumbs::register('manage_staffs', function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push(trans('pages.manage_staffs'), route('back.staff.index'));
    });
// Home > Manage Staffs > Create
    Breadcrumbs::register('create_staff', function ($breadcrumbs) {
        $breadcrumbs->parent('manage_staffs');
        $breadcrumbs->push(trans('pages.create', ['model' => 'Staff']), route('back.staff.create'));
    });
// Home > Manage Staffs > Update
    Breadcrumbs::register('update_staff', function ($breadcrumbs, $staff) {
        $breadcrumbs->parent('manage_staffs');
        $breadcrumbs->push(trans('pages.update', ['model' => 'staff']).' '.$staff['name'], route('back.staff.update', $staff['id']));
    });
// Home > Manage Staffs > Delete
    Breadcrumbs::register('delete_staff', function ($breadcrumbs, $staff) {
        $breadcrumbs->parent('manage_staffs');
        $breadcrumbs->push(trans('pages.delete', ['model' => 'staff']).' '.$staff['name'], route('back.staff.delete', $staff['id']));
    });

    /*
     * Fixtures
     */

// Home > Manage Matches
    Breadcrumbs::register('manage_matches', function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push(trans('pages.manage_matches'), route('back.match.index'));
    });
// Home > Manage Staffs > Create
    Breadcrumbs::register('create_match', function ($breadcrumbs) {
        $breadcrumbs->parent('manage_matches');
        $breadcrumbs->push(trans('pages.create', ['model' => 'match']), route('back.match.create'));
    });
// Home > Manage Staffs > Update
    Breadcrumbs::register('update_match', function ($breadcrumbs, $match) {
        $breadcrumbs->parent('manage_matches');
        $breadcrumbs->push(trans('pages.update', ['model' => 'match']).' '.$match['formatted_schedule'], route('back.match.update', $match['id']));
    });
// Home > Manage Staffs > Delete
    Breadcrumbs::register('delete_match', function ($breadcrumbs, $match) {
        $breadcrumbs->parent('manage_matches');
        $breadcrumbs->push(trans('pages.delete', ['model' => 'match']).' '.$match['formatted_schedule'], route('back.match.delete', $match['id']));
    });

    /*
     * Others
     */
// Home > Site Settings
    Breadcrumbs::register('site_settings', function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push(trans('pages.site_settings'), route('back.siteSettings'));
    });

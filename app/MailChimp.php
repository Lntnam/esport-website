<?php


namespace App;

use DrewM\MailChimp\MailChimp as DrewmMailChimp;

class MailChimp
{
    protected $mc;

    protected $uri = '';

    protected $settings = [];

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    protected $error = [];

    /**
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }

    public function __construct()
    {
        $this->settings = config('services.mailchimp');
        $this->mc = new DrewmMailChimp($this->settings['api_key']);;
    }

    public function getMembers()
    {
        $uri = sprintf("lists/%s/members", $this->settings['list_id']);
        $result = $this->get($uri);
        if (!empty($result)) {
            if (isset($result['members'])) {
                return $result['members'];
            }
            $this->error = $result;
        }
        return false;
    }

    public function createMember($attributes)
    {
        $uri = sprintf("lists/%s/members", $this->settings['list_id']);
        $args = [
            'email_address' => $attributes['email'],
            'status'        => 'subscribed',
            'merge_fields'  => ['FNAME' => isset($attributes['name']) ? $attributes['name'] : ''],
            'interests'     => json_decode($attributes['interests']),
            'ip_signup'     => $attributes['ip_signup'],
            'ip_opt'        => $attributes['ip_opt'],
            'timestamp_opt' => $attributes['created_at'],
            'language'      => $this->settings['language_mapping'][$attributes['language']],
        ];
        $result = $this->post($uri, $args);
        if (!empty($result)) {
            if (isset($result['id'])) {
                return $result;
            }
            $this->error = $result;
        }
        return false;
    }

    /*
     * Basic function wrappers
     */

    public function get($method, $args = array(), $timeout = 10)
    {
        return $this->mc->get($method, $args, $timeout);
    }

    public function post($method, $args = array(), $timeout = 10)
    {
        return $this->mc->post($method, $args, $timeout);
    }

    public function patch($method, $args= array(), $timeout = 10)
    {
        return $this->mc->patch($method, $args, $timeout);
    }

    public function put($method, $args= array(), $timeout = 10)
    {
        return $this->mc->put($method, $args, $timeout);
    }
}
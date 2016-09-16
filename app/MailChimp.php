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

    public function getSingleMember($email)
    {
        $subscriber_hash = $this->mc->subscriberHash($email);
        $uri = sprintf("lists/%s/members/%s", $this->settings['list_id'], $subscriber_hash);
        $result = $this->get($uri);
        if (!empty($result)) {
            if (isset($result['id'])) {
                return $result;
            }
            $this->error = $result;
        }

        return false;
    }

    public function getInterests()
    {
        /* Get all interest categories first */
        $uri = sprintf("lists/%s/interest-categories", $this->settings['list_id']);
        $result = $this->get($uri);
        if (!empty($result)) {
            if (isset($result['categories'])) {
                $categories = $result['categories'];
                $interests = [];

                foreach ($categories as $category) {
                    $uri = sprintf("lists/%s/interest-categories/%s/interests", $this->settings['list_id'], $category['id']);
                    $result = $this->get($uri);
                    if (!empty($result)) {
                        if (isset($result['interests'])) {
                            $interests = array_merge($interests, $result['interests']);
                        }
                    }
                }
                return $interests;
            }
            else {
                $this->error = $result;
            }
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

    public function unsubscribeMember($attributes)
    {
        $subscriber_hash = $this->mc->subscriberHash($attributes['email']);
        $uri = sprintf("lists/%s/members/%s", $this->settings['list_id'], $subscriber_hash);
        $result = $this->mc->patch($uri, ['status' => 'unsubscribed']);
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

    public function get($method, $args = [], $timeout = 10)
    {
        return $this->mc->get($method, $args, $timeout);
    }

    public function post($method, $args = [], $timeout = 10)
    {
        return $this->mc->post($method, $args, $timeout);
    }

    public function patch($method, $args = [], $timeout = 10)
    {
        return $this->mc->patch($method, $args, $timeout);
    }

    public function put($method, $args = [], $timeout = 10)
    {
        return $this->mc->put($method, $args, $timeout);
    }
}
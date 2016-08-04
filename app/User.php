<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * Slack Webhook URL to send admin notifications.
     *
     * @var string
     */
    private $ts3_slack_url = 'https://hooks.slack.com/services/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';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Route notifications for Slack.
     *
     * @return string
     */
    public function routeNotificationForSlack()
    {
        return $this->ts3_slack_url;
    }
}

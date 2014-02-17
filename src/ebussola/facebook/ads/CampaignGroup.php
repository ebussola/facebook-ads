<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 05/02/14
 * Time: 17:48
 */

namespace ebussola\facebook\ads;

/**
 * Interface CampaignGroup
 * @package ebussola\facebook\ads
 *
 * @property string $id
 * @property string $account_id
 * @property string $objective
 * @property string $name
 * @property string $campaign_group_status
 */
interface CampaignGroup {

    const STATUS_DELETED = 'DELETED';
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_PAUSED = 'PAUSED';

    const OBJECTIVE_NONE = 'NONE';
    const OBJECTIVE_OFFER_CLAIMS = 'OFFER_CLAIMS';
    const OBJECTIVE_PAGE_LIKES = 'PAGE_LIKES';
    const OBJECTIVE_CANVAS_APP_INSTALLS = 'CANVAS_APP_INSTALLS';
    const OBJECTIVE_CANVAS_APP_ENGAGEMENT = 'CANVAS_APP_ENGAGEMENT';
    const OBJECTIVE_EVENT_RESPONSES = 'EVENT_RESPONSES';
    const OBJECTIVE_POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const OBJECTIVE_WEBSITE_CONVERSIONS = 'WEBSITE_CONVERSIONS';
    const OBJECTIVE_MOBILE_APP_INSTALLS = 'MOBILE_APP_INSTALLS';
    const OBJECTIVE_MOBILE_APP_ENGAGEMENT = 'MOBILE_APP_ENGAGEMENT';
    const OBJECTIVE_WEBSITE_CLICKS = 'WEBSITE_CLICKS';

}
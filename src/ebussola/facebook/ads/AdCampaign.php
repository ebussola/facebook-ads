<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 18/02/14
 * Time: 14:36
 */

namespace ebussola\facebook\ads;

/**
 * Interface AdCampaign
 * @package ebussola\facebook\ads
 *
 * @property string $id
 * @property string $account_id
 * @property string $objective
 * @property string $name
 * @property string $campaign_group_status
 */
interface AdCampaign {

    const OBJECTVE_NONE = 'NONE';
    const OBJECTVE_OFFER_CLAIMS = 'OFFER_CLAIMS';
    const OBJECTVE_PAGE_LIKES = 'PAGE_LIKES';
    const OBJECTVE_CANVAS_APP_INSTALLS = 'CANVAS_APP_INSTALLS';
    const OBJECTVE_CANVAS_APP_ENGAGEMENT = 'CANVAS_APP_ENGAGEMENT';
    const OBJECTVE_EVENT_RESPONSES = 'EVENT_RESPONSES';
    const OBJECTVE_POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const OBJECTVE_WEBSITE_CONVERSIONS = 'WEBSITE_CONVERSIONS';
    const OBJECTVE_MOBILE_APP_INSTALLS = 'MOBILE_APP_INSTALLS';
    const OBJECTVE_MOBILE_APP_ENGAGEMENT = 'MOBILE_APP_ENGAGEMENT';
    const OBJECTVE_WEBSITE_CLICKS = 'WEBSITE_CLICKS';

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_PAUSED = 'PAUSED';
    const STATUS_DELETED = 'DELETED';

}
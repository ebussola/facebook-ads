<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:04
 */

namespace ebussola\facebook\ads;


class Fields {

    /**
     * @return string
     */
    static public function getAccountFields() {
        return join(',', array(
            'account_groups', 'account_id', 'account_status', 'age', 'agency_client_declaration',
            'amount_spent', 'balance', 'business_city', 'business_country_code', 'business_name',
            'business_state', 'business_street2', 'business_street', 'business_zip', 'capabilities',
            'currency', 'daily_spend_limit', 'is_personal', 'name', 'spend_cap', 'timezone_id', 'timezone_name',
            'timezone_offset_hours_utc', 'tos_accepted', 'users', 'vat_status'
        ));
    }

    /**
     * @return string
     */
    static public function getAdSetFields() {
        $fields = join(',', array(
            'name', 'account_id', 'campaign_status', 'start_time', 'end_time',
            'updated_time', 'created_time', 'daily_budget', 'lifetime_budget', 'budget_remaining'
        ));

        return $fields;
    }

    /**
     * @return string
     */
    static public function getAdGroupFields() {
        $fields = join(',', array(
            'account_id', 'adgroup_status', 'bid_type',
            'bid_info', 'campaign_id', 'conversion_specs', 'created_time', 'creative_ids',
            'adgroup_review_feedback', 'name', 'targeting',
            'tracking_specs', 'updated_time', 'view_tags'
        ));

        return $fields;
    }

    /**
     * @return string
     */
    static public function getCreativeFields() {
        $fields = join(',', array(
            'name', 'type', 'object_id', 'body', 'image_hash',
            'image_url', 'title', 'link_url', 'url_tags', 'preview_url',
            'related_fan_page', 'auto_update', 'story_id', 'action_spec'
        ));

        return $fields;
    }

}
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

}
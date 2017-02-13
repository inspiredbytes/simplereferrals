<?php

namespace Craft;

/**
 * Referral Model
 *
 * Provides a read-only object representing a referral, which is returned
 * by our service class and can be used in our templates and controllers.
 */
class SimpleReferral_ReferralModel extends BaseModel
{

    /**
     * Define the attributes this model will have.
     *
     * @return array
     */
    public function defineAttributes()
    {
        return array(
            'id' => AttributeType::Number,
            'tracking_code' => AttributeType::String,
            'referrer' => AttributeType::String,
        );
    }
}

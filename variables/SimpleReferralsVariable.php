<?php

namespace Craft;

/**
 * Simple Referrals Variable provides access to database objects from templates
 */
class SimpleReferralVariable
{
    /**
     * Get all available referrals
     *
     * @return array
     */
    public function getAllReferrals()
    {
        return craft()->simpleReferrals->getAllReferrals();
    }

    /**
     * Get a specific referral. If no referral is found, returns null
     *
     * @param  int   $id
     * @return mixed
     */
    public function getReferralById($id)
    {
        return craft()->simpleReferrals->getReferralById($id);
    }
}

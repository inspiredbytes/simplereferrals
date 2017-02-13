<?php

namespace Craft;

class CocktailRecipesPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Cocktail Recipes');
    }

    public function getVersion()
    {
        return '1.0';
    }

    public function getDeveloper()
    {
        return 'Samaritan Ministries';
    }

    public function getDeveloperUrl()
    {
        return 'https://samaritanministries.org';
    }

    public function hasCpSection()
    {
        return true;
    }

    /**
     * Register control panel routes
     */
    public function hookRegisterCpRoutes()
    {
        return array(
            'simplereferrals\/referrals\/new' => 'simplereferrals/referrals/_edit',
            'simplereferrals\/referrals\/(?P<referralId>\d+)' => 'simplereferrals/referrals/_edit',
        );
    }
}

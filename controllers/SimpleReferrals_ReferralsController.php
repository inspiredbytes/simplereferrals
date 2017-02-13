<?php

namespace Craft;

/**
 * Referrals Controller
 *
 * Defines actions which can be posted to by forms in our templates.
 */
class SimpleRefarrals_ReferralsController extends BaseController
{
    /**
     * Save Referral
     *
     * Create or update an existing referral, based on POST data
     */
    public function actionSaveReferral()
    {
        $this->requirePostRequest();

        if ($id = craft()->request->getPost('referralId')) {
            $model = craft()->simpleReferral->getReferralById($id);
        } else {
            $model = craft()->simpleReferral->newReferral($id);
        }

        $attributes = craft()->request->getPost('referral');
        $model->setAttributes($attributes);

        if (craft()->simpleReferral->saveReferral($model)) {
            craft()->userSession->setNotice(Craft::t('Referral saved.'));

            return $this->redirectToPostedUrl(array('referralId' => $model->getAttribute('id')));
        } else {
            craft()->userSession->setError(Craft::t("Couldn't save referral."));

            craft()->urlManager->setRouteVariables(array('referral' => $model));
        }
    }

    /**
     * Delete Referral
     *
     * Delete an existing referral
     */
    public function actionDeleteReferral()
    {
        $this->requirePostRequest();
        $this->requireAjaxRequest();

        $id = craft()->request->getRequiredPost('id');
        craft()->simpleReferral->deleteReferralById($id);

        $this->returnJson(array('success' => true));
    }
}

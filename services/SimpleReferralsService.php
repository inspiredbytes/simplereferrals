<?php

namespace Craft;

/**
 * Simple Referrals Service
 *
 * Provides a consistent API for our plugin to access the database
 */
class SimpleReferralsService extends BaseApplicationComponent
{
    protected $referralRecord;

    /**
     * Create a new instance of the Simple Referrals Service.
     * Constructor allows ReferralRecord dependency to be injected to assist with unit testing.
     *
     * @param @referralRecord ReferralRecord The referral record to access the database
     */
    public function __construct($referralRecord = null)
    {
        $this->referralRecord = $referralRecord;
        if (is_null($this->referralRecord)) {
            $this->referralRecord = SimpleReferrals_ReferralsRecord::model();
        }
    }

    /**
     * Get a new blank referral
     *
     * @param  array                           $attributes
     * @return SimpleReferrals_ReferralsModel
     */
    public function newReferral($attributes = array())
    {
        $model = new SimpleReferrals_ReferralsModel();
        $model->setAttributes($attributes);

        return $model;
    }

    /**
     * Get all referrals from the database.
     *
     * @return array
     */
    public function getAllReferrals()
    {
        $records = $this->referralRecord->findAll(array('order'=>'t.id'));

        return SimpleReferrals_ReferralsModel::populateModels($records, 'id');
    }

    /**
     * Get a specific referral from the database based on ID. If no referral exists, null is returned.
     *
     * @param  int   $id
     * @return mixed
     */
    public function getReferralById($id)
    {
        if ($record = $this->referralRecord->findByPk($id)) {
            return SimpleReferrals_ReferralsModel::populateModel($record);
        }
    }

    /**
     * Save a new or existing referral back to the database.
     *
     * @param  SimpleReferrals_ReferralsModel $model
     * @return bool
     */
    public function saveReferral(SimpleReferrals_ReferralsModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->referralRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find referral with ID "{id}"', array('id' => $id)));
            }
        } else {
            $record = $this->referralRecord->create();
        }

        $record->setAttributes($model->getAttributes());
        if ($record->save()) {
            // update id on model (for new records)
            $model->setAttribute('id', $record->getAttribute('id'));

            return true;
        } else {
            $model->addErrors($record->getErrors());

            return false;
        }
    }

    /**
     * Delete a referral from the database.
     *
     * @param  int $id
     * @return int The number of rows affected
     */
    public function deleteReferralById($id)
    {
        return $this->referralRecord->deleteByPk($id);
    }
}

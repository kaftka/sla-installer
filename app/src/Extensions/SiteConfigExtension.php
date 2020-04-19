<?php


namespace SLloyd\Architecture\Extensions;


use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension
{

    private static $has_one = [
        'SiteLogo' => Image::class,
        'SiteLogoDarkMode' => Image::class
    ];

    private static $owns = [
        'SiteLogo',
        'SiteLogoDarkMode'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        parent::updateCMSFields($fields);
        $fields->addFieldsToTab('Root.Style', [
            UploadField::create('SiteLogo'),
            UploadField::create('SiteLogoDarkMode')
                ->setDescription('Upload a logo that is suitable for dark backgrounds')
        ]);
    }

    public function populateDefaults()
    {
        parent::populateDefaults();
        $this->owner->Title = 'Steven Lloyd Architecture Ltd.';
        $this->owner->Tagline = 'Award winning Practice';
    }

}

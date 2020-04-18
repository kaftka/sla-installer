<?php


namespace SLloyd\Architecture\Extensions;


use function GuzzleHttp\Psr7\parse_header;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataExtension;

class ImageExtension extends DataExtension
{
    private static $db = [
        'Caption' => 'Text'
    ];


    public function updateCMSFields(FieldList $fields)
    {
        parent::updateCMSFields($fields);

        $fields->addFieldsToTab('Root.Details', [
            TextareaField::create('Caption')
        ]);
    }

}

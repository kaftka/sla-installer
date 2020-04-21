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

    public function GalleryX($size = 'L')
    {
        if ($this->owner->getOrientation() == 2) {
            return
                ($size == 'S') ? 400 :
                    ($size == 'M') ? 600 :
                        900;
        }
        return
            ($size == 'S') ? 600 :
                ($size == 'M') ? 900 :
                    1350;
    }

    public function GalleryY($size = 'L')
    {
        if ($this->owner->getOrientation() == 2) {
            return
                ($size == 'S') ? 600 :
                    ($size == 'M') ? 900 :
                        1350;
        }
        return
            ($size == 'S') ? 400 :
                ($size == 'M') ? 600 :
                    900;
    }
}

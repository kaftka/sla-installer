<?php


namespace SLloyd\Architecture;


use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;
use SLloyd\Architecture\Elements\GalleryElement;

class ProjectImage extends DataObject
{
    private static $table_name = 'ProjectImage';
    private static $db = [
        'SortOrder' => 'Int',
        'Caption' => 'Text'
    ];

    private static $has_one = [
        'Image' => Image::class,
        'ProjectPage' => ProjectPage::class
    ];

    private static $default_sort = 'SortOrder';

    // It's important that you add the Versioned extension to this!
    private static $extensions = [
        Versioned::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            TextareaField::create('Caption')
        ]);

        return $fields;
    }
}

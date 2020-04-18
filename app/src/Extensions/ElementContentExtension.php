<?php


namespace SLloyd\Architecture\Extensions;


use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class ElementContentExtension extends DataExtension
{
    private static $db = [
        'BreakContainer' => 'Boolean'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        parent::updateCMSFields($fields);
        $fields->removeByName([
            'BreakContainer'
        ]);
        $fields->addFieldsToTab('Root.Main', [
            CheckboxField::create('BreakContainer')
                ->setDescription('By default, content will be displayed in a 900px centred container for ease of reading large bodies of text. Select this if you want your content to be full width.')
        ]);
    }

}

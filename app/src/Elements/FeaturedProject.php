<?php


namespace SLloyd\Architecture\Elements;


use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\DropdownField;
use SLloyd\Architecture\ProjectPage;

class FeaturedProject extends BaseElement
{
    private static $table_name = 'Element_FeaturedProject';

    private static $singular_name = 'Featured Project';

    private static $db = [
        'GetLatest' => 'Boolean'
    ];

    private static $has_one = [
        'Project' => ProjectPage::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('ProjectID');
        $fields->addFieldsToTab('Root.Main', [
            DropdownField::create('ProjectID', 'Project', ProjectPage::get()->map('ID', 'Title'))
        ]);

        return $fields;
    }

    public function getFeaturedProject() {
        if ($this->GetLatest) {
            return ProjectPage::get()->last();
        }
        if ($this->ProjectID) {
            return $this->Project();
        }
    }

    public function getType()
    {
        return 'Featured Project';
    }

}

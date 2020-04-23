<?php


namespace SLloyd\Architecture\Elements;


use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\LiteralField;
use SLloyd\Architecture\ProjectPage;

class ProjectsElement extends BaseElement
{
    private static $table_name = 'Element_ProjectsElement';

    private static $singular_name = 'Projects Element';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            LiteralField::create('a', '<p>This element will display all projects as a grid of images</p>')
        ]);
        return $fields;
    }

    public function getType()
    {
        return 'Projects';
    }


    public function getProjects() {
        $headerArea = $this->getPage()->HeaderElements();
        $featuredProjectElement = FeaturedProject::get()->filter('ParentID', [$headerArea->ID, $this->ParentID]);
        if ($featuredProjectElement->exists()) {
            $projects = ProjectPage::get()->filter('ID:not', $featuredProjectElement->first()->getFeaturedProject()->ID);
        } else {
            $projects = ProjectPage::get();
        }
        return $projects;
    }
}

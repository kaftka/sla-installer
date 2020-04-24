<?php

namespace {

    use DNADesign\Elemental\Extensions\ElementalPageExtension;
    use DNADesign\Elemental\Models\ElementalArea;
    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Forms\HeaderField;

    class Page extends SiteTree
    {
        private static $db = [];


        private static $extensions = [
            ElementalPageExtension::class
        ];

        private static $has_one = [
            'HeaderElements' => ElementalArea::class,
        ];

        private static $owns = [
            'HeaderElements'
        ];


        public function getCMSFields()
        {
            $fields = parent::getCMSFields();
            if ($this->ClassName === 'SilverStripe\CMS\Model\RedirectorPage') {
                return $fields;
            }

            $headerArea = $fields->fieldByName('Root.Main.HeaderElements');
            $fields->removeByName('Root.Main.HeaderElements');
            $fields->addFieldToTab('Root.Main', $headerArea, 'ElementalArea');
            $fields->addFieldToTab(
                'Root.Main',
                HeaderField::create('HeaderBlocksHeader', 'Header blocks'),
                'HeaderElements'
            );
            $fields->addFieldToTab(
                'Root.Main',
                HeaderField::create('ContentBlocksHeader', 'Content blocks'),
                'ElementalArea'
            );

            return $fields;
        }

        public function canDelete($member = null)
        {
            parent::canDelete($member);
            if ($this->URLSegment == 'home') {
                return false;
            }
        }
    }
}

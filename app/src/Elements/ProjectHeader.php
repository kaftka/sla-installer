<?php


namespace SLloyd\Architecture\Elements;


use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\OptionsetField;

class ProjectHeader extends BaseElement
{
    private static $table_name = 'Element_ProjectHeader';

    private static $singular_name = 'Project Header';

    private static $db = [
        'Content' => 'Text',
        'BackgroundColor' => "Enum('White, Primary, Secondary, Black', 'White')",
        'ImagePosition' => "Enum('Left, Right', 'Left')"
    ];

    private static $defaults = [
        'ShowTitle' => 1
    ];

    public function getType()
    {
        return 'Project Header';
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            OptionsetField::create('ImagePosition', 'Image position', $this->dbObject('ImagePosition')->enumValues())
        ]);
        return $fields;
    }

    /**
     * @return bool
     */
    public function InvertBackground() {
        if (in_array($this->BackgroundColor, ['Primary', 'Secondary', 'Black'])) {
            return true;
        }
        return false;
    }

    public function FocusPos($Pos) {
        $image = $this->getImage();
        if ($Pos && $this->ImageType == 'Background' && $image) {
            if ($Pos == 'X') {
                $x = ($this->ImagePosition == 'Left') ? -25 : 25;
                return $image->PercentageX() + $x;
            }
            if ($Pos == 'Y') {
                return $image->PercentageY();
            }
        }
    }

    public function getImage() {
        if ($image = $this->getPage()->FeaturedImage()) {
            return $image;
        }
        return null;
    }

    public function canDelete($member = null)
    {
        return false;
    }
    public function canCreate($member = null, $context = array())
    {
        return false;
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if (!$this->Title) {
            $this->Title = $this->getPage()->Title;
        }
    }

}

<?php


namespace SLloyd\Architecture\Elements;


use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;

class BannerElement extends BaseElement
{
    private static $table_name = 'Element_Banner';

    private static $singular_name = 'Banner';

    private static $db = [
        'BannerSize' => "Enum('Standard, Full-height', 'Standard')",
        'Content' => 'Text',
        'ExternalLink' => 'Varchar(255)',
        'LinkTitle' => 'Varchar(255)',
        'BackgroundColor' => "Enum('Primary, Secondary, White, Black', 'Primary)",
        'ImagePosition' => "Enum('Left, Right', 'Left')",
        'ImageType' => "Enum('Inline, Background', 'Inline')"
    ];

    private static $has_one = [
        'InternalLink' => SiteTree::class,
        'Image' => Image::class
    ];

    private static $owns = [
        'Image'
    ];

    private static $defaults = [
        'ShowTitle' => 1
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'ExternalLink',
            'LinkTitle',
            'InternalLinkID',
            'ImagePosition',
            'ImageType'
        ]);

        $group = FieldGroup::create(
            LiteralField::create('I', '<h3 class="w-100 mb-2">Image style</h3>')
            ->addExtraClass('w-100'),
            OptionsetField::create('ImageType', 'Image position', $this->dbObject('ImageType')->enumValues()),
            OptionsetField::create('ImagePosition', 'Image position', $this->dbObject('ImagePosition')->enumValues())
                ->addExtraClass('ml-4')
        )->addExtraClass('d-flex flex-wrap bg-light p-3');

        $fields->addFieldsToTab('Root.Main', [
            $group,
            TreeDropdownField::create('InternalLinkID', 'Link to a page on your site', SiteTree::class),
            TextField::create('ExternalLink', 'Or paste an external URL'),
            TextField::create('LinkTitle')
        ]);

        return $fields;
    }

    public function getType()
    {
        return 'Banner';
    }

    public function getLinkTitle() {
        if ($this->getField('LinkTitle')) {
            return $this->getField('LinkTitle');
        }
        if ($this->InternalLinkID) {
            return $this->InternalLink()->Title;
        }
        return null;
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
        $image = $this->Image();
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
}

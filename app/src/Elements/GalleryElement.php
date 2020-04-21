<?php


namespace SLloyd\Architecture\Elements;


use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\LiteralField;
use SLloyd\Architecture\ProjectImage;

class GalleryElement extends BaseElement
{
    private static $table_name = 'Element_Gallery';

    private static $singular_name = 'Gallery';

//    private static $inline_editable = false;

    private static $db = [
        'BackgroundColor' => "Enum('Primary, Secondary, White, Black', 'White)",
    ];

    private static $many_many = [
        'Images' => Image::class
    ];

    private static $many_many_extraFields = [
        'SortOrder' => 'Int'
    ];

    private static $owns = [
        'Images'
    ];


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName([
            'Images'
        ]);
        $page = $this->getPage();
        $folder = $page->Title;
        if ($page->ClassName == 'SLloyd\Architecture\ProjectPage') {
            $alert = LiteralField::create('a', '<div class="alert alert-info">Leave the below upload field blank to display this project\'s images in the gallery.</div>');
        } else {
            $alert = LiteralField::create('a', '');
        }
        $fields->addFieldsToTab('Root.Main', [
            $alert,
            $uploadField = SortableUploadField::create('Images', 'Images')
                ->setFolderName("Uploads/Galleries/$folder/Images")
        ]);
        return $fields;
    }


    public function getGalleryImages() {
        $page = $this->getPage();
        if (!$this->Images()->exists() && $page->ClassName == 'SLloyd\Architecture\ProjectPage') {
            return $page->Images();
        }
        return $this->Images();
    }


    public function getType()
    {
        return 'Gallery';
    }

}

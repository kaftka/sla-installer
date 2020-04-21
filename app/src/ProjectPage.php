<?php


namespace SLloyd\Architecture;


use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\ElementContent;
use Page;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\PaginatedList;
use SLloyd\Architecture\Elements\BannerElement;
use SLloyd\Architecture\Elements\FeaturedProject;
use SLloyd\Architecture\Elements\GalleryElement;
use SLloyd\Architecture\Elements\ProjectHeader;

class ProjectPage extends Page
{

    private static $table_name = 'ProjectPage';

    private static $can_be_root = false;

    private static $show_in_sitetree = false;

    private static $summary_fields = [
        'getThumbnail',
        'Title',
        'ShortDescription'
    ];

    private static $db = [
        'ProjectTitle' => 'Text',
        'ShortDescription' => 'Text',
        'Description' => 'HTMLText'
    ];

    private static $has_many = [
        'FeaturedProjectElements' => FeaturedProject::class
    ];

    private static $many_many = [
        'Images' => [
            'through' => ProjectImage::class,
            'from' => 'ProjectPage',
            'to' => 'Image',
        ]
    ];

    private static $owns = [
        'Images'
    ];

    // This is required to publish deletions as well,
    // as this will not happen by default!
    private static $cascade_deletes = [
        'Images'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'ProjectTitle',
            'Images'
        ]);


        if (!$this->isInDB() || $this->Title == 'New Project Page') {
            $uploadField = LiteralField::create('', '<div class="alert alert-warning">Save this page to upload gallery images.</div>');
        } else {
            $project = $this->Title;
            $uploadField = SortableUploadField::create('Images', 'Images')
                        ->setFolderName("Projects/{$project}/Images");
        }
        $fields->addFieldsToTab('Root.Gallery', [
            $uploadField
        ]);

        $fields->addFieldsToTab('Root.Details', [
            HTMLEditorField::create('Description'),
            TextareaField::create('ShortDescription')
                ->setDescription('A brief description of the project to display on feature elements')
        ]);

        return $fields;
    }


    public function onAfterWrite()
    {
        parent::onAfterWrite();
        $header = $this->HeaderElements();
        $elements = $header->Elements();
        $count = $elements->count();
        if ($count === 0) {
            $defaultHeader = ProjectHeader::create();
            $defaultHeader->ParentID = $header->ID;
            $defaultHeader->write();
        }
        $headElement = $this->HeaderElements()->Elements()->first();
        if ($headElement && $headElement->Title == '') {
            $headElement->Title = $this->Title;
            $headElement->write();
        }
        if ($headElement && $headElement->Content == '') {
            $headElement->Content = $this->ShortDescription;
            $headElement->write();
        }

        $content = $this->ElementalArea();
        $elements = $content->Elements();
        $count = $elements->count();
        if ($count === 0) {
            $defaultContent = ElementContent::create();
            $defaultContent->ParentID = $content->ID;
            $defaultContent->write();

            $gallery = GalleryElement::create();
            $gallery->ParentID = $content->ID;
            $gallery->write();
        }
    }

    public function getImages()
    {
        return $this->Images()->sort('SortOrder');
    }

    public function getThumbnail() {
        if (!$this->Images()->exists()) {
            return '(no images)';
        }
//        return $this->Images()->sort('Sort', 'ASC')->first()->fit(120, 80);
        return $this->Images()->first()->fit(120, 80);
    }

    public function FeaturedImage() {
        if (!$this->Images()->exists()) {
            return null;
        }
        return $this->Images()->sort('SortOrder', 'ASC')->first();
    }

    public function getShortDescription() {
        if ($this->getField('ShortDescription')) {
            return $this->getField('ShortDescription');
        }
    }
}

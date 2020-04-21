<?php


namespace SLloyd\Architecture;


use SilverStripe\Lumberjack\Model\Lumberjack;
use SilverStripe\ORM\DB;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Versioned\Versioned;

class ProjectHolder extends \Page
{
    private static $table_name = 'ProjectHolder';

    private static $allowed_children = [
        ProjectPage::class
    ];


    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();
        $exists = (ProjectHolder::get()->first()) ? true : false;
        if (!$exists) {
            $page = ProjectHolder::create();
            $page->Title = _t(__CLASS__.'DEFAULTPROJECTSTITLE', 'Projects');
            $page->Sort = 2;
            $page->write();
            $page->publishRecursive();
            DB::alteration_message('Home page created', 'created');
        }
    }

    public function canDelete($member = null)
    {
        return false;
    }


    public function getPaginatedProjects() {
        $kids = $this->Children();
        if ($kids) {
            $list = PaginatedList::create($kids);

            return $list;
        }
        return null;
    }
}

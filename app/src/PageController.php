<?php

namespace {

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\Security\Security;
    use SilverStripe\View\Requirements;

    class PageController extends ContentController
    {
        /**
         * An array of actions that can be accessed via a request. Each array element should be an action name, and the
         * permissions or conditions required to allow the user to access it.
         *
         * <code>
         * [
         *     'action', // anyone can access this action
         *     'action' => true, // same as above
         *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
         *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
         * ];
         * </code>
         *
         * @var array
         */
        private static $allowed_actions = [];

        protected function init()
        {
            parent::init();
            $path = PUBLIC_DIR.'/'.RESOURCES_DIR."/themes/sla/client/";
            // You can include any CSS or JS required by your project here.
            // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
            Requirements::combine_files('app.combined.css', [
                $path.'css/normalize.css',
                $path.'css/globals.css',
                $path.'css/header.css',
                $path.'css/typography.css',
                $path.'css/elements.css',
            ]);

            Requirements::css('https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,300;0,400;0,600;0,700;1,400;1,600&family=Merriweather:wght@300;400;700;900&display=swap');
            Requirements::css("{$path}line-awesome/css/line-awesome.min.css");
            Requirements::css($path.'tobii/css/tobii.min.css');

            Requirements::javascript($path.'tobii/js/tobii.min.js');
            Requirements::combine_files('app.combined.js', [
                $path.'js/lightbox.js'
            ]);


            $currentUser = Security::getCurrentUser();
            if ($currentUser) {
                Requirements::css("{$path}css/navigator.css");
            }
        }
    }
}

<?php


namespace SLloyd\Architecture\Extensions;


use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;

class FileFormFactoryExtension extends Extension
{

    public function updateFormFields(FieldList $fields, $controller, $formName, $context) {
        $image = isset($context['Record']) ? $context['Record'] : null;
        if ($image && $image->appCategory() === 'image') {
            $fields->insertAfter(
                'Title',
                TextareaField::create('Caption')
                    ->setReadonly($formName === 'fileSelectForm')
            );
        }
    }

}

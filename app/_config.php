<?php


use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

$formats =  [
    [
        'title' => 'Lead text (bigger)',
        'selector' => 'p',
        'classes' => 'lead',
    ],
    [
        'title' => '“Quote”',
        'selector' => 'p',
        'classes' => 'quote',
    ],
    [
        'title' => 'Button',
        'selector' => 'a',
        'classes' => 'btn btn-primary',
    ],
];
TinyMCEConfig::get('cms')
    ->setOptions([
        'body_class' => '',
        'importcss_append' => true,
        'style_formats' => $formats,
        'importcss_selector_filter' => ' ', // hide all selectors
    ])
    ->insertButtonsAfter('formatselect', 'styleselect');

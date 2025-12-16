<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__)
    ->exclude([
        'vendor',
        'node_modules',
        'storage',
        'bootstrap/cache',
    ]);

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12'   => true,

        // Clean code
        'no_unused_imports'          => true,
        'ordered_imports'            => ['sort_algorithm' => 'alpha'],
        'single_quote'               => true,
        'no_extra_blank_lines'       => true,
        'no_trailing_whitespace'     => true,
        'no_whitespace_in_blank_line'=> true,

        // PHPDoc
        'no_empty_comment'           => true,
        'no_superfluous_phpdoc_tags' => true,

        // Classes & methods
        'class_attributes_separation' => [
            'elements' => [
                'method'   => 'one',
                'property' => 'one',
            ],
        ],
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'method_chaining_indentation' => true,

        // Spacing & operators
        'binary_operator_spaces' => [
            'default'   => 'single_space',
            'operators' => [
                '='  => 'align_single_space_minimal',
                '=>' => 'align_single_space_minimal',
                '+=' => 'align_single_space_minimal',
                '-=' => 'align_single_space_minimal',
                '*=' => 'align_single_space_minimal',
            ],
        ],
        'operator_linebreak' => [
            'only_booleans' => true,
        ],

        // Language consistency
        'native_function_casing'                    => true,
        'class_reference_name_casing'               => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'trailing_comma_in_multiline'               => true,
    ])
    ->setFinder($finder);

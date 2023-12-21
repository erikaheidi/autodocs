<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

use Autodocs\Service\AutodocsService;
use Minicli\App;

expect()->extend('toBeOne', fn () => $this->toBe(1));

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function getAutodocs()
{
    $config = [
        'autodocs' => [
            'images_sources' => __DIR__.'/../workdir/sources',
            'pages' => [
                \Autodocs\Page\ExamplePage::class,
                \Autodocs\Page\TestPage::class
            ],
            'output' => __DIR__.'/../var/output',
            'cache_dir' => __DIR__.'/Resources',
            'templates_dir' => __DIR__.'/Resources'
        ]
    ];

    $autodocs = new AutodocsService();
    $autodocs->load(new App($config));

    return $autodocs;
}

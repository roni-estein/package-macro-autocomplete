# Package Macro Autocomplete

PackageMacroAutocomplete's only job is to pull your macro's into a file that PHPStorm and possibly other IDE's can read and place in your project so that you gain auto completion for package macros. This package is designed to be used as a helper for barryvdh/laravel-ide-helper

`composer require roniestein/package-macro-autocomplete --dev`

In your packages `src` directory simply add the file `AutoCompletionHelper.php`

Add the Macros you want to be imported into the ide as follows:

```php

<?php
namespace Illuminate\Http;

/**
 * @method bool validate(array $rules, ...$params) Validate the given request with the given rules.
 * @method array validated() Get the validated data from the request.
 */
class Request
{
}


namespace Illuminate\Support;

use App\User;

/**
 * @method bool fiddler($roof) Check if he is on the roof.
 * @method array shaboom($shaboom) La la la la la la la
 * @method User user()
 */
class Collection
{
}

```

When you are ready to import all the organized macros in your package, simply run the command

`php artisan autocomplete:generate`

This will read `AutoCompletionHelper.php` files in each of the required packages and create a _package_macro_ide_helper.php file in your root directory with all the macros listed.
PHPStorm will index that file and add the listed macro signatures to autocomplete.

`autocomplete:generate` takes one optional parameter that is the file name, however it will add on the php extension. If you want something other that the _package_macro_ide_helper.php, run `php artisan autocomplete:generate MyAAwesomeFilename` and MyAwesomeFilename.php will be added to the root of your project for PHPStorm to consume.

To make this part of your build, add the command to your composer.json after barryvdh/laravel-ide-helper update scripts.

"scripts": {
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi",
            "@php artisan ide-helper:generate",
            "@php artisan ide-helper:meta"
            "@php artisan autocomplete:generate"
        ],


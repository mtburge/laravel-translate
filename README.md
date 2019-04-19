# Laravel Translate

![Build](https://img.shields.io/travis/itsmattburgess/laravel-translate.svg)
![Code Quality](https://img.shields.io/scrutinizer/g/itsmattburgess/laravel-translate.svg)
![Coverage](https://img.shields.io/scrutinizer/coverage/g/itsmattburgess/laravel-translate.svg)

Easily translate your laravel application using cloud translation APIs. This package finds all of your `__()` and `trans()`
methods in your `app/` and `resources/` directories and translates each string using the API. Online translation APIs aren't
perfect however, so its recommended that this package is used to give you a good starting point. Packages such as
[barryvdh/laravel-translation-manager](https://github.com/barryvdh/laravel-translation-manager)
and [joedixon/laravel-translation](https://github.com/joedixon/laravel-translation) can then be used to fine-tune your translations.

## Installing
Installation is achieved using composer
```
composer require --dev itsmattburgess/laravel-translate
```

### Configuration
You can configure how this package is implemented using the config file in `config/translate.php`. You first need to publish
this config file using the command below:
```
php artisan vendor:publish --provider="itsmattburgess\LaravelTranslate\TranslationServiceProvider"
```

In this config file, you can specify the methods that contain your translation strings, the path where your methods should
be discovered in, and which languages you want to translate into.

The package currently only supports the Google Translate API.

To use the Google Translate API you need to set your API key. You can obtain an API key from your
[Google Cloud Console](https://console.cloud.google.com/apis/api/translate.googleapis.com/credentials).
Once generated, add your key to your `.env` file.
```
GOOGLE_TRANSLATE_API_KEY=XXXXXX
```

## Usage
Once you have set your API key and set the languages you want to translate into, you're ready start processing. Run the 
following command to start processing. It will detect your translation methods and create the language files in
`resources/lang/`. If you already have these files defined, it will override any matching keys with an updated translation.

```
php artisan translate
```

### Pricing warning
Online translation providers, such as Google, charge for usage of their APIs. Check their pricing carefully,
you are responsible for any charges incurred.

## Contributing
Contributions are welcome. If you've spotted a bug, would like to add a new feature or implement a new service, please
submit a pull request with associated test coverage. I'll review any pull requests as quickly as I can.

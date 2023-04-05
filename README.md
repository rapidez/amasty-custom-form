# Amasty Custom Form

## Requirements

You need to have the [Amasty Custom Form](https://amasty.com/custom-form-for-magento-2.html) module installed and configured within your Magento 2 installation.
Including the graphql module.

## Installation

```bash
composer require rapidez/amasty-custom-form
```

### Showing a Form

You can show a form by loading the amasty-custom-form form component:

```blade
<x-amasty-custom-form::form :formId="$form_id"/>
```

the form id is the id that is in the database, not the code.

## Getting the form id by code

If you want to render the form by code instead of id you can do so by getting it from the database

```php
$form = \Rapidez\AmastyCustomForm\Models\AmastyCustomForm::select('form_id')->where('code', <form code>)->first();
...
<x-amasty-custom-form::form :formId="$form->form_id"/>
```

## Views

If you need to change the views you can publish them with:

```bash
php artisan vendor:publish --provider="Rapidez\AmastyCustomForm\AmastyCustomFormServiceProvider" --tag=views
```

## Note

Not all features are implemented yet! For example the review start & file upload aren't supported.

## License

GNU General Public License v3. Please see [License File](LICENSE) for more information.

# Drupal Alexa proof of concept

Drupal module used in a PHP Conference Brazil 2017 Keynote.

## Requirements

- PHP ^5.5.9
- Composer
- [Docksal](docksal.readthedocs.io) (Optional)

## Instalation

Run:

```shell
$ composer create-project drupal-composer/drupal-project:8.x-dev alexa-test --stability dev --no-interaction && cd alexa-test && composer require seregatte/drupal_module_confessional
```

You can run the project in your PHP favorite Stack, or... Install with docksal.

## Instalation With Docksal

Run:

```shell
$ composer create-project seregatte/drupal-composer-boilerplate alexa-test --stability dev --no-interaction && cd alexa-test && composer require seregatte/drupal_module_confessional && fin setdomain alexatest.docksal && fin init && fin drupal moi confessional
```

After that you have a full site acessible via http://alexatest.docksal/

* On instalation drupal will ask you for a admin password

## Configuration

Access admin/config/services/alexa and put a alexa skill ID, showed in Amazon Developer Portal

In resource's folder on this module there are some Uterrances and Intent Schema.

* By default alexa module accept requests on /alexa/callback url, make sure that this url is accessible via internet. You can use [ngrok](https://ngrok.com/) for that or simply use fin share command if have you using docksal.

# License

GPL-3.0+

# Author

João Paulo Seregatte Costa <seregatte@gmail.com>
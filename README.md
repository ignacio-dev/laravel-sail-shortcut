
# Laravel Sail Shortcut

  

## Description

Terminal shortcut for Laravel Sail commands, so that you can use ```./sail {your-command}``` instead of ```vendor/bin/sail {your-command}```

  

## Installation

  

First, add the library using composer:

  

```

composer require --dev ignacio-dev/laravel-sail-shortcut

```

  

Then, you can install the shorcut by running:

  

```

artisan sail-shortcut:install

```

  This will add a ``sail`` file on the root of your project. You might want to gitignore it to avoid pushing it to production.

To remove it, you can simply run:

```

artisan sail-shortcut:uninstall

```

  **Note**: Running the uninstall command will not remove the composer library. You must do that manually.

## Usage

Once installed, you can start using ``./sail`` instead of ``vendor/bin/sail``.

  

For example:
```

./sail up -d

```

Or

```

./sail artisan tinker

```
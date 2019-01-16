# Block Plugin for [Flextype](http://flextype.org/)
![version](https://img.shields.io/badge/version-1.1.2-brightgreen.svg?style=flat-square)
![Flextype](https://img.shields.io/badge/Flextype-0.8.3-green.svg?style=flat-square)
![MIT License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)

Block plugin provides a basic way to work with content blocks marked up using regular HTML + Shortcodes and saved with `.html` extension in the folder `/site/blocks/`

## Installation
Unzip plugin to the folder `/site/plugins/`

## Usage in page content

```
[block name=block-name]
```

## Usage in the template

Define Flextype namespace in the template if it is not defined yet.
```
<?php namespace Flextype; ?>
```

Display block content
```
<?= Block::get('block-name') ?>
```

## Settings

```yaml
enabled: true # or `false` to disable the plugin
```

## License
See [LICENSE](https://github.com/flextype-plugins/block/blob/master/LICENSE)

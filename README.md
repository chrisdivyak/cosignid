# CoSign Id plugin for Craft CMS 3.x

Craft 3 Plugin version of Cosign login

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require readme.md/co-sign-id

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for CoSign Id.

## CoSign Id Overview

This is a simple plugin that pulls the session cosign id into a Craft variable for usage throughout templates.


## Using CoSign Id


You can set a variable in your templates to grab the cosign id after sign in.

```
{% set studentId = craft.cosignid.studentId  %}

```

Brought to you by [WPSU Multimedia](http://creativeservices.psu.edu)

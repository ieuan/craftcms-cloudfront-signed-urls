<p><img src="./src/icon.svg" width="100" height="100" alt="Cloudfront Signed Url icon"></p>

<h1>Cloudfront Signed Urls for Craft CMS</h1>

This plugin provides AWS Cloudfront Signed Urls in Twig templates

## Requirements

This plugin requires Craft CMS 3.4 or later.

---

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require troisiemejoueur/cloudfront-signed-urls

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Cloudfront Signed Urls.

---

## Overview

This plugin add a Twig function to sign URLs from a AWS Cloudfront distribution. The common usage is for a restricted section for logged in users only. 

In order to use this plugin, we assume that you already worked with the AWS S3 plugin and that you know how to create a bucket, a Cloudfront distribution and IAM access for the CMS. If not, you can read the documentation of the first-party plugin [AWS S3 plugin from Pixel & Tonic](https://plugins.craftcms.com/aws-s3) and this [good article from Andrew Welch](https://nystudio107.com/blog/using-aws-s3-buckets-cloudfront-distribution-with-craft-cms).

__Please, do not open issues for AWS configurations problems or questions that are not related to the plugin.__

---

## How it works 

You upload your assets to a non-public S3 bucket with a Cloudfront Distribution with the `Restrict Viewer Access` setting to `Yes`. When you create URLs in your templates, these URLs are signed with a random key.

These URLs are created on page load and expires after the duration that you entered. 

[Documentation for Cloudfront Signed Urls](https://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/private-content-signed-urls.html)

---

## Configuration file
The plugin comes with a `config.php` file that defines some sensible defaults.

If you want to set your own values you should create a `cloudfront-signed-urls.php` file in your Craft config directory. The contents of this file will get merged with the plugin defaults, so you only need to specify values for the settings you want to override.

#### keyPairId
`keyPairId` is where you define the value of _the Key-Pair-Id_ field from your _public–private_ key pair.
[See AWS documentation for creating public–private key pair](https://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/private-content-trusted-signers.html#private-content-creating-cloudfront-key-pairs).

#### cloudfrontDistributionUrl
`cloudfrontDistributionUrl` is where you define the base URL for your signed urls. If you want to manage the base url on a per-file basis, do not add this setting to your config file. If you are using a subfolder, you can append it to this URL. _Trailing slash are not required_. 


#### profile
`profile` is where you define the profile of your Cloudfront client. `default` is the default value.

#### version
`version` is where you define the version of your Cloudfront client. `2020-05-31` is the default value.

#### region
`region` is where you define the regional endpoint for your Cloudfront client. `ca-central-1` is the default value, you probably need to change it based on your project.

#### defaultExpires
`defaultExpires` is where you define in seconds the expiry delay for your signed URLs __IF not set__ as argument when using the Twig function. This is a fallback value. Default is 3600 (60 minutes).

The expiry time is calculated like this : `now time` + `defaultExpires`.

__Note:__ You can use values from your ENV file for all the configuration settings. Example : `App::env('YOUR_VARIABLE_NAME')`

---

## An Example Config File
```
<?php

use craft\helpers\App;

return [
   'keyPairId' => App::env('SIGNED_URLS_KEYPAIR'),
   'cloudfrontDistributionUrl' => 'https://my-distribution.cloudfront.net',
   'profile' => 'default',
   'version' => '2020-05-31',
   'region' => 'ca-central-1',
   'defaultExpires' => 4200
];
```

---

## Private Key (.pem file)

In order to sign your URLs, AWS needs to access the private key (the `private_key.pem` file).
[See AWS documentation for creating public–private key pair](https://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/private-content-trusted-signers.html#private-content-creating-cloudfront-key-pairs). 

When you install this plugin, a `cloudfront-signed-urls` folder will be create in your Craft CMS project `storage` folder. You need to copy your `private_key.pem` file in this folder. 

__Note: When uninstalling the plugin, this folder (and your private key) is delete.__

This .pem file cannot be add as .env variable.

---

## Usage in Twig


##### Basic usage with filename and a expiry delay of 300 seconds.

```
{{ signUrl(myAssetTest.filename, 300) }}
```

##### Usage without expiry delay - will fallback to your config value or the default one.
```
{{ signUrl(myAssetTest.filename) }}
```

##### Usage with a complete URL - this case only works if you do not provided a value to the _cloudfrontDistributionUrl_ setting in your config file.

```
{% set myAssetUrl = 'https://my-distribution-url.cloudfront.net' ~  myAssetTest.filename %}
{{ signUrl(myAssetUrl, 300) }}
```

---

## S3 storage and Craft CMS Control Panel


You will need the first-party [AWS S3 plugin from Pixel & Tonic](https://plugins.craftcms.com/aws-s3).

__Note:__ We assume that you already worked with the AWS S3 plugin and that you know how to create bucket, Cloudfront distribution and IAM access for the CMS. If not, you can read the documentation of the plugin and this [good article from Andrew Welch](https://nystudio107.com/blog/using-aws-s3-buckets-cloudfront-distribution-with-craft-cms).

__Please, do not open issue tickets for AWS configurations problems or questions.__

#### AWS 
1. Create a non-public S3 bucket on AWS (and a user with access programmatically for Craft CMS)
1. Create a cloudfront distribution with _Restrict viewer access_

#### Control Panel
1. Install the [AWS S3 plugin from Pixel & Tonic](https://plugins.craftcms.com/aws-s3)
1. Create a volume with the Amazon S3 `Volume Type`
1. Disable the lightswith for `Assets in this volume have public URLs`
1. Add your S3 bucket credentials and settings

__Note: When a user(mostly the admin) is logged in in the Control Panel, he will be able to open the assets with the Download button, but not to preview it (as the assets have no public URLs).__

#### Template restricted zone -> Example

1. Setup your templates with content based on which usergroup is logged in.
2. Show assets with the Twig function.
3. No one from the "web" will be able to view the files. The URL will expires after the duration that you entered. A user can copy and share the URL, but that's the only way to guess / share a signed URL.


---

Brought to you from Canada by [3e joueur](https://www.3ejoueur.com)

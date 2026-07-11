# PDFShift plugin for Craft CMS

Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 4.0 or 5.0, and PHP 8.0.2 or later.

For Craft CMS 3, use version 1.x of this plugin.

## Upgrading from 1.x

Template code is unchanged: `craft.pdfShift.link()` and `craft.pdfShift.download()` work exactly as before, and your existing API Key setting carries over automatically.

Two things to be aware of:

- The plugin now uses the PDFShift v3 API. `source`, `filename`, `format`, and `sandbox` behave the same; if you pass other conversion options, check their names against the [v3 API reference](https://docs.pdfshift.io/api-reference/convert-to-pdf).
- The API Key setting now accepts an environment variable reference (e.g. `$PDFSHIFT_API_KEY`), which is the recommended way to store it.

## Installation

To install the plugin, follow these instructions (alternatively, install from the Craft Plugin Store).

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require graftechnology/pdfshift

3. In the Control Panel, go to Settings → Plugins and click the "Install" button for PDFShift.

4. Go to Settings → Plugins → PDFShift → Settings and enter your PDFShift API Key. The setting accepts an environment variable reference (e.g. `$PDFSHIFT_API_KEY`), which keeps the key out of project config.

**Note:** While testing, you can pass `sandbox: true` in your conversion options for free, watermarked conversions that don't count against your plan.

Read more here [https://docs.pdfshift.io/](https://docs.pdfshift.io/)

## PDFShift Overview

Stop wasting time implementing and maintaining a third-party software/library.

With PDFShift, rely on an up-to-date, high-fidelity conversion API with no maintenance costs.

[https://pdfshift.io/](https://pdfshift.io/)


## Using PDFShift

##### Return URL to PDF Document

Returns a temporary URL to the converted PDF (hosted by PDFShift for two days):

```twig
{{ craft.pdfShift.link({
    source: 'https://www.google.com/',
    filename: 'google.pdf',
    format: 'Letter',
    sandbox: true
}) }}
```

##### Download PDF Document

Streams the converted PDF to the browser as a download:

```twig
{{ craft.pdfShift.download({
    source: 'https://www.google.com/',
    filename: 'google.pdf',
    format: 'Letter',
    sandbox: true
}) }}
```

### Options

`source` is the only required option. Everything else is optional.

`filename` is optional and defaults to `document.pdf`.

All other options are passed straight through to the PDFShift v3 API. The full list is here: [https://docs.pdfshift.io/api-reference/convert-to-pdf](https://docs.pdfshift.io/api-reference/convert-to-pdf)

---

Brought to you by [Graf Technology, LLC](https://graftechnology.com/)

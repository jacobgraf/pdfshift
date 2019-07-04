# PdfShift plugin for Craft CMS 3.x

Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions (Alternatively, install from the Craft Plugin Store).

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require jacobgraf/pdfshift

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for PDFShift.

## PdfShift Overview

Stop wasting time implementing and maintaining a third-party software/library.

With PDFShift, rely on an up-to-date, high-fidelity conversion API with no maintenance costs.

[https://pdfshift.io/](https://pdfshift.io/)


## Using PdfShift

##### Return URL to PDF Document

```
{{ craft.pdfShift.link({
    source: 'https://www.google.com/',
    filename: 'google.pdf',
    format: 'letter',
    sandbox: true
}) }}

```

##### Download PDF Document

```
{{ craft.pdfShift.download({
    source: 'https://www.google.com/',
    filename: 'google.pdf',
    format: 'letter',
    sandbox: true
}) }}

```

### Options

`source` is the only required option. Everything else is optional.

`filename` is optional and defaults to `document.pdf`.

All available options are listed here [https://docs.pdfshift.io/#general](https://docs.pdfshift.io/#general)

---

Brought to you by [Graf Technology, LLC](https://graftechnology.com/)

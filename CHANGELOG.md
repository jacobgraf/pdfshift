# PdfShift Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 2.0.0 - 2026-07-10
### Added
- Craft CMS 4 and 5 compatibility.
- Environment variable support for the API Key setting, with autosuggest in the settings UI.

### Changed
- Upgraded from the PDFShift v2 API to the v3 API (`X-API-Key` authentication).
- API requests now use Craft's bundled Guzzle client instead of raw cURL.
- Downloads are now sent through Craft's response object and properly end the request.
- Fixed the settings asset bundle namespace mismatch by removing the unused asset bundle entirely.

### Removed
- Craft CMS 3 support. PHP 8.0.2+ is now required.
- Leftover scaffolding: empty asset bundle, unused translations, `.craftplugin`, and `package-lock.json`.

## 1.1.1 - 2020-10-27
### Changed
- Added support for psr-4 autoloading

## 1.1.0 - 2019-12-12
### Changed
- Optimize Download Functionality.

### Added
- Error Handling.

## 1.0.3 - 2019-08-05
### Changed
- Set download functionality to redirect to S3 URL in order to increase browser compatibilities.

## 1.0.2 - 2019-07-03
### Fixed
- Set correct license.

## 1.0.1 - 2019-07-03
### Fixed
- macOS File Case Issues.

## 1.0.0 - 2019-07-03
### Added
- Initial Release.

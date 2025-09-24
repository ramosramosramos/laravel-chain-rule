# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.3] - 2025-09-23
### Maintenance
- More mass rules added: `nullable_date()`, `required_date()`

## [1.2.2] - 2025-09-23
### Maintenance
- Updated docs and README usage example

## [1.2.1] - 2025-09-23
### Fixed
- Improved `Arrayable` integration so `ChainRule` can be used directly in validation arrays.
- Minor bugfixes in rule merging.

## [1.2.0] - 2025-09-22
### Added
- Support for `chainRule()` global helper.
- More parameterized rules support (`min`, `max`, etc.).

## [1.1.0] - 2025-09-21
### Added
- Prevented duplicate rules when merging multiple chains.

## [1.0.0] - 2025-09-20
### Added
- Initial release with:
  - Simple rules (`required`, `nullable`, `email`, `string`, etc.)
  - Parameterized rules (`unique`, `exists`, `between`, `after`, etc.)
  - `merge()` method to combine rules.

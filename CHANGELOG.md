# Changelog

All notable changes to `awesome-enums` will be documented in this file.

## v1.2.7 - 2024-07-05

### What's Changed

* Add support for laravel 11
* Bump actions/checkout from 3 to 4 by @dependabot in https://github.com/Frameck/awesome-enums/pull/5
* Bump aglipanci/laravel-pint-action from 2.3.0 to 2.3.1 by @dependabot in https://github.com/Frameck/awesome-enums/pull/7
* Bump aglipanci/laravel-pint-action from 2.3.1 to 2.4 by @dependabot in https://github.com/Frameck/awesome-enums/pull/9
* Bump stefanzweifel/git-auto-commit-action from 4 to 5 by @dependabot in https://github.com/Frameck/awesome-enums/pull/6
* Bump dependabot/fetch-metadata from 1.6.0 to 2.1.0 by @dependabot in https://github.com/Frameck/awesome-enums/pull/10

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.2.6...v1.2.7

## v1.2.6 - 2023-08-22

- [added missing type in make:enum command](https://github.com/Frameck/awesome-enums/commit/e587ffc53e16a428f97b06843105433a133a66e6)
- [added select for --type option using laravel/prompts](https://github.com/Frameck/awesome-enums/commit/16bcb9bf059655d8c10c82406428c4cc5e7f1328)

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.2.5...v1.2.6

## v1.2.5 - 2023-08-11

- [use snake case in fromName method](https://github.com/Frameck/awesome-enums/commit/c41bc0de1d8aad7c5ffdffe7743bd40e038aa8cb)

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.2.4...v1.2.5

## v1.2.4 - 2023-08-11

[use static types instead of self when possible](https://github.com/Frameck/awesome-enums/commit/5d483a648aeadb2f0b632e5ded61ff4662db7256)

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.2.3...v1.2.4

## v1.2.3 - 2023-08-08

- [improved in() function](https://github.com/Frameck/awesome-enums/commit/1d400c4ea86b3b0274dce29321f3a07dee1a2cc5)
- [improved all() and details() methods](https://github.com/Frameck/awesome-enums/commit/d894e86e468d6c384754c3b9d9d945dca19684ab)

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.2.2...v1.2.3

## v1.2.2 - 2023-08-04

- fix calling wrong method

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.2.1...v1.2.2

## v1.2.1 - 2023-08-04

- fix `details()` method

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.2...v1.2.1

## v1.2 - 2023-08-04

- new `in()` and `notIn()` methods to fluently check if an enum instance is present in an array of enums

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.1...v1.2

## v1.1 - 2023-07-22

### What's Changed

- new `--type` option in `make:enum` command
- ability to call an enum class or case as a function and get the corresponding value
- new `toArray `, `names` and `values` methods
- improved `details` method
- improved docs

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.0.4...v1.1

## v1.0.4 - 2023-05-05

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.0.3...v1.0.4

[added fluent comparison methods](https://github.com/Frameck/awesome-enums/commit/732c826b4155ede395aecb9d5914399822982c17): `->is()` and `->isNot()`

## v1.0.3 - 2023-05-02

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.0.2...v1.0.3

- updated `HasDetails` trait

## v1.0.2 - 2023-04-23

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.0.1...v1.0.2

## v1.0.1 - 2023-04-23

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v1.0.0...v1.0.1

- updated docs

## v1.0.0 - 2023-04-23

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v0.0.3...v1.0.0

- removed `resources` folder
- added docs and `ToJson` trait

## v0.0.3 - 2023-04-23

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v0.0.2...v0.0.3

- fix traits namespace

## v0.0.2 - 2023-04-23

**Full Changelog**: https://github.com/Frameck/awesome-enums/compare/v0.0.1...v0.0.2

- fix stub path

## v0.0.1 - 2023-04-23

### What's Changed

- Bump dependabot/fetch-metadata from 1.3.6 to 1.4.0 by @dependabot in https://github.com/Frameck/awesome-enums/pull/1
- `FromString`, `HasDetails`, `ToSelect` traits
- `make:enum` command

### New Contributors

- @dependabot made their first contribution in https://github.com/Frameck/awesome-enums/pull/1

**Full Changelog**: https://github.com/Frameck/awesome-enums/commits/v0.0.1

# Mai Calendar — TYPO3 Extension

[![CI](https://github.com/mai-space-de/typo3-extension-calendar/actions/workflows/ci.yml/badge.svg)](https://github.com/mai-space-de/typo3-extension-calendar/actions/workflows/ci.yml)

A TYPO3 v13 extension that provides calendar views (month, week, list) and iCal export. Events are aggregated from any number of `EventProviderInterface` implementations, making the extension fully decoupled from a specific data source.

## Features

- **Month view** – full ISO-week grid with leading/trailing days from adjacent months
- **Week view** – single ISO week (Monday–Sunday)
- **List view** – flat, date-sorted list of upcoming events with configurable limit
- **iCal export** – RFC 5545-compliant `.ics` download via a dedicated controller action
- **Extensible event providers** – implement `EventProviderInterface` and register via `Services.yaml`

## Requirements

| Dependency | Version |
|---|---|
| PHP | `^8.2` |
| TYPO3 CMS | `^13.4` |

## Installation

```bash
composer require maispace/mai-calendar
```

After installation, include the extension's TypoScript set in your site package or include it via the TYPO3 backend.

## Configuration

### TypoScript / FlexForm options

| Option | Type | Default | Description |
|---|---|---|---|
| `viewMode` | `month\|week\|list` | `month` | Calendar view to render |
| `listLimit` | `int` | `10` | Max events shown in list view |
| `targetVariable` | `string` | `calendar` | Fluid template variable name |
| `date` | `Y-m-d` | today | Reference date |

### GET parameters (front-end navigation)

| Parameter | Description |
|---|---|
| `tx_maicalendar_date` | Override the reference date (`Y-m-d`) |
| `tx_maicalendar_view` | Override the view mode (`month\|week\|list`) |

### iCal export

Register the `CalendarController::icalExportAction` as a plugin action. The endpoint accepts `start` and `end` query parameters (`Y-m-d`; defaults to the current month).

## Implementing a custom event provider

```php
use Maispace\MaiCalendar\Domain\Model\Event;
use Maispace\MaiCalendar\EventProvider\EventProviderInterface;

final class MyEventProvider implements EventProviderInterface
{
    public function getEvents(\DateTimeInterface $start, \DateTimeInterface $end): array
    {
        // fetch and return Event objects in the given range
        return [
            new Event(
                uid: 'my-event-1',
                title: 'My Event',
                start: new \DateTimeImmutable('2024-06-15 10:00:00'),
                end: new \DateTimeImmutable('2024-06-15 11:00:00'),
            ),
        ];
    }
}
```

Register the provider in `Configuration/Services.yaml`:

```yaml
services:
  MyVendor\MyExtension\EventProvider\MyEventProvider:
    tags:
      - name: mai_calendar.event_provider
```

## Development

### Install dependencies

```bash
composer install
```

### Run unit tests

```bash
composer test
```

### Lint & static analysis

```bash
# Check all
composer lint:check

# Auto-fix code style
composer lint:fix

# Individual checks
composer check:phpcs
composer check:phpstan
composer check:typoscript
composer check:editorconfig
```

## Extension key

`mai_calendar`

## License

GPL-2.0-or-later

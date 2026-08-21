# sic_fortune – Fortune Cookie

TYPO3 extension that displays a random quote or "citation of the day" from a database or a Unix fortune file, optionally with a parallax background image.

## Features

- **Two data sources:** Database records or Unix fortune file format (`%`-separated)
- **Two display modes:** Random quote or Citation of the Day (same quote all day for all visitors)
- **Bundled fortune files:** German quotes (`de_quotes`) and English humorists (`humorists`)
- **Custom fortune files:** Any fortune file via EXT: path or absolute server path
- **Parallax background image:** Upload images via the content element's image tab; parallax via `background-attachment: fixed` with iOS and `prefers-reduced-motion` fallbacks
- **Typographic quote marks:** Language-sensitive CSS quotes for `de`, `en`, `fr` via `:lang()` pseudo-class
- **Zero-setup fallback:** Empty database → bundled German quotes are shown automatically

## Requirements

- TYPO3 13.4 LTS (compatible with TYPO3 14)
- PHP 8.2 or higher

## Installation

**Classic (non-Composer):** Download from TER and install via Extension Manager.

**Composer:**
```bash
composer require sicor/sic-fortune
```

After installation, include the static TypoScript template **"Fortune Cookie"** in your site's root template.

## Configuration

Add a **Fortune Cookie** content element to any page. Configure via the FlexForm:

| Field | Description |
|---|---|
| Data Source | Database or Fortune File |
| Fortune File | Select bundled file or enter custom path |
| Display Mode | Random Quote or Citation of the Day |

For database mode, set the **Record Storage Page** (Datensatzsammlung) to the page containing your Fortune records.

### Background Image

Upload one or more images in the content element's **Images** tab. The extension selects one image per request (random or daily-seeded, matching the display mode).

### Template Override

```typoscript
plugin.tx_sicfortune {
    view.templateRootPaths.10 = EXT:your_sitepackage/Resources/Private/Templates/SicFortune/
}
```

## License

GPL-2.0-or-later — see [GNU General Public License](https://www.gnu.org/licenses/gpl-2.0.html)

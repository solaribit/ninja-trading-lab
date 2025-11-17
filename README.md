# Ninja Trading Bot Lab - WordPress Plugin

![Plugin Banner](https://raw.githubusercontent.com/solaribit/ninja-trading-lab/refs/heads/main/ai-ninja-logo-350pxX80px.png)

## Description

Ninja Trading Bot Lab is a powerful WordPress plugin that embeds an interactive trading compounding projection calculator on your site. Users can input bot assumptions, view 12- and 24-month projections with top-ups, and see real-time currency conversions using live exchange rates from ExchangeRate-API.

Perfect for financial blogs, trading education sites, or fintech tools. Use the shortcode `[trading_lab]` to display it on any post or page.

## Features

- **Interactive Calculator**: Starting balance, daily returns, duration, top-up frequency, and amount.
- **Projections**: 12-month snapshot, custom duration, net profit, CAGR, total contributed.
- **Live Currency Conversion**: Supports USD, GBP, EUR, ZAR with real-time rates (optional API key).
- **Chart Visualization**: Balance vs. contributions over time using Chart.js.
- **Presets**: Quick buttons for 12 months, 24 months, 5 years, and reset to $100.
- **Responsive Design**: Mobile-friendly, dark theme.
- **Caching**: Rates cached for 12 hours to minimize API calls.
- **Theme-Proof CSS**: Isolated styles prevent overrides from your theme.
- **No Dependencies**: Works out-of-the-box (Chart.js loaded via CDN).

## Installation

1. Download the ZIP from the [Releases page](https://github.com/solaribit/ninja-trading-lab/releases) or clone the repo.
2. Upload the `ninja-trading-lab` folder to `/wp-content/plugins/`.
3. Activate the plugin in WordPress Admin → Plugins.
4. (Optional) Get a free API key from [ExchangeRate-API](https://www.exchangerate-api.com/) for live rates.
5. Add shortcode `[trading_lab]` to any post or page.

### Via Composer (Advanced)
```bash
composer require your-username/ninja-trading-lab
```

## Usage

- **Shortcode**: `[trading_lab]` — embeds the full calculator.
- **API Key**: Paste your ExchangeRate-API key into the field for live conversions (falls back to cached/static if none).
- **Customization**: Edit `template.php` for HTML tweaks, or `get_css()`/`get_js()` in the main PHP for styles/scripts.

### Example Page
Create a new page, add `[trading_lab]`, and publish. Users can interact immediately.

## Screenshots

1. **Full Calculator View**  
   ![Calculator Screenshot](https://via.placeholder.com/800x600?text=Full+Calculator+View) <!-- Replace with actual screenshot -->

2. **Mobile Responsive**  
   ![Mobile View](https://via.placeholder.com/400x800?text=Mobile+View)

3. **Live Rates & Projections**  
   ![Projections Screenshot](https://via.placeholder.com/800x600?text=Projections+&+Chart)

## Requirements

- WordPress 6.0+ (tested up to 6.8)
- PHP 7.4+
- Browser with JavaScript enabled (for Chart.js and interactions)

## Development

- **Clone & Setup**:
  ```bash
  git clone https://github.com/solaribit/ninja-trading-lab.git
  cd ninja-trading-lab
  ```

- **Contribute**: Fork, create feature branch, PR.
- **Issues**: Report bugs or request features via GitHub Issues.

## License

GPLv3 or later. See [LICENSE](LICENSE) file.

## Support

- **Issues/PRs**: GitHub repo.

## Credits

- Built with Chart.js for visualizations.
- Rates powered by ExchangeRate-API.
- Original concept by Ai Ninja Toolbox.

Thank you for using Ninja Trading Bot Lab! 🚀

---

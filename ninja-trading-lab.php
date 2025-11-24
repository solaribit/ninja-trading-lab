<?php
/**
 * Plugin Name: Ninja Trading Bot Lab
 * Description: Interactive compounding calculator. Shortcode: [trading_lab]
 * Version: 1.0.4
 * Author: Ninja Trading Bot Lab
 */

if (!defined('ABSPATH')) exit;

class Ninja_Trading_Lab {
    private $assets_enqueued = false;

    public function __construct() {
        add_shortcode('trading_lab', [$this, 'render']);
    }

    private function enqueue_assets() {
        if ($this->assets_enqueued || is_admin()) return;

        $chart_src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js';
        wp_enqueue_script('chart-js', $chart_src, [], '4.4.4', true);
        wp_register_style('ninja-trading-lab', false, [], null);
        wp_enqueue_style('ninja-trading-lab');
        wp_add_inline_style('ninja-trading-lab', $this->get_css());
        wp_add_inline_script('chart-js', $this->get_js(), 'after');

        $this->assets_enqueued = true;
    }

    public function render() {
        $this->enqueue_assets();

        ob_start(); ?>
        <div class="ninja-trading-lab">
            <?php include plugin_dir_path(__FILE__) . 'template.php'; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    private function get_css() {
        return "
        /* === NINJA TRADING LAB - THEME-PROOF CSS === */
        .ninja-trading-lab * { box-sizing: border-box; }
        .ninja-trading-lab { 
            all: initial; 
            display: block; 
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; 
            color: #e5e7eb; 
            line-height: 1.5;
            isolation: isolate;
        }
        .ninja-trading-lab a { color: inherit; text-decoration: underline; }
        .ninja-trading-lab input, .ninja-trading-lab select, .ninja-trading-lab button { 
            font: inherit; 
            color: inherit; 
        }

.ninja-trading-lab input, 
.ninja-trading-lab select {
    background: #0f172a !important;           /* Darker slate (not pure black) */
    color: #ffffff !important;                /* Pure white text */
    border: 1.5px solid #475569 !important;   /* Medium gray border */
    border-radius: 10px;
    padding: 10px 12px;
    font-size: .95rem;
    font-weight: 500;
    outline: none;
    transition: all 0.2s ease;
}

.ninja-trading-lab input::placeholder,
.ninja-trading-lab input::-webkit-input-placeholder {
    color: #94a3b8 !important;               /* Light gray placeholder */
    opacity: 1;
}

.ninja-trading-lab input:focus, 
.ninja-trading-lab select:focus {
    border-color: #22c55e !important;         /* Ninja green */
    box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.3) !important;
    background: #1e293b !important;           /* Slightly lighter on focus */
}


        .ninja-trading-lab .app { 
            max-width: 900px; 
            margin: 0 auto; 
            background: rgba(15,23,42,.96); 
            border-radius: 18px; 
            padding: 24px; 
            box-shadow: 0 18px 40px rgba(0,0,0,.6);
        }
        .ninja-trading-lab .header-row { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 4px; }
        
        .ninja-trading-lab .header-row {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    gap: 16px !important;
    margin-bottom: 8px !important;
    position: relative !important;
}

.ninja-trading-lab .header-row h1 {
    margin: 0 !important;
    font-size: 1.4rem !important;
    letter-spacing: .03em !important;
    flex: 1 !important;
    min-width: 0 !important;
    color: white !important;
}

.ninja-trading-lab .logo-pill {
    margin-left: auto !important;     /* PUSHES TO FAR RIGHT */
    flex-shrink: 0 !important;        /* NEVER SHRINK */
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    padding: 6px 12px !important;
    border-radius: 999px !important;
    background: radial-gradient(circle at top left,#22c55e,#16a34a) !important;
    color: #022c22 !important;
    font-size: .78rem !important;
    font-weight: 600 !important;
    box-shadow: 0 8px 18px rgba(34,197,94,.45) !important;
}
        
        
        
        .ninja-trading-lab h1 { margin: 0; font-size: 1.4rem; letter-spacing: .03em; }
        .ninja-trading-lab .subtitle { font-size: .85rem; color: #9ca3af; margin-bottom: 18px; }

        .ninja-trading-lab .logo-pill-icon { 
            width: 20px; height: 20px; border-radius: 50%; border: 2px solid rgba(6,95,70,.6); 
            background: radial-gradient(circle at 30% 30%,#bbf7d0,#22c55e 55%,#166534 100%); 
            display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: .7rem; color: #022c22;
        }

        .ninja-trading-lab .grid { 
            display: grid; grid-template-columns: repeat(auto-fit,minmax(190px,1fr)); gap: 16px; margin-bottom: 18px; 
        }
        .ninja-trading-lab .field { display: flex; flex-direction: column; gap: 4px; font-size: .85rem; }
        .ninja-trading-lab label { color: #d1d5db; }
        .ninja-trading-lab input, .ninja-trading-lab select { 
            background: #020617; border: 1px solid #1f2937; border-radius: 10px; 
            padding: 8px 10px; color: #e5e7eb; font-size: .9rem; outline: none;
        }
        .ninja-trading-lab input:focus, .ninja-trading-lab select:focus { 
            border-color: #22c55e; box-shadow: 0 0 0 1px rgba(34,197,94,.4); 
        }

        .ninja-trading-lab .presets { 
            display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; 
            font-size: .8rem; color: #9ca3af; align-items: center;
        }
        .ninja-trading-lab .chip { 
            border: 1px solid #1f2937; background: #020617; padding: 4px 10px; 
            border-radius: 999px; cursor: pointer; user-select: none;
        }
        .ninja-trading-lab .chip:hover { border-color: #4ade80; color: #bbf7d0; }

        .ninja-trading-lab .actions { 
            display: flex; justify-content: space-between; gap: 10px; 
            margin-bottom: 18px; flex-wrap: wrap;
        }
        .ninja-trading-lab .btn { 
            border: none; padding: 9px 18px; border-radius: 999px; 
            cursor: pointer; font-weight: 500; display: inline-flex; 
            align-items: center; gap: 6px; white-space: nowrap;
        }
        .ninja-trading-lab .btn-primary { 
            background: linear-gradient(135deg,#22c55e,#16a34a); color: #022c22; 
            box-shadow: 0 10px 25px rgba(34,197,94,.35);
        }
        .ninja-trading-lab .btn-ghost { 
            background: transparent; color: #9ca3af; border: 1px solid #374151;
        }
        .ninja-trading-lab .btn-ghost:hover { border-color: #22c55e; color: #bbf7d0; }

.ninja-trading-lab .results {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;   /* Force 2 equal columns */
    gap: 20px !important;
    margin-bottom: 24px !important;
    font-size: .85rem;
    justify-content: center !important;           /* Center the grid */
    max-width: 100% !important;
    padding: 0 8px !important;
}

@media (max-width: 640px) {
    .ninja-trading-lab .results {
        grid-template-columns: 1fr !important;    /* Stack on mobile */
        gap: 16px !important;
    }
}    
        
.ninja-trading-lab .card {
    background: radial-gradient(circle at top left,#1f2937,#020617) !important;
    border-radius: 14px !important;
    padding: 16px 18px !important;
    border: 1px solid #111827 !important;
    min-width: 280px !important;                  /* Prevents collapse */
    max-width: 100% !important;
    box-shadow: 0 12px 25px rgba(0,0,0,.45) !important;
}
        .ninja-trading-lab .card h2 { margin: 0 0 8px; font-size: .9rem; color: #e5e7eb; }
        .ninja-trading-lab .stat { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .ninja-trading-lab .stat-label { color: #9ca3af; }
        .ninja-trading-lab .highlight { color: #4ade80; font-weight: 600; }
        .ninja-trading-lab .note { margin-top: 10px; font-size: .78rem; color: yellow; display: flex; align-items: center; gap: 4px; }

        .ninja-trading-lab .chart-card { 
            margin-top: 10px; padding: 12px 14px 16px; border-radius: 14px; 
            background: #020617; border: 1px solid #111827;
        }
        .ninja-trading-lab .chart-title { 
            font-size: .9rem; margin-bottom: 6px; color: #e5e7eb; 
            display: flex; justify-content: space-between; align-items: center;
        }
        .ninja-trading-lab .chart-sub { font-size: .75rem; color: #9ca3af; }
        .ninja-trading-lab .chart-card {
    margin-top: 20px !important;
    padding: 20px !important;
    border-radius: 16px !important;
    background: #020617 !important;
    border: 1px solid #111827 !important;
    height: auto !important;
    min-height: 400px !important;     /* Give it breathing room */
}

.ninja-trading-lab #projectionChart {
    width: 100% !important;
    height: 380px !important;         /* Tall & proud */
    display: block !important;
}

/* Mobile: Scale down gracefully */
@media (max-width: 640px) {
    .ninja-trading-lab .chart-card {
        min-height: 320px !important;
        padding: 16px !important;
    }
    .ninja-trading-lab #projectionChart {
        height: 300px !important;
    }
}

        .ninja-trading-lab .rate-info { font-size: 0.7rem; color: #6b7280; text-align: right; margin-top: 4px; }
        .ninja-trading-lab .live-rate { font-size: 0.78rem; color: #bbf7d0; text-align: right; margin-top: 6px; }
        .ninja-trading-lab .horizontal-line { border-top: 1px solid #ccc; width: 100%; margin: 10px 0; }

        @media (max-width: 640px) {
            .ninja-trading-lab .app { border-radius: 0; min-height: 100vh; padding: 16px; }
            .ninja-trading-lab .header-row { flex-direction: column; align-items: flex-start; }
        }
        ";
    }

    private function get_js() {
        return $this->get_inline_js(); // Same as before — paste your working JS here
    }

    // ... paste your full working JS from previous version here ...

    private function get_inline_js() {
        return <<<'JS'
        document.addEventListener('DOMContentLoaded', function() {
            const CACHE_KEY = 'fx_rates_cache';
            const CACHE_TTL = 12 * 60 * 60 * 1000;
            const SUPPORTED = ['ZAR', 'USD', 'GBP', 'EUR'];
            const SYMBOLS = { ZAR: 'R', USD: '$', GBP: '£', EUR: '€' };
            const BASE_RATES_URL = 'https://open.er-api.com/v6/latest/USD';

            const currencySelect = document.getElementById('currency');
            const startInput = document.getElementById('start');
            const topupInput = document.getElementById('topup');
            const curStart = document.getElementById('curStart');
            const curTopup = document.getElementById('curTopup');
            const rateInfo = document.getElementById('rateInfo');
            const liveRate = document.getElementById('liveRate');

            let rates = {};
            let baseCurrency = 'USD';
            let lastUpdate = 0;
            let internalUSD = 100;
            let internalTopupUSD = 10;


            let apiKey = localStorage.getItem('er_apikey') || '';
            const apiKeyInput = document.getElementById('apiKey');
            if (apiKeyInput) {
                apiKeyInput.value = apiKey;
                apiKeyInput.addEventListener('change', () => {
                    apiKey = apiKeyInput.value.trim();
                    localStorage.setItem('er_apikey', apiKey);
                    fetchRates();
                });
            }

            const buildRatesUrl = (key) => {
                const trimmed = (key || '').trim();
                return trimmed ? `${BASE_RATES_URL}?apikey=${encodeURIComponent(trimmed)}` : BASE_RATES_URL;
            };


            function toInternal(amount, from) { return rates[from] ? amount / rates[from] : amount; }
            function fromInternal(amount, to) { return rates[to] ? amount * rates[to] : amount; }

            currencySelect.addEventListener('change', async () => {
                baseCurrency = currencySelect.value;
                if (Object.keys(rates).length === 0) await fetchRates();
                startInput.value = fromInternal(internalUSD, baseCurrency).toFixed(2);
                topupInput.value = fromInternal(internalTopupUSD, baseCurrency).toFixed(2);
                updateSymbols(); updateLiveRate(); updateAllProjections();
            });

            startInput.addEventListener('input', () => {
                internalUSD = toInternal(parseFloat(startInput.value) || 0, baseCurrency);
                debounce(updateAllProjections, 400);
            });
            topupInput.addEventListener('input', () => {
                internalTopupUSD = toInternal(parseFloat(topupInput.value) || 0, baseCurrency);
                debounce(updateAllProjections, 400);
            });
            ['daily', 'days', 'freq'].forEach(id => {
                document.getElementById(id).addEventListener('input', () => debounce(updateAllProjections, 400));
            });

            function formatMoney(n) {
                return SYMBOLS[baseCurrency] + n.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }
            function updateSymbols() {
                curStart.textContent = SYMBOLS[baseCurrency];
                curTopup.textContent = SYMBOLS[baseCurrency];
                document.querySelectorAll('[data-raw]').forEach(el => {
                    el.textContent = formatMoney(parseFloat(el.dataset.raw) || 0);
                });
            }

            function loadCache() {
                const cached = localStorage.getItem(CACHE_KEY);
                if (!cached) return null;
                try {
                    const { data, ts } = JSON.parse(cached);
                    if (Date.now() - ts < CACHE_TTL) { lastUpdate = ts; return data; }
                } catch (err) {
                    console.warn('Ignoring corrupt rate cache', err);
                    localStorage.removeItem(CACHE_KEY);
                }
                return null;
            }
            function saveCache(data) {
                const ts = Date.now();
                localStorage.setItem(CACHE_KEY, JSON.stringify({ data, ts }));
                lastUpdate = ts;
            }

            async function fetchRates() {
                const cached = loadCache();
                if (cached) {
                    rates = cached;
                    const hoursAgo = ((Date.now() - lastUpdate) / 3600000).toFixed(1);
                    rateInfo.textContent = `Rates cached ${hoursAgo}h ago`;
                    updateLiveRate();
                    return;
                }
                try {
                    rateInfo.textContent = 'Fetching live rates…';
                    liveRate.textContent = '';
                    const res = await fetch(buildRatesUrl(apiKey));
                    if (!res.ok) throw new Error(`HTTP \${res.status}`);
                    const json = await res.json();
                    if (json.result !== 'success') throw new Error(json['error-type'] || 'API error');
                    
                    rates = json.rates || {};
                    rates.USD = 1;
                    
                    saveCache(rates);
                    rateInfo.textContent = `Live rates @ ${new Date().toLocaleTimeString()}`;
                    updateLiveRate();
                } catch (e) {
                    console.error('Rate fetch failed', e);
                    rateInfo.textContent = 'API error – using cached/offline rates';
                    liveRate.textContent = '';
                    const fallback = loadCache();
                    if (fallback) { rates = fallback; updateLiveRate(); }
                }
            }

            function updateLiveRate() {
                if (!rates[baseCurrency] || baseCurrency === 'USD') {
                    liveRate.textContent = '';
                    return;
                }
                const rate = rates[baseCurrency].toFixed(4);
                liveRate.textContent = `1 USD = ${SYMBOLS[baseCurrency]}${rate}`;
            }

            function getInputsInBase() {
                return {
                    baseStart: internalUSD,
                    baseTopup: internalTopupUSD,
                    dailyPct: parseFloat(document.getElementById('daily').value) || 0,
                    days: parseInt(document.getElementById('days').value, 10) || 365,
                    freq: parseInt(document.getElementById('freq').value, 10) || 0
                };
            }

            function simulateProjection(baseStart, dailyPct, days, baseTopup, freqDays) {
                const dailyRate = 1 + dailyPct / 100;
                let balance = baseStart, contributed = baseStart;
                for (let d = 1; d <= days; d++) {
                    balance *= dailyRate;
                    if (freqDays && d % freqDays === 0 && baseTopup > 0) {
                        balance += baseTopup;
                        contributed += baseTopup;
                    }
                }
                return { balance, contributed, profit: balance - contributed };
            }

            function simulateSeries(baseStart, dailyPct, days, baseTopup, freqDays) {
                const dailyRate = 1 + dailyPct / 100;
                let balance = baseStart, contributed = baseStart;
                const labels = [], balances = [], contribs = [];
                for (let d = 1; d <= days; d++) {
                    balance *= dailyRate;
                    if (freqDays && d % freqDays === 0 && baseTopup > 0) {
                        balance += baseTopup;
                        contributed += baseTopup;
                    }
                    labels.push(d);
                    balances.push(balance);
                    contribs.push(contributed);
                }
                return { labels, balances, contribs };
            }

            function updateAllProjections() {
                const { baseStart, baseTopup, dailyPct, days, freq } = getInputsInBase();
                const show = v => fromInternal(v, baseCurrency);

                const r12 = simulateProjection(baseStart, dailyPct, 365, baseTopup, freq);
                document.getElementById('final12').textContent = formatMoney(show(r12.balance));
                document.getElementById('final12').dataset.raw = show(r12.balance);
                document.getElementById('contrib12').textContent = formatMoney(show(r12.contributed));
                document.getElementById('contrib12').dataset.raw = show(r12.contributed);
                document.getElementById('profit12').textContent = formatMoney(show(r12.profit));
                document.getElementById('profit12').dataset.raw = show(r12.profit);
                document.getElementById('cagr12').textContent = ((Math.pow(r12.balance / r12.contributed, 1) - 1) * 100).toFixed(2) + ' %';

                const rc = simulateProjection(baseStart, dailyPct, days, baseTopup, freq);
                document.getElementById('daysOut').textContent = days;
                document.getElementById('finalCustom').textContent = formatMoney(show(rc.balance));
                document.getElementById('finalCustom').dataset.raw = show(rc.balance);
                document.getElementById('contribCustom').textContent = formatMoney(show(rc.contributed));
                document.getElementById('contribCustom').dataset.raw = show(rc.contributed);
                document.getElementById('profitCustom').textContent = formatMoney(show(rc.profit));
                document.getElementById('profitCustom').dataset.raw = show(rc.profit);
                document.getElementById('cagrCustom').textContent = ((Math.pow(rc.balance / rc.contributed, 365 / days) - 1) * 100).toFixed(2) + ' %';

                const series = simulateSeries(baseStart, dailyPct, days, baseTopup, freq);
                const ctx = document.getElementById('projectionChart').getContext('2d');
                if (window.projChart) window.projChart.destroy();
                window.projChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: series.labels,
                        datasets: [
                            { label: 'Balance', data: series.balances.map(show), borderColor: '#4ade80', tension: 0.15 },
                            { label: 'Contributed', data: series.contribs.map(show), borderColor: '#94a3b8', borderDash: [5, 4], tension: 0.15 }
                        ]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: { tooltip: { callbacks: { label: c => c.dataset.label + ': ' + formatMoney(c.parsed.y) }}},
                        scales: { x: { title: { display: true, text: 'Day' }}, y: { ticks: { callback: formatMoney }}}
                    }
                });
                document.getElementById('chartInfo').textContent = `Simulated for ${days} days`;
            }

            let debounceTimer;
            function debounce(fn, delay) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(fn, delay);
            }

            document.getElementById('run').onclick = updateAllProjections;
            document.getElementById('runBoth').onclick = () => {
                document.getElementById('days').value = 730;
                updateAllProjections();
            };
            document.querySelectorAll('.chip[data-days]').forEach(c => {
                c.onclick = () => {
                    document.getElementById('days').value = c.dataset.days;
                    updateAllProjections();
                };
            });
            document.getElementById('resetBtn').onclick = () => {
                internalUSD = 100;
                internalTopupUSD = 10;
                startInput.value = fromInternal(100, baseCurrency).toFixed(2);
                topupInput.value = fromInternal(10, baseCurrency).toFixed(2);
                updateAllProjections();
            };

            (async () => {
                baseCurrency = currencySelect.value;
                await fetchRates();
                startInput.value = fromInternal(internalUSD, baseCurrency).toFixed(2);
                topupInput.value = fromInternal(internalTopupUSD, baseCurrency).toFixed(2);
                updateSymbols(); updateLiveRate(); updateAllProjections();
            })();
        });
JS;
    }
}
new Ninja_Trading_Lab();

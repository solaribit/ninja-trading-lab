<div class="app">
  <div class="header-row">
    <h1>Trading Compounding Projection Lab</h1>
    <div class="logo-pill"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M13 2 L3 14 H12 L11 22 L21 10 H12 L13 2 Z"></path>
      </svg><span>Ninja Trading Bot Lab</span></div>
  </div>
  <div class="subtitle">
    Enter your bot assumptions and see 12 &amp; 24 month projections with optional weekly/monthly top-ups.
  </div>

  <!-- CURRENCY SELECTOR -->
  <div class="field" style="grid-column:1/-1;">
    <label for="currency">Currency</label>
    <select id="currency">
      <option value="USD">$ (USD)</option>
      <option value="GBP">£ (GBP)</option>
      <option value="EUR">€ (EUR)</option>
      <option value="ZAR" selected>R (ZAR)</option>
    </select>
  </div>

  <!-- API KEY INPUT (NOW VISIBLE) -->
  <div class="field" style="grid-column:1/-1;">
    <label for="apiKey">
      <a href="https://www.exchangerate-api.com" target="_blank" rel="noopener">ExchangeRate-API</a> key 
      <small style="color:#9ca3af;">(optional – live rates)</small>
    </label>
    <input type="password" id="apiKey" placeholder="Paste your free API key here…" autocomplete="off">
    <div class="rate-info" id="rateInfo">Rates loading…</div>
    <div class="live-rate" id="liveRate"></div>
    <div class="horizontal-line"></div>
  </div>

  <!-- INPUT GRID -->
  <div class="grid">
    <div class="field">
      <label>Starting balance (<span id="curStart">R</span>)</label>
      <input type="number" id="start" value="100" min="0" step="0.01">
    </div>
    <div class="field">
      <label for="daily">Daily return (90day average %)</label>
      <input type="number" id="daily" value="0.15" step="0.01">
    </div>
    <div class="field">
      <label for="days">Duration (days)</label>
      <input type="number" id="days" value="365" min="1" step="1">
    </div>
    <div class="field">
      <label>Top-up amount (<span id="curTopup">R</span>)</label>
      <input type="number" id="topup" value="10" min="0" step="0.01">
    </div>
    <div class="field">
      <label for="freq">Top-up frequency</label>
      <select id="freq">
        <option value="0">None</option>
        <option value="1">Daily</option>
        <option value="7" selected>Weekly</option>
        <option value="30">Every 30 days</option>
      </select>
    </div>
  </div>

  <div class="presets">
    Quick duration presets:
    <span class="chip" data-days="365">12 months</span>
    <span class="chip" data-days="730">24 months</span>
    <span class="chip" data-days="1825">5 years</span>
    <span class="chip" id="resetBtn">Reset to $100</span>
  </div>

  <div class="actions">
    <button class="btn btn-primary" id="run">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M13 2 L3 14 H12 L11 22 L21 10 H12 L13 2 Z"></path>
      </svg>
      Run Projection
    </button>
    <button class="btn btn-ghost" id="runBoth">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M3 3v18h18"></path><rect x="7" y="12" width="3" height="6"></rect>
        <rect x="12" y="9" width="3" height="9"></rect><rect x="17" y="6" width="3" height="12"></rect>
      </svg>
      Show 12 &amp; 24 months
    </button>
  </div>

  <div class="results">
    <div class="card" id="summary12">
      <h2>12-Month Snapshot</h2>
      <div class="stat"><span class="stat-label">Final balance</span><span class="stat-value highlight" id="final12">R0.00</span></div>
      <div class="stat"><span class="stat-label">Total contributed</span><span class="stat-value" id="contrib12">R0.00</span></div>
      <div class="stat"><span class="stat-label">Net profit</span><span class="stat-value" id="profit12">R0.00</span></div>
      <div class="stat"><span class="stat-label">CAGR (approx)</span><span class="stat-value" id="cagr12">0.00 %</span></div>
      <div class="note">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2 L2 22 H22 L12 2 Z"></path><line x1="12" y1="9" x2="12" y2="13"></line><circle cx="12" cy="17" r="1"></circle>
        </svg>
        This is a toy projection tool: assumes constant daily %, no fees.
      </div>
    </div>
    <div class="card" id="summaryCustom">
      <h2>Custom Duration</h2>
      <div class="stat"><span class="stat-label">Days simulated</span><span class="stat-value" id="daysOut">0</span></div>
      <div class="stat"><span class="stat-label">Final balance</span><span class="stat-value highlight" id="finalCustom">R0.00</span></div>
      <div class="stat"><span class="stat-label">Total contributed</span><span class="stat-value" id="contribCustom">R0.00</span></div>
      <div class="stat"><span class="stat-label">Net profit</span><span class="stat-value" id="profitCustom">R0.00</span></div>
      <div class="stat"><span class="stat-label">CAGR (approx)</span><span class="stat-value" id="cagrCustom">0.00 %</span></div>
      <div class="note">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2 L2 22 H22 L12 2 Z"></path><line x1="12" y1="9" x2="12" y2="13"></line><circle cx="12" cy="17" r="1"></circle>
        </svg>
        This is a toy projection tool: assumes constant daily %, no fees.
      </div>
    </div>
  </div>

  <div class="chart-card">
    <div class="chart-title">
      <span>Balance vs Contributions Over Time</span>
      <span class="chart-sub" id="chartInfo">Simulated for 365 days</span>
    </div>
    <canvas id="projectionChart"></canvas>
  </div>

  <div class="note">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2 L2 22 H22 L12 2 Z"></path><line x1="12" y1="9" x2="12" y2="13"></line><circle cx="12" cy="17" r="1"></circle>
        </svg>
    This is a toy projection tool: it assumes perfect execution, no fees, no slippage and constant daily %.
  </div>
</div>
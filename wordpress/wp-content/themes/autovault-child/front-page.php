<?php
/**
 * Front page template — Silsbee Fleet Group homepage.
 * get_header() renders the SFG two-row nav; this file owns everything below.
 * wp_footer() is called manually; get_footer() is intentionally omitted.
 */
get_header();
?>
<div class="sfg-page">

<!-- HERO -->
<section class="hero" id="home">
  <div class="hero-bg">
    <video class="hero-video" autoplay muted loop playsinline preload="auto" poster="<?php echo esc_url( content_url( 'uploads/2026/01/video-01.mp4' ) ); ?>">
      <source src="<?php echo esc_url( content_url( 'uploads/2026/01/video-01.mp4' ) ); ?>" type="video/mp4">
    </video>
  </div>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h1 class="hero-h1">The Fleet Your Agency Needs&nbsp;&mdash; Ready to Deploy.</h1>
    <p class="hero-p">Silsbee Fleet Group is a Ford-certified fleet dealer serving government agencies, municipalities, and commercial fleets across Texas. HGAC &amp; state contract pricing available.</p>
    <button class="hero-btn" onclick="var t=document.getElementById('contact');if(t)t.scrollIntoView({behavior:'smooth'})">Request a Quote</button>
  </div>
</section>

<!-- CONTRACT BAR -->
<?php echo sfg_render_cbar(); ?>

<!-- STATS -->
<div class="stats-row">
  <div class="stat rv"><div class="stat-n">100<span class="b">K+</span></div><div class="stat-l">Vehicles Delivered</div></div>
  <div class="stat rv d1"><div class="stat-n">8<span class="g">K+</span></div><div class="stat-l">Sold Annually</div></div>
  <div class="stat rv d2"><div class="stat-n">3<span class="b">K+</span></div><div class="stat-l">Active Customers</div></div>
  <div class="stat rv d3"><div class="stat-n">30<span class="g">+</span></div><div class="stat-l">Years in Business</div></div>
</div>

<!-- UPFITTING -->
<section class="section" id="upfitting">
  <div class="sec-eye">Upfitting &amp; Build Services</div>
  <h2 class="sec-title">Job-ready on <span class="c">arrival.</span></h2>
  <p class="sec-sub">Every build coordinated through our vendor network &mdash; vehicles arrive configured and deployable.</p>
  <div class="sfg-deck rv d1">
    <main class="deck-stage" aria-label="Upfit category accordion">
      <div class="deck-status">
        <span class="deck-led"></span>
        <span class="deck-status-text">Now viewing: <b data-deck-status-name>Law Enforcement</b></span>
        <span class="deck-status-hint">Tip: Use &larr; &rarr; keys</span>
      </div>
      <section class="deck-accordion" data-deck-accordion>
        <article class="deck-panel deck-active" data-title="Law Enforcement" data-accent="#00AEEF" style="--deck-bg:url('<?php echo esc_url( content_url( 'uploads/2026/05/sfg-upfit-law.jpg' ) ); ?>')">
          <div class="deck-panel-bg" aria-hidden="true"></div>
          <div class="deck-panel-content">
            <div class="deck-panel-kicker">
              <span class="deck-pill">Build Category</span>
              <span class="deck-pill deck-ghost">Partner: Defender Supply</span>
            </div>
            <div class="deck-panel-id">01</div>
            <h3 class="deck-panel-title">Law Enforcement</h3>
            <p class="deck-panel-subtitle">Pursuit-rated patrol upfit with full duty package &mdash; light bars, push bumpers, cages, K-9 systems, and ballistic panels.</p>
            <div class="deck-grid">
              <div class="deck-specs">
                <div class="deck-row"><span class="deck-k">Build Type</span><span class="deck-v">Pursuit-rated</span></div>
                <div class="deck-row"><span class="deck-k">Lead Time</span><span class="deck-v">4&ndash;6 weeks</span></div>
                <div class="deck-row"><span class="deck-k">Contracts</span><span class="deck-v">HGAC &middot; TxSmartBuy</span></div>
                <div class="deck-row"><span class="deck-k">Compliance</span><span class="deck-v">Texas DPS</span></div>
              </div>
              <div class="deck-meta">
                <div class="deck-meta-card">
                  <div class="deck-meta-top">
                    <span class="deck-label">Build Slots</span>
                    <span class="deck-value">Q2 &middot; 2026</span>
                  </div>
                  <div class="deck-bar"><span class="deck-bar-fill" style="width:72%"></span></div>
                  <div class="deck-fine">Schedule capacity: 72%</div>
                </div>
                <div class="deck-badges">
                  <span class="deck-badge">Light bars</span>
                  <span class="deck-badge">Cages</span>
                  <span class="deck-badge">K-9 systems</span>
                </div>
              </div>
            </div>
            <div class="deck-cta-row">
              <a class="deck-cta" href="<?php echo esc_url( get_permalink( get_page_by_path('quote') ) ); ?>">Request a Quote <span class="deck-cta-ico" aria-hidden="true">&#8599;</span></a>
              <a class="deck-ghost-btn" href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ); ?>">Talk to upfit team</a>
            </div>
          </div>
          <button class="deck-corner" type="button" aria-label="Open details"></button>
        </article>
        <article class="deck-panel" data-title="Work Truck Builds" data-accent="#7AA7FF" style="--deck-bg:url('<?php echo esc_url( content_url( 'uploads/2026/05/sfg-upfit-worktruck.jpg' ) ); ?>')">
          <div class="deck-panel-bg" aria-hidden="true"></div>
          <div class="deck-panel-content">
            <div class="deck-panel-kicker">
              <span class="deck-pill">Build Category</span>
              <span class="deck-pill deck-ghost">Partner: Knapheide</span>
            </div>
            <div class="deck-panel-id">02</div>
            <h3 class="deck-panel-title">Work Truck Builds</h3>
            <p class="deck-panel-subtitle">Service bodies and utility builds for municipal field operations &mdash; from cargo shelving to crane and lift gates.</p>
            <div class="deck-grid">
              <div class="deck-specs">
                <div class="deck-row"><span class="deck-k">Body Style</span><span class="deck-v">Service / Utility / Flatbed</span></div>
                <div class="deck-row"><span class="deck-k">Lead Time</span><span class="deck-v">6&ndash;10 weeks</span></div>
                <div class="deck-row"><span class="deck-k">Crane</span><span class="deck-v">Up to 6,000 lb cap.</span></div>
                <div class="deck-row"><span class="deck-k">Lift Gate</span><span class="deck-v">Optional, rated</span></div>
              </div>
              <div class="deck-meta">
                <div class="deck-meta-card">
                  <div class="deck-meta-top">
                    <span class="deck-label">Build Slots</span>
                    <span class="deck-value">Q3 &middot; 2026</span>
                  </div>
                  <div class="deck-bar"><span class="deck-bar-fill" style="width:58%"></span></div>
                  <div class="deck-fine">Schedule capacity: 58%</div>
                </div>
                <div class="deck-badges">
                  <span class="deck-badge">Service bodies</span>
                  <span class="deck-badge">Utility beds</span>
                  <span class="deck-badge">Cranes</span>
                </div>
              </div>
            </div>
            <div class="deck-cta-row">
              <a class="deck-cta" href="<?php echo esc_url( get_permalink( get_page_by_path('quote') ) ); ?>">Request a Quote <span class="deck-cta-ico" aria-hidden="true">&#8599;</span></a>
              <a class="deck-ghost-btn" href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ); ?>">Talk to upfit team</a>
            </div>
          </div>
          <button class="deck-corner" type="button" aria-label="Open details"></button>
        </article>
        <article class="deck-panel" data-title="Mobility &amp; ADA" data-accent="#FFD36A" style="--deck-bg:url('<?php echo esc_url( content_url( 'uploads/2026/05/sfg-upfit-mobility.jpg' ) ); ?>')">
          <div class="deck-panel-bg" aria-hidden="true"></div>
          <div class="deck-panel-content">
            <div class="deck-panel-kicker">
              <span class="deck-pill">Build Category</span>
              <span class="deck-pill deck-ghost">Certified ADA conversions</span>
            </div>
            <div class="deck-panel-id">03</div>
            <h3 class="deck-panel-title">Mobility &amp; ADA</h3>
            <p class="deck-panel-subtitle">Wheelchair-accessible vans and shuttles with certified ramps, lifts, and full accessibility conversions for transit agencies.</p>
            <div class="deck-grid">
              <div class="deck-specs">
                <div class="deck-row"><span class="deck-k">Ramp Type</span><span class="deck-v">Side-entry / Rear lift</span></div>
                <div class="deck-row"><span class="deck-k">Lead Time</span><span class="deck-v">8&ndash;12 weeks</span></div>
                <div class="deck-row"><span class="deck-k">Certification</span><span class="deck-v">FMVSS / ADA</span></div>
                <div class="deck-row"><span class="deck-k">Capacity</span><span class="deck-v">1&ndash;4 wheelchair stations</span></div>
              </div>
              <div class="deck-meta">
                <div class="deck-meta-card">
                  <div class="deck-meta-top">
                    <span class="deck-label">Build Slots</span>
                    <span class="deck-value">Q3 &middot; 2026</span>
                  </div>
                  <div class="deck-bar"><span class="deck-bar-fill" style="width:84%"></span></div>
                  <div class="deck-fine">Schedule capacity: 84%</div>
                </div>
                <div class="deck-badges">
                  <span class="deck-badge">ADA-compliant</span>
                  <span class="deck-badge">Transit-ready</span>
                  <span class="deck-badge">Federal-funded</span>
                </div>
              </div>
            </div>
            <div class="deck-cta-row">
              <a class="deck-cta" href="<?php echo esc_url( get_permalink( get_page_by_path('quote') ) ); ?>">Request a Quote <span class="deck-cta-ico" aria-hidden="true">&#8599;</span></a>
              <a class="deck-ghost-btn" href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ); ?>">Talk to upfit team</a>
            </div>
          </div>
          <button class="deck-corner" type="button" aria-label="Open details"></button>
        </article>
        <article class="deck-panel" data-title="Fleet-Wide" data-accent="#7CFFB2" style="--deck-bg:url('<?php echo esc_url( content_url( 'uploads/2026/05/sfg-upfit-fleet.jpg' ) ); ?>')">
          <div class="deck-panel-bg" aria-hidden="true"></div>
          <div class="deck-panel-content">
            <div class="deck-panel-kicker">
              <span class="deck-pill">Build Category</span>
              <span class="deck-pill deck-ghost">Partner: Dana Safety Supply</span>
            </div>
            <div class="deck-panel-id">04</div>
            <h3 class="deck-panel-title">Fleet-Wide</h3>
            <p class="deck-panel-subtitle">Branding, graphics, warning equipment, and tow packages applied across the entire fleet on a single coordinated timeline.</p>
            <div class="deck-grid">
              <div class="deck-specs">
                <div class="deck-row"><span class="deck-k">Coverage</span><span class="deck-v">Full-fleet rollout</span></div>
                <div class="deck-row"><span class="deck-k">Lead Time</span><span class="deck-v">2&ndash;4 weeks</span></div>
                <div class="deck-row"><span class="deck-k">Brand Match</span><span class="deck-v">Pantone-spec wraps</span></div>
                <div class="deck-row"><span class="deck-k">Warning</span><span class="deck-v">LED / strobe / siren</span></div>
              </div>
              <div class="deck-meta">
                <div class="deck-meta-card">
                  <div class="deck-meta-top">
                    <span class="deck-label">Build Slots</span>
                    <span class="deck-value">Q2 &middot; 2026</span>
                  </div>
                  <div class="deck-bar"><span class="deck-bar-fill" style="width:66%"></span></div>
                  <div class="deck-fine">Schedule capacity: 66%</div>
                </div>
                <div class="deck-badges">
                  <span class="deck-badge">Graphics</span>
                  <span class="deck-badge">Tinting</span>
                  <span class="deck-badge">Warning lights</span>
                </div>
              </div>
            </div>
            <div class="deck-cta-row">
              <a class="deck-cta" href="<?php echo esc_url( get_permalink( get_page_by_path('quote') ) ); ?>">Request a Quote <span class="deck-cta-ico" aria-hidden="true">&#8599;</span></a>
              <a class="deck-ghost-btn" href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ); ?>">Talk to upfit team</a>
            </div>
          </div>
          <button class="deck-corner" type="button" aria-label="Open details"></button>
        </article>
      </section>
      <button class="deck-nav deck-nav-prev" type="button" aria-label="Previous">&lsaquo;</button>
      <button class="deck-nav deck-nav-next" type="button" aria-label="Next">&rsaquo;</button>
    </main>
  </div>
</section>

<!-- VEHICLES -->
<section class="section-alt" id="vehicles">
  <div class="v-hdr">
    <div>
      <div class="sec-eye">Vehicle Solutions</div>
      <h2 class="sec-title">Built for your <span class="c">mission.</span></h2>
    </div>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('brands') ) ); ?>" class="lnk">View all <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
  </div>
  <div class="v-grid">
    <a class="vc rv" href="<?php echo esc_url( get_permalink( get_page_by_path('ford-fleet') ) ); ?>">
      <div class="vc-img"><img src="<?php echo esc_url( content_url( 'uploads/2026/05/sfg-law-enforcement.jpg' ) ); ?>" alt="Police patrol vehicle" loading="lazy"></div>
      <div class="vc-top"></div>
      <div class="vc-body">
        <div class="vc-cat">Law Enforcement</div>
        <div class="vc-title">Police &amp; Patrol Vehicles</div>
        <div class="vc-desc">Pursuit-rated platforms, patrol SUVs, and command vehicles. Upfit-ready and contract-eligible.</div>
        <div class="vc-pills"><span class="vc-pill">Police Interceptor</span><span class="vc-pill">Tahoe PPV</span><span class="vc-pill">Charger Pursuit</span></div>
        <div class="vc-arrow">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
      </div>
    </a>
    <a class="vc rv d1" href="<?php echo esc_url( get_permalink( get_page_by_path('chevrolet-fleet') ) ); ?>">
      <div class="vc-img"><img src="<?php echo esc_url( content_url( 'uploads/2026/05/sfg-work-fleet.jpg' ) ); ?>" alt="Pickup truck and work fleet vehicle" loading="lazy"></div>
      <div class="vc-top gray"></div>
      <div class="vc-body">
        <div class="vc-cat">Work Fleet</div>
        <div class="vc-title">White Fleet &amp; Work Trucks</div>
        <div class="vc-desc">Pickups, cargo vans, and utility vehicles for municipal departments and field operations.</div>
        <div class="vc-pills"><span class="vc-pill">F-150 / F-250</span><span class="vc-pill">Silverado HD</span><span class="vc-pill">Ram 2500</span></div>
        <div class="vc-arrow">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
      </div>
    </a>
    <a class="vc rv d2" href="<?php echo esc_url( get_permalink( get_page_by_path('dodge-ram-fleet') ) ); ?>">
      <div class="vc-img"><img src="<?php echo esc_url( content_url( 'uploads/2026/05/sfg-transportation.jpg' ) ); ?>" alt="Cargo van for passenger transit" loading="lazy"></div>
      <div class="vc-top gray"></div>
      <div class="vc-body">
        <div class="vc-cat">Transportation</div>
        <div class="vc-title">Transportation &amp; Transit</div>
        <div class="vc-desc">Passenger vans, ADA-accessible platforms, and shuttles for agencies and service organizations.</div>
        <div class="vc-pills"><span class="vc-pill">Ford Transit</span><span class="vc-pill">ProMaster</span><span class="vc-pill">ADA Conversions</span></div>
        <div class="vc-arrow">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
      </div>
    </a>
    <a class="vc rv d3" href="<?php echo esc_url( get_permalink( get_page_by_path('toyota-fleet') ) ); ?>">
      <div class="vc-img"><img src="<?php echo esc_url( content_url( 'uploads/2026/05/sfg-specialty.jpg' ) ); ?>" alt="Electric pickup truck for specialty fleet" loading="lazy"></div>
      <div class="vc-top"></div>
      <div class="vc-body">
        <div class="vc-cat">Specialty</div>
        <div class="vc-title">Other Uses &amp; Specialty</div>
        <div class="vc-desc">Public works, emergency management, EV/hybrid, and mixed-use fleets.</div>
        <div class="vc-pills"><span class="vc-pill">F-150 Lightning</span><span class="vc-pill">Silverado EV</span><span class="vc-pill">Tundra</span></div>
        <div class="vc-arrow">Explore <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></div>
      </div>
    </a>
  </div>
</section>

<!-- PROCESS -->
<section class="section" id="process">
  <div class="sec-eye">How It Works</div>
  <h2 class="sec-title">From spec to <span class="c">street.</span></h2>
  <div class="proc-grid">
    <div class="proc-step rv"><div class="proc-bg-num">01</div><div class="proc-ind">1</div><div class="proc-title">Tell us what you need</div><div class="proc-desc">Vehicle type, quantity, use case, and timeline. A starting point is enough.</div></div>
    <div class="proc-step rv d1"><div class="proc-bg-num">02</div><div class="proc-ind">2</div><div class="proc-title">We source &amp; confirm</div><div class="proc-desc">We match across our manufacturer network and confirm your contract eligibility.</div></div>
    <div class="proc-step rv d2"><div class="proc-bg-num">03</div><div class="proc-ind">3</div><div class="proc-title">Delivered &amp; deployable</div><div class="proc-desc">Coordinated upfitting, full documentation, and delivery to your agency.</div></div>
  </div>
</section>

<!-- ABOUT -->
<div class="about-grid" id="about">
  <div class="about-left">
    <div class="sec-eye">About</div>
    <h2 class="about-title">Fleet procurement specialists,<br><span class="c">not a retail dealership.</span></h2>
    <p class="about-p">Our team understands state contracts, cooperative purchasing, lead times, and government approval processes. The first question is always what the job requires &mdash; not what&rsquo;s on the lot.</p>
    <button class="btn-primary" onclick="var t=document.getElementById('contact');if(t)t.scrollIntoView({behavior:'smooth'})">Request a Quote</button>
  </div>
  <div class="about-right">
    <div class="mfr-label">Manufacturers we source from</div>
    <div class="mfr-list">
      <div class="mfr-item">Ford <span>Police, Fleet, Commercial &amp; EV</span></div>
      <div class="mfr-item">Chevrolet <span>#1 Tahoe PPV volume nationally</span></div>
      <div class="mfr-item">Dodge / Ram <span>Pursuit, utility &amp; work fleet</span></div>
      <div class="mfr-item">Toyota <span>High retention, hybrid options</span></div>
    </div>
  </div>
</div>

<!-- CTA -->
<section class="cta-band" id="contact">
  <div>
    <h2 class="cta-title">Ready to talk <span class="c">fleet?</span></h2>
    <p class="cta-sub">A specialist responds within one business day &mdash; no retail pressure, no runaround.</p>
  </div>
</section>


</div><!-- .sfg-page -->

<script>
(function(){
  class NeonAccordion {
    constructor(wrap) {
      this.wrap = wrap;
      this.root = wrap.querySelector('[data-deck-accordion]');
      this.panels = [...this.root.querySelectorAll('.deck-panel')];
      this.prev = wrap.querySelector('.deck-nav-prev');
      this.next = wrap.querySelector('.deck-nav-next');
      this.statusName = wrap.querySelector('[data-deck-status-name]');
      this.modeText = wrap.querySelector('[data-deck-mode-text]');
      this.led = wrap.querySelector('.deck-led');
      this.dot = wrap.querySelector('.deck-dot');
      this.ambientOn = false;
      this.index = Math.max(0, this.panels.findIndex(p => p.classList.contains('deck-active')));
      this.bind();
      this.apply(this.index, false);
    }
    bind() {
      this.panels.forEach(p => {
        p.addEventListener('click', () => {
          const liveIndex = this.panels.indexOf(p);
          if (liveIndex !== -1) this.apply(liveIndex, true);
        });
        p.addEventListener('mousemove', (e) => {
          if (!p.classList.contains('deck-active')) return;
          const bg = p.querySelector('.deck-panel-bg');
          if (!bg) return;
          const r = p.getBoundingClientRect();
          const x = (e.clientX - r.left) / r.width - 0.5;
          const y = (e.clientY - r.top) / r.height - 0.5;
          bg.style.transform = `scale(1.14) translate(${x * 10}px, ${y * 8}px)`;
        });
        p.addEventListener('mouseleave', () => {
          const bg = p.querySelector('.deck-panel-bg');
          if (bg) bg.style.transform = '';
        });
      });
      this.prev && this.prev.addEventListener('click', (e) => { e.stopPropagation(); this.go(-1); });
      this.next && this.next.addEventListener('click', (e) => { e.stopPropagation(); this.go(1); });
      document.addEventListener('keydown', (e) => {
        const tag = (e.target && e.target.tagName) || '';
        if (tag === 'INPUT' || tag === 'TEXTAREA') return;
        if (e.key === 'ArrowLeft') this.go(-1);
        if (e.key === 'ArrowRight') this.go(1);
        if (e.key.toLowerCase() === 'a') this.toggleAmbient();
        if (e.key.toLowerCase() === 's') this.shuffle();
      });
      this.wrap.querySelectorAll('[data-deck-action]').forEach(btn => {
        btn.addEventListener('click', () => {
          const action = btn.getAttribute('data-deck-action');
          if (action === 'toggle-ambient') this.toggleAmbient();
          if (action === 'shuffle') this.shuffle();
        });
      });
      this.wrap.addEventListener('click', (e) => {
        const btn = e.target.closest('.deck-corner');
        if (!btn) return;
        e.stopPropagation();
        const title = this.panels[this.index] && this.panels[this.index].dataset.title || 'Item';
        this.toast(`${title}: details opened`);
      });
    }
    refreshPanels() { this.panels = [...this.root.querySelectorAll('.deck-panel')]; }
    resetActive() {
      this.panels.forEach(p => {
        p.classList.remove('deck-active');
        const bg = p.querySelector('.deck-panel-bg');
        if (bg) bg.style.transform = '';
      });
      this.index = 0;
      if (this.panels[0]) this.panels[0].classList.add('deck-active');
    }
    apply(i, focusLed = true) {
      if (!this.panels.length) return;
      this.panels.forEach(p => p.classList.remove('deck-active'));
      const panel = this.panels[i] || this.panels[0];
      panel.classList.add('deck-active');
      this.index = this.panels.indexOf(panel);
      const title = panel.dataset.title || `Item ${String(this.index + 1).padStart(2, '0')}`;
      const accent = panel.dataset.accent || '#7CFFB2';
      if (this.statusName) this.statusName.textContent = title;
      if (this.led) {
        this.led.style.background = accent;
        this.led.style.boxShadow = `0 0 18px ${this.hexToRgba(accent, 0.55)}`;
        if (focusLed && this.led.animate) {
          this.led.animate(
            [{ transform: 'scale(1)' }, { transform: 'scale(1.25)' }, { transform: 'scale(1)' }],
            { duration: 420, easing: 'ease-out' }
          );
        }
      }
      if (this.dot) {
        this.dot.style.background = accent;
        this.dot.style.boxShadow = `0 0 18px ${this.hexToRgba(accent, 0.55)}`;
      }
      this.panels.forEach((p, idx) => p.setAttribute('aria-selected', idx === this.index ? 'true' : 'false'));
    }
    go(delta) {
      if (!this.panels.length) return;
      const next = (this.index + delta + this.panels.length) % this.panels.length;
      this.apply(next, true);
    }
    toggleAmbient() {
      this.ambientOn = !this.ambientOn;
      this.wrap.classList.toggle('deck-ambient', this.ambientOn);
      if (this.modeText) this.modeText.textContent = this.ambientOn ? 'Mode: Ambient' : 'Mode: Crisp';
      const btn = this.wrap.querySelector('[data-deck-action="toggle-ambient"]');
      if (btn) btn.textContent = this.ambientOn ? 'Crisp' : 'Ambient';
      this.toast(this.ambientOn ? 'Ambient mode enabled' : 'Crisp mode enabled');
    }
    shuffle() {
      const a = [...this.panels];
      for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
      }
      a.forEach(p => this.root.appendChild(p));
      this.refreshPanels();
      this.resetActive();
      this.apply(0, true);
      this.toast('Lineup shuffled + reset');
    }
    toast(text) {
      let t = document.querySelector('.sfg-deck-toast');
      if (!t) {
        t = document.createElement('div');
        t.className = 'sfg-deck-toast';
        document.body.appendChild(t);
      }
      t.textContent = text;
      t.animate(
        [
          { opacity: 0, transform: 'translateX(-50%) translateY(8px)' },
          { opacity: 1, transform: 'translateX(-50%) translateY(0)' },
          { opacity: 1, transform: 'translateX(-50%) translateY(0)' },
          { opacity: 0, transform: 'translateX(-50%) translateY(8px)' }
        ],
        { duration: 1800, easing: 'cubic-bezier(.2,.8,.2,1)' }
      );
    }
    hexToRgba(hex, a = 1) {
      const h = hex.replace('#', '').trim();
      const full = h.length === 3 ? h.split('').map(c => c + c).join('') : h;
      const n = parseInt(full, 16);
      return `rgba(${(n >> 16) & 255},${(n >> 8) & 255},${n & 255},${a})`;
    }
  }
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.sfg-deck').forEach(wrap => new NeonAccordion(wrap));
  });
})();
</script>
<?php get_footer(); ?>

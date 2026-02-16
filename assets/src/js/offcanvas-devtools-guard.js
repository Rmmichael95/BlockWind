/**
 * Keep WP Navigation overlay from closing when DevTools steals focus.
 *
 * Preserves default WP behavior:
 * - Click backdrop closes (pointer interaction) ✅
 * - Esc closes ✅
 * - Tabbing/focus navigation closes per WP logic ✅
 *
 * Only blocks the "focusout" that happens when the document loses focus
 * (common when interacting with DevTools or switching away).
 */
(() => {
  const ROOT = document.documentElement;

  let cleanup = null;
  let lastPointerAt = 0;
  let lastTabAt = 0;

  const RECENT_MS = 250;

  function isOverlayOpen() {
    return ROOT.classList.contains("has-modal-open");
  }

  function mount() {
    const container = document.querySelector(
      ".site-nav .wp-block-navigation__responsive-container.is-menu-open",
    );
    if (!container) return;

    // Avoid double mount
    if (cleanup) return;

    const onPointerDownCapture = () => {
      lastPointerAt = Date.now();
    };

    const onKeyDownCapture = (e) => {
      if (e.key === "Tab") lastTabAt = Date.now();
    };

    const onFocusOutCapture = (e) => {
      const now = Date.now();
      const hadRecentPointer = now - lastPointerAt <= RECENT_MS;
      const hadRecentTab = now - lastTabAt <= RECENT_MS;

      // If the document is losing focus (DevTools / switching apps),
      // prevent WP's focusout handler from treating it as "leave modal".
      // But allow normal user interactions (pointer/tab) to behave normally.
      const docLostFocus = !document.hasFocus();

      if (docLostFocus && !hadRecentPointer && !hadRecentTab) {
        e.stopPropagation();
      }
    };

    // Track interaction context (only while overlay is open)
    document.addEventListener("pointerdown", onPointerDownCapture, true);
    document.addEventListener("keydown", onKeyDownCapture, true);

    // Beat WP interactivity bubbling handler by capturing on the container
    container.addEventListener("focusout", onFocusOutCapture, true);

    cleanup = () => {
      document.removeEventListener("pointerdown", onPointerDownCapture, true);
      document.removeEventListener("keydown", onKeyDownCapture, true);
      container.removeEventListener("focusout", onFocusOutCapture, true);
      cleanup = null;
      lastPointerAt = 0;
      lastTabAt = 0;
    };
  }

  function unmount() {
    if (cleanup) cleanup();
  }

  // Watch for open/close (WP toggles has-modal-open on <html>)
  const obs = new MutationObserver(() => {
    if (isOverlayOpen()) mount();
    else unmount();
  });

  obs.observe(ROOT, { attributes: true, attributeFilter: ["class"] });

  // Initial
  if (isOverlayOpen()) mount();
})();

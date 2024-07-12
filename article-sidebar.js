(() => {
  const mm = window.matchMedia("(max-width: 768px)");
  const sidebar = document.getElementById("sidebar-left");
  let timeout;
  let animation;
  let pointerInside = false;

  mm.addEventListener("change", init);
  init(mm);

  function init(e) {
    if (e.matches) {
      toggleSidebar(false);

      sidebar.onpointermove = () => {
        pointerInside = true;
        if (timeout) {
          clearTimeout(timeout);
        }
      };

      sidebar.onpointerleave = () => {
        pointerInside = false;
        hideSidebarQueue();
      };

      window.addEventListener("scroll", handleScroll);
    } else {
      animation?.cancel();

      sidebar.onpointermove = null;
      sidebar.onpointerleave = null;
      window.removeEventListener("scroll", handleScroll);
    }
  }

  function handleScroll() {
    if (timeout) {
      clearTimeout(timeout);
    } else {
      toggleSidebar(true);
    }

    !pointerInside && hideSidebarQueue();
  }

  function hideSidebarQueue() {
    timeout = setTimeout(() => {
      timeout = null;
      toggleSidebar(false);
    }, 1000);
  }

  function toggleSidebar(state) {
    const keyframe = state ? { opacity: 1 } : { opacity: 0 };

    animation = sidebar.animate(keyframe, {
      duration: 200,
      fill: "forwards",
      easing: "ease-out",
    });
  }
})();

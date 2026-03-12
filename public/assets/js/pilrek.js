/* =============================================
   PILREK USN KOLAKA - JavaScript
   ============================================= */

document.addEventListener("DOMContentLoaded", function () {
    // ===== NAVBAR SCROLL EFFECT =====
    const navbar = document.getElementById("pilrekNavbar");
    const backToTop = document.getElementById("backToTop");

    function handleScroll() {
        if (window.scrollY > 50) {
            navbar?.classList.add("scrolled");
            backToTop?.classList.add("show");
        } else {
            navbar?.classList.remove("scrolled");
            backToTop?.classList.remove("show");
        }
    }

    window.addEventListener("scroll", handleScroll);
    handleScroll();

    // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const targetId = this.getAttribute("href");
            if (targetId === "#") return;

            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: "smooth", block: "start" });

                // Close mobile nav
                const navCollapse = document.querySelector(".navbar-collapse");
                if (navCollapse?.classList.contains("show")) {
                    const bsCollapse =
                        bootstrap.Collapse.getInstance(navCollapse);
                    bsCollapse?.hide();
                }
            }
        });
    });

    // ===== ACTIVE NAV LINK ON SCROLL =====
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(
        '.pilrek-navbar .nav-link[href^="#"]',
    );

    function updateActiveNav() {
        const scrollPos = window.scrollY + 120;
        sections.forEach((section) => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            const id = section.getAttribute("id");

            if (scrollPos >= top && scrollPos < top + height) {
                navLinks.forEach((link) => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === "#" + id) {
                        link.classList.add("active");
                    }
                });
            }
        });
    }

    window.addEventListener("scroll", updateActiveNav);

    // ===== INITIALIZE AOS ANIMATIONS =====
    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 700,
            easing: "ease-out-cubic",
            once: true,
            offset: 50,
        });
    }

    // ===== ANIMATED COUNTER =====
    const counters = document.querySelectorAll("[data-counter]");
    const counterObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute("data-counter"));
                    const suffix = el.getAttribute("data-suffix") || "";
                    animateCounter(el, 0, target, 1500, suffix);
                    counterObserver.unobserve(el);
                }
            });
        },
        { threshold: 0.5 },
    );

    counters.forEach((counter) => counterObserver.observe(counter));

    function animateCounter(el, start, end, duration, suffix) {
        const startTime = performance.now();
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeOut = 1 - Math.pow(1 - progress, 3);
            const current = Math.round(start + (end - start) * easeOut);
            el.textContent = current + suffix;
            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }
        requestAnimationFrame(update);
    }

    // ===== PROGRESS BAR ANIMATION =====
    const progressBar = document.querySelector(".progress-bar-pilrek .bar");
    if (progressBar) {
        const progressObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const width = progressBar.getAttribute("data-width");
                        progressBar.style.width = width + "%";
                        progressObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.3 },
        );

        progressObserver.observe(progressBar.parentElement);
    }

    // ===== TIMELINE DATE FORMATTER =====
    document.querySelectorAll("[data-date]").forEach((el) => {
        const date = new Date(el.getAttribute("data-date"));
        const options = { day: "numeric", month: "long", year: "numeric" };
        el.textContent = date.toLocaleDateString("id-ID", options);
    });
});

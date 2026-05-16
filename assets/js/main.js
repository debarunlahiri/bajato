document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll("header[id], section[id]");
    const navLinks = document.querySelectorAll(".nav-link");
    const siteHeader = document.querySelector(".site-header");
    const mainNav = document.querySelector("#mainNav");
    const carouselElement = document.querySelector("#productShowcaseCarousel");
    const revealTargets = document.querySelectorAll(
        ".hero-panel, .info-card, .product-card, .media-frame, .feature-item, .content-panel, .icon-card, .metric-card, .contact-panel"
    );
    let lastScrollY = window.scrollY;
    let headerCompact = false;

    const setActiveLink = () => {
        let currentId = "";

        sections.forEach((section) => {
            const top = window.scrollY + 140;
            if (top >= section.offsetTop) {
                currentId = section.getAttribute("id");
            }
        });

        navLinks.forEach((link) => {
            const href = link.getAttribute("href");
            link.classList.toggle("active", href === `#${currentId}`);
        });
    };

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("reveal", "is-visible");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.14 }
    );

    revealTargets.forEach((target) => {
        target.classList.add("reveal");
        observer.observe(target);
    });

    const syncHeaderState = () => {
        if (!siteHeader) {
            return;
        }

        const currentScrollY = window.scrollY;
        const delta = currentScrollY - lastScrollY;
        const isAtTop = currentScrollY <= 10;

        if (isAtTop) {
            headerCompact = false;
        } else if (!headerCompact && currentScrollY > 140 && delta > 8) {
            headerCompact = true;
        } else if (headerCompact && delta < -8) {
            headerCompact = false;
        }

        siteHeader.classList.toggle("is-compact", headerCompact);
        lastScrollY = currentScrollY;
    };

    const syncCarouselMedia = () => {
        if (!carouselElement) {
            return;
        }

        const videos = carouselElement.querySelectorAll("video");
        videos.forEach((video) => {
            const slide = video.closest(".carousel-item");
            if (slide && slide.classList.contains("active")) {
                video.play().catch(() => {});
            } else {
                video.pause();
            }
        });
    };

    const anchorHeadingTargets = {
        "#about": "#about .col-lg-7",
        "#products": "#products .products-showcase-head",
        "#process": "#process .operations-intro",
        "#manufacturing": "#process .operations-intro",
        "#compliance": "#compliance .section-heading",
        "#contact": "#contact .contact-panel",
    };

    const getHeaderOffset = () => {
        if (!siteHeader) {
            return 120;
        }

        const navbar = siteHeader.querySelector(".navbar");
        const visibleHeaderHeight = navbar ? navbar.offsetHeight : siteHeader.offsetHeight;
        let landingGap = 34;

        if (window.matchMedia("(max-width: 575.98px)").matches) {
            landingGap = 18;
        } else if (window.matchMedia("(max-width: 991.98px)").matches) {
            landingGap = 22;
        } else if (window.matchMedia("(max-width: 1199.98px)").matches) {
            landingGap = 28;
        }

        return visibleHeaderHeight + landingGap;
    };

    const closeMobileMenu = () => {
        if (!mainNav || !mainNav.classList.contains("show") || typeof bootstrap === "undefined") {
            return;
        }

        const collapse = bootstrap.Collapse.getOrCreateInstance(mainNav, { toggle: false });
        collapse.hide();
    };

    const scrollToHashTarget = (hash, behavior = "smooth") => {
        if (!hash || hash === "#") {
            return false;
        }

        const target = document.querySelector(anchorHeadingTargets[hash] || hash);
        if (!target) {
            return false;
        }

        const headerOffset = getHeaderOffset();
        const targetTop = target.getBoundingClientRect().top + window.scrollY - headerOffset;
        window.scrollTo({ top: Math.max(targetTop, 0), left: 0, behavior });
        closeMobileMenu();
        history.pushState(null, "", hash);
        return true;
    };

    document.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener("click", (event) => {
            const hash = link.getAttribute("href");
            if (scrollToHashTarget(hash)) {
                event.preventDefault();
            }
        });
    });

    setActiveLink();
    syncHeaderState();
    syncCarouselMedia();
    window.addEventListener("scroll", () => {
        setActiveLink();
        syncHeaderState();
    });

    if (carouselElement) {
        carouselElement.addEventListener("slid.bs.carousel", syncCarouselMedia);
    }

    if (window.location.hash) {
        const syncInitialHashPosition = () => scrollToHashTarget(window.location.hash, "auto");

        requestAnimationFrame(() => {
            requestAnimationFrame(syncInitialHashPosition);
        });
        window.addEventListener("load", () => setTimeout(syncInitialHashPosition, 120), { once: true });
        setTimeout(syncInitialHashPosition, 520);
        setTimeout(syncInitialHashPosition, 920);
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll("header[id], section[id]");
    const navLinks = document.querySelectorAll(".nav-link");
    const siteHeader = document.querySelector(".site-header");
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

    const scrollToHashTarget = (hash) => {
        if (!hash || hash === "#") {
            return false;
        }

        const target = document.querySelector(hash);
        if (!target) {
            return false;
        }

        const headerOffset = siteHeader ? siteHeader.offsetHeight + 18 : 112;
        const targetTop = target.getBoundingClientRect().top + window.scrollY - headerOffset;
        window.scrollTo({ top: Math.max(targetTop, 0), behavior: "smooth" });
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
        setTimeout(() => scrollToHashTarget(window.location.hash), 80);
    }
});

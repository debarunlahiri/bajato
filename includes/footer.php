<?php
$footerBrandHref = $footerBrandHref ?? 'index.php';
$footerLinks = $footerLinks ?? [
    ['label' => 'Home', 'href' => 'index.php', 'icon' => 'bi-house'],
    ['label' => 'About', 'href' => 'index.php#about', 'icon' => 'bi-info-circle'],
    ['label' => 'Products', 'href' => 'products.php', 'icon' => 'bi-box-seam'],
    ['label' => 'Manufacturing', 'href' => 'index.php#process', 'icon' => 'bi-buildings'],
    ['label' => 'Contact', 'href' => 'index.php#contact', 'icon' => 'bi-person-lines-fill'],
];
$footerContactLinks = $footerContactLinks ?? [
    ['label' => 'sales@bajato.com', 'href' => 'mailto:sales@bajato.com', 'icon' => 'bi-envelope'],
    ['label' => '+91-9821591599', 'href' => 'https://wa.me/919821591599?text=Hello%20Bajato%2C%20I%20would%20like%20to%20connect%20with%20your%20team.', 'icon' => 'bi-whatsapp'],
    ['label' => 'Plot No 116, Sector-3, HSIIDC, IMT Manesar, Gurugram-122051', 'href' => 'https://www.google.com/maps/search/?api=1&query=Plot%20No%20116%2C%20Sector-3%2C%20HSIIDC%2C%20IMT%20Manesar%2C%20Gurugram%20122051', 'icon' => 'bi-geo-alt'],
];
$footerIconMap = [
    'Home' => 'bi-house',
    'About' => 'bi-info-circle',
    'Products' => 'bi-box-seam',
    'Manufacturing' => 'bi-buildings',
    'Contact' => 'bi-person-lines-fill',
    'sales@bajato.com' => 'bi-envelope',
    '+91-9821591599' => 'bi-whatsapp',
    'Plot No 116, Sector-3, HSIIDC, IMT Manesar, Gurugram-122051' => 'bi-geo-alt',
];
?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-shell">
            <div class="footer-brand">
                <a class="footer-brand-link" href="<?php echo htmlspecialchars($footerBrandHref); ?>">
                    <img src="<?php echo htmlspecialchars($site['logo']); ?>" alt="<?php echo htmlspecialchars($site['brand']); ?> logo" class="footer-logo">
                    <span class="footer-brand-copy">
                        <span class="footer-brand-text"><?php echo htmlspecialchars($site['brand']); ?></span>
                        <span class="footer-brand-subtext"><?php echo htmlspecialchars($site['tagline']); ?></span>
                    </span>
                </a>
                <p><?php echo htmlspecialchars($site['footer']['summary']); ?></p>
            </div>

            <div class="footer-links">
                <div class="footer-column">
                    <span class="footer-heading">Quick Links</span>
                    <?php foreach ($footerLinks as $link): ?>
                        <?php $icon = $link['icon'] ?? $footerIconMap[$link['label']] ?? ''; ?>
                        <a href="<?php echo htmlspecialchars($link['href']); ?>"<?php echo !empty($link['target']) ? ' target="' . htmlspecialchars($link['target']) . '"' : ''; ?><?php echo !empty($link['rel']) ? ' rel="' . htmlspecialchars($link['rel']) . '"' : ''; ?>>
                            <?php if ($icon !== ''): ?>
                                <i class="bi <?php echo htmlspecialchars($icon); ?>" aria-hidden="true"></i>
                            <?php endif; ?>
                            <span><?php echo htmlspecialchars($link['label']); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
                <div class="footer-column">
                    <span class="footer-heading">Contact</span>
                    <?php foreach ($footerContactLinks as $link): ?>
                        <?php $icon = $link['icon'] ?? $footerIconMap[$link['label']] ?? ''; ?>
                        <a href="<?php echo htmlspecialchars($link['href']); ?>"<?php echo !empty($link['target']) ? ' target="' . htmlspecialchars($link['target']) . '"' : ''; ?><?php echo !empty($link['rel']) ? ' rel="' . htmlspecialchars($link['rel']) . '"' : ''; ?>>
                            <?php if ($icon !== ''): ?>
                                <i class="bi <?php echo htmlspecialchars($icon); ?>" aria-hidden="true"></i>
                            <?php endif; ?>
                            <span><?php echo htmlspecialchars($link['label']); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="footer-bottom">
                <span><?php echo htmlspecialchars($site['footer']['copyright']); ?></span>
                <span>Built for OEM, aftermarket, and export buyers.</span>
            </div>
        </div>
    </div>
</footer>

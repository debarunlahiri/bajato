<?php
$brandHref = $brandHref ?? 'index.php';
$contactHref = $contactHref ?? 'index.php#contact';
$activeNavLabel = $activeNavLabel ?? '';
?>
<header class="site-header" id="top">
    <?php if (!empty($showHeaderBanner) && !empty($site['header_banner'])): ?>
        <div class="header-banner">
            <img src="<?php echo htmlspecialchars($site['header_banner']); ?>" alt="Bajato automotive banner" class="header-banner-image">
        </div>
    <?php endif; ?>
    <nav class="navbar navbar-expand-lg">
        <div class="container navbar-layout">
            <a class="navbar-brand" href="<?php echo htmlspecialchars($brandHref); ?>">
                <img src="<?php echo htmlspecialchars($site['logo']); ?>" alt="<?php echo htmlspecialchars($site['brand']); ?> logo" class="brand-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav navbar-menu align-items-lg-center">
                    <?php foreach ($navItems as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $activeNavLabel === $item['label'] ? 'active' : ''; ?>" href="<?php echo htmlspecialchars($item['href']); ?>"><?php echo htmlspecialchars($item['label']); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="navbar-cta">
                    <a class="btn btn-sm btn-brand-primary" href="<?php echo htmlspecialchars($contactHref); ?>">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>
</header>

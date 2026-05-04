<?php
$catalog = require __DIR__ . '/products-data.php';

$site = [
    'brand' => 'Bajato',
    'tagline' => 'Automotive lights & parts',
    'logo' => 'assets/images/logo.jpeg',
    'meta_title' => 'Products | Bajato',
    'footer' => [
        'summary' => 'Automotive lighting and parts for buses, coaches, trailers, ambulances, and special vehicle programs.',
        'copyright' => '© ' . date('Y') . ' Bajato. All rights reserved.',
    ],
];

$navItems = [
    ['label' => 'Home', 'href' => 'index.php#top'],
    ['label' => 'About', 'href' => 'index.php#about'],
    ['label' => 'Products', 'href' => 'products.php'],
    ['label' => 'Manufacturing', 'href' => 'index.php#manufacturing'],
    ['label' => 'Compliance', 'href' => 'index.php#compliance'],
    ['label' => 'Contact', 'href' => 'index.php#contact'],
];

$brandHref = 'index.php';
$contactHref = 'index.php#contact';
$activeNavLabel = 'Products';

$filterCategories = [
    ['label' => 'All Products', 'slug' => 'all'],
    ['label' => 'Tail Lamp', 'slug' => 'tail-lamp'],
    ['label' => 'Side Lamp', 'slug' => 'side-lamp'],
    ['label' => 'Markers', 'slug' => 'markers'],
    ['label' => 'Licence Plate Lamps', 'slug' => 'licence-plate-lamps'],
    ['label' => 'Multiple Use Lamp', 'slug' => 'multiple-use-lamp'],
    ['label' => 'Reflex Reflectors', 'slug' => 'reflex-reflectors'],
    ['label' => 'Interior Lamps', 'slug' => 'interior-lamps'],
    ['label' => 'Revolving Lights', 'slug' => 'revolving-lights'],
    ['label' => 'Clocks', 'slug' => 'clocks'],
    ['label' => 'LED Lamps', 'slug' => 'led-lamps'],
    ['label' => 'Head Lamp', 'slug' => 'head-lamp'],
];

$cards = [];
foreach ($catalog as $group) {
    foreach ($group['items'] as $item) {
        $slugs = [$group['slug']];
        if ($group['slug'] === 'side-lamp') {
            $slugs[] = 'tail-lamp';
        }
        $cards[] = [
            'group' => $group['category'],
            'slugs' => $slugs,
            'title' => $item['title'],
            'code' => $item['code'],
            'image' => $item['image'],
            'details' => $item['details'],
            'source' => $group['source'],
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($site['meta_title']); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="page-shell">
        <?php include __DIR__ . '/includes/header.php'; ?>

        <main class="products-page">
            <section class="products-hero">
                <div class="container">
                    <span class="section-kicker">Product Catalogue</span>
                    <h1 class="section-title">Find Products</h1>
                    <p class="section-copy section-copy-narrow">Browse Bajato’s lighting range category-wise and search product codes or names sourced from the reference catalog.</p>
                </div>
            </section>

            <section class="products-layout-section">
                <div class="container">
                    <div class="products-layout">
                        <aside class="products-sidebar">
                            <div class="products-sidebar-card">
                                <h2>Find Products</h2>
                                <ul class="products-category-list">
                                    <?php foreach ($filterCategories as $index => $category): ?>
                                        <li>
                                            <button class="products-category-button <?php echo $index === 0 ? 'is-active' : ''; ?>" data-filter="<?php echo htmlspecialchars($category['slug']); ?>">
                                                <?php echo htmlspecialchars($category['label']); ?>
                                            </button>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </aside>

                        <section class="products-main">
                            <div class="products-toolbar">
                                <div class="products-toolbar-copy">
                                    <h2>All Products</h2>
                                    <p>Search by name, code, or browse by category.</p>
                                </div>
                                <label class="products-search">
                                    <i class="bi bi-search"></i>
                                    <input id="productSearch" type="search" placeholder="Search products">
                                </label>
                            </div>

                            <div id="productsEmptyState" class="products-empty-state" hidden>
                                No products match this category or search.
                            </div>

                            <div id="productsGrid" class="row g-4">
                                <?php foreach ($cards as $card): ?>
                                    <?php
                                    $detailText = implode(' ', $card['details']);
                                    $filterValue = implode(' ', $card['slugs']);
                                    $searchValue = strtolower(trim($card['group'] . ' ' . $card['title'] . ' ' . $card['code'] . ' ' . $detailText));
                                    ?>
                                    <div class="col-md-6 col-xl-4 product-record" data-filter="<?php echo htmlspecialchars($filterValue); ?>" data-search="<?php echo htmlspecialchars($searchValue); ?>">
                                        <article class="catalog-card h-100">
                                            <div class="catalog-media">
                                                <img src="<?php echo htmlspecialchars($card['image']); ?>" alt="<?php echo htmlspecialchars($card['code']); ?>" loading="lazy">
                                            </div>
                                            <div class="catalog-body">
                                                <span class="catalog-category"><?php echo htmlspecialchars($card['group']); ?></span>
                                                <h3><?php echo htmlspecialchars($card['code']); ?></h3>
                                                <p class="catalog-title"><?php echo htmlspecialchars($card['title']); ?></p>
                                                <ul class="catalog-details">
                                                    <?php foreach ($card['details'] as $detail): ?>
                                                        <li><?php echo htmlspecialchars($detail); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </main>

        <?php include __DIR__ . '/includes/footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const filterButtons = document.querySelectorAll(".products-category-button");
            const searchInput = document.querySelector("#productSearch");
            const records = document.querySelectorAll(".product-record");
            const emptyState = document.querySelector("#productsEmptyState");
            let activeFilter = "all";

            const applyFilters = () => {
                const query = (searchInput?.value || "").trim().toLowerCase();
                let visibleCount = 0;

                records.forEach((record) => {
                    const filters = (record.dataset.filter || "").split(" ");
                    const searchText = record.dataset.search || "";
                    const matchesFilter = activeFilter === "all" || filters.includes(activeFilter);
                    const matchesSearch = !query || searchText.includes(query);
                    const visible = matchesFilter && matchesSearch;
                    record.hidden = !visible;
                    if (visible) visibleCount += 1;
                });

                if (emptyState) {
                    emptyState.hidden = visibleCount !== 0;
                }
            };

            filterButtons.forEach((button) => {
                button.addEventListener("click", () => {
                    activeFilter = button.dataset.filter || "tail-lamp";
                    filterButtons.forEach((item) => item.classList.remove("is-active"));
                    button.classList.add("is-active");
                    applyFilters();
                });
            });

            searchInput?.addEventListener("input", applyFilters);
            applyFilters();
        });
    </script>
</body>
</html>

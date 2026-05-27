#!/usr/bin/env bash
set -euo pipefail

DIST="/home/ferl/sbf/dist"

echo "=== 1. Removing breadcrumb blocks from all pages ==="

for file in $(find "$DIST" -name "index.html" -not -path "*/wp-content/*"); do
    # Remove the breadcrumb block (multi-line: from opening div to closing div)
    if grep -q 'reactheme-breadcrumbs' "$file"; then
        sed -i '/<div class="reactheme-breadcrumbs">/,/<\/div>/{
            /<div class="reactheme-breadcrumbs">/d
            /<div class="container">/d
            /<h1 class="page-title">/d
            /^[[:space:]]*<\/h1>/d
            /^[[:space:]]*<\/div>/d
        }' "$file"
        echo "  Breadcrumb removed: $file"
    fi
done

# More aggressive cleanup - remove any remaining breadcrumb lines
for file in $(find "$DIST" -name "index.html" -not -path "*/wp-content/*"); do
    sed -i '/class="reactheme-breadcrumbs"/d' "$file"
    sed -i '/class="page-title"/d' "$file"
done

echo ""
echo "=== 2. Adding Contact link to navigation menus ==="

# Add Contact link before Request a Quote in both menus (mobile + desktop)
for file in $(find "$DIST" -name "index.html" -not -path "*/wp-content/*"); do
    # Skip if Contact already exists in this file's nav
    if grep -q 'sbf/contact/' "$file"; then
        echo "  Contact already exists: $file"
        continue
    fi

    # Add Contact link before the Request a Quote menu item (menu-item-6593)
    # In both menus (offcanvas and desktop)
    sed -i 's|<li id="menu-item-6593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6593"><a href="https://ferlerrorr.github.io/sbf/quote/">Request a Quote</a></li>|<li id="menu-item-6594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6594"><a href="https://ferlerrorr.github.io/sbf/contact/">Contact</a></li>\n<li id="menu-item-6593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6593"><a href="https://ferlerrorr.github.io/sbf/quote/">Request a Quote</a></li>|g' "$file"

    # Also handle the desktop menu (no id= attribute)
    sed -i 's|<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6593"><a href="https://ferlerrorr.github.io/sbf/quote/">Request a Quote</a></li>|<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6594"><a href="https://ferlerrorr.github.io/sbf/contact/">Contact</a></li>\n<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6593"><a href="https://ferlerrorr.github.io/sbf/quote/">Request a Quote</a></li>|g' "$file"

    echo "  Contact added: $file"
done

# Also fix the 404.html at root
if [ -f "$DIST/404.html" ]; then
    sed -i '/class="reactheme-breadcrumbs"/d' "$DIST/404.html"
    sed -i '/class="page-title"/d' "$DIST/404.html"

    if ! grep -q 'sbf/contact/' "$DIST/404.html"; then
        sed -i 's|<li id="menu-item-6593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6593"><a href="https://ferlerrorr.github.io/sbf/quote/">Request a Quote</a></li>|<li id="menu-item-6594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6594"><a href="https://ferlerrorr.github.io/sbf/contact/">Contact</a></li>\n<li id="menu-item-6593" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6593"><a href="https://ferlerrorr.github.io/sbf/quote/">Request a Quote</a></li>|g' "$DIST/404.html"
        sed -i 's|<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6593"><a href="https://ferlerrorr.github.io/sbf/quote/">Request a Quote</a></li>|<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6594"><a href="https://ferlerrorr.github.io/sbf/contact/">Contact</a></li>\n<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6593"><a href="https://ferlerrorr.github.io/sbf/quote/">Request a Quote</a></li>|g' "$DIST/404.html"
        echo "  Contact added: $DIST/404.html"
    fi
fi

echo ""
echo "=== 3. Verification ==="
echo "Breadcrumb count: $(grep -rl 'reactheme-breadcrumbs' "$DIST" --include='*.html' | grep -v wp-content | wc -l) files (should be 0)"
echo "Contact nav count: $(grep -rl 'sbf/contact/' "$DIST" --include='*.html' | grep -v wp-content | wc -l) files"
echo "=== Done ==="

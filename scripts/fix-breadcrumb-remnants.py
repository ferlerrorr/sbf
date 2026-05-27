#!/usr/bin/env python3
"""Remove breadcrumb remnants from all HTML files in dist/."""
import re, glob, os

dist = "/home/ferl/sbf/dist"

# Pattern matches the entire breadcrumb block including partial remnants
# From <div class="reactheme-breadcrumbs"> through its closing structure
breadcrumb_pattern = re.compile(
    r'<div class="reactheme-breadcrumbs">.*?</div>\s*</div>\s*',
    re.DOTALL
)

# Also match orphaned remnants: bare h1 page-title text + closing tags
# left by incomplete sed removal
orphan_pattern = re.compile(
    r'\s*(?:<div class="container">\s*)?'
    r'(?:<h1 class="page-title">\s*)?'
    r'[A-Za-z0-9 /&;]+\s*</h1>\s*'
    r'(?:</div>\s*)*'
    r'(?:</div>\s*)?',
)

files = glob.glob(os.path.join(dist, "**", "index.html"), recursive=True)
files += glob.glob(os.path.join(dist, "404.html"))

for fpath in files:
    if "wp-content" in fpath:
        continue

    with open(fpath, "r") as f:
        content = f.read()

    original = content

    # Remove full breadcrumb block if still present
    content = breadcrumb_pattern.sub("", content)

    # Remove orphaned breadcrumb title lines between </header> and <div data-elementor-type
    # This targets the specific remnant pattern
    content = re.sub(
        r'(</header>\s*)\n\s*[^<\n]*</h1>\s*\n\s*</div>\s*\n',
        r'\1\n',
        content
    )

    if content != original:
        with open(fpath, "w") as f:
            f.write(content)
        print(f"  Fixed: {fpath}")
    else:
        print(f"  OK: {fpath}")

print("\nDone.")

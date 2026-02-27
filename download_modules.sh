#!/bin/bash
# ============================================
# Drupal 7 Job Portal - Module Downloader
# ============================================
# Run from: /Applications/MAMP/htdocs/job-portal
# Usage: bash download_modules.sh
# ============================================

MODULE_DIR="sites/all/modules"
mkdir -p "$MODULE_DIR"
cd "$MODULE_DIR" || exit 1

DOWNLOAD_URL="https://ftp.drupal.org/files/projects"

# Track results
SUCCESS=()
FAILED=()

download_module() {
    local module=$1
    local version=$2
    local filename="${module}-${version}.tar.gz"

    echo ""
    echo "📦 Downloading ${module} (${version})..."

    if curl -sfO "${DOWNLOAD_URL}/${filename}"; then
        tar -xzf "$filename" && rm -f "$filename"
        echo "   ✅ ${module} installed successfully"
        SUCCESS+=("$module")
    else
        echo "   ❌ ${module} FAILED - check version at https://www.drupal.org/project/${module}"
        FAILED+=("$module")
    fi
}

echo "============================================"
echo "  Drupal 7 Job Portal - Module Installer"
echo "  Downloading to: ${MODULE_DIR}/"
echo "============================================"

# ---- Group 1: Core Dependencies ----
echo ""
echo "── Group 1: Core Dependencies ──"
download_module "ctools"              "7.x-1.21"
download_module "entity"              "7.x-1.10"
download_module "token"               "7.x-1.9"
download_module "libraries"           "7.x-2.5"

# ---- Group 2: Field Types ----
echo ""
echo "── Group 2: Field Types ──"
download_module "date"                "7.x-2.14"
download_module "link"                "7.x-1.7"
download_module "email"               "7.x-1.3"
download_module "field_group"         "7.x-1.6"

# ---- Group 3: URL & SEO ----
echo ""
echo "── Group 3: URL & SEO ──"
download_module "pathauto"            "7.x-1.3"

# ---- Group 4: Views Ecosystem ----
echo ""
echo "── Group 4: Views Ecosystem ──"
download_module "views"               "7.x-3.27"
download_module "admin_views"         "7.x-1.7"
download_module "views_bulk_operations" "7.x-3.6"
download_module "views_data_export"   "7.x-3.3"

# ---- Group 5: User & Profile ----
echo ""
echo "── Group 5: User & Profile ──"
download_module "profile2"            "7.x-1.7"
download_module "login_destination"   "7.x-1.4"

# ---- Group 6: Workflow & Moderation ----
echo ""
echo "── Group 6: Workflow & Moderation ──"
download_module "workbench"           "7.x-1.2"
download_module "workbench_moderation" "7.x-3.0"

# ---- Group 7: Forms & Communication ----
echo ""
echo "── Group 7: Forms & Communication ──"
download_module "webform"             "7.x-4.25"
download_module "rules"               "7.x-2.14"
download_module "captcha"             "7.x-1.8"
download_module "recaptcha"           "7.x-2.3"

# ---- Group 8: UI & Editor ----
echo ""
echo "── Group 8: UI & Editor ──"
download_module "wysiwyg"             "7.x-2.9"
download_module "flag"                "7.x-3.9"
download_module "charts"              "7.x-2.1"
download_module "panels"              "7.x-3.10"

# ---- Group 9: Admin & Utility ----
echo ""
echo "── Group 9: Admin & Utility ──"
download_module "module_filter"       "7.x-2.2"
download_module "devel"               "7.x-1.7"
download_module "jquery_update"       "7.x-3.0-alpha5"

# ---- Group 10: Webform + Views Integration ----
echo ""
echo "── Group 10: Integration ──"
download_module "webform_views"       "7.x-1.0-beta3"

# ============================================
# Summary
# ============================================
echo ""
echo "============================================"
echo "  DOWNLOAD SUMMARY"
echo "============================================"
echo ""
echo "✅ Successfully installed (${#SUCCESS[@]}):"
for mod in "${SUCCESS[@]}"; do
    echo "   • $mod"
done

if [ ${#FAILED[@]} -gt 0 ]; then
    echo ""
    echo "❌ Failed (${#FAILED[@]}) - download manually from drupal.org:"
    for mod in "${FAILED[@]}"; do
        echo "   • $mod → https://www.drupal.org/project/$mod"
    done
fi

echo ""
echo "============================================"
echo "  NEXT STEPS"
echo "============================================"
echo "1. Open: http://localhost:8888/job-portal/admin/modules"
echo "2. Check the boxes for each module"
echo "3. Click 'Save configuration'"
echo "4. Clear cache: Admin → Configuration → Performance"
echo "============================================"

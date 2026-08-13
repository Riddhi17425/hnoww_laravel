<?php

namespace App\Http\Controllers;

use App\Models\Blessing;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;

class SitemapController extends Controller
{
    // RETURN XML RESPONSE
    protected function xmlResponse(string $xml)
    {
        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    // COMPLETE SITEMAP
    public function index()
    {
        // STATIC TIME FOR HOMEPAGE AND STATIC PAGES
        // Update this value whenever you want to record
        // a new update time for static pages.
        $todayTime = "2026-08-12T15:30:00+05:30";

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";


        // ============================================================
        // 1. HOMEPAGE
        // PRIORITY: 1.00
        // ============================================================

        $xml .= '<url>';

        $xml .= '<loc>'
            . htmlspecialchars(
                route('front.home'),
                ENT_XML1,
                'UTF-8'
            )
            . '</loc>';

        $xml .= '<lastmod>'
            . htmlspecialchars($todayTime, ENT_XML1, 'UTF-8')
            . '</lastmod>';

        $xml .= '<priority>1.00</priority>';

        $xml .= '</url>' . "\n";


        // ============================================================
        // 2. ALL CATEGORIES + SUB-CATEGORIES
        // PRIORITY: 0.80
        //
        // category_type:
        // 1 = Base Categories
        // 2 = Corporate Categories
        // 3 = Wedding Categories
        // ============================================================

        $categories = Category::where('is_active', 0)
            ->whereNull('deleted_at')
            ->whereIn('category_type', [1, 2, 3])
            ->get();

        foreach ($categories as $category)
        {
            if (empty($category->id))
            {
                continue;
            }

            /*
             * BASE CATEGORY
             *
             * /collections/luxury-gifts-for-her
             * /collections/luxury-gifts-for-him
             * /collections/luxury-home-decor
             */
            if ($category->category_type == 1)
            {
                if (empty($category->category_url))
                {
                    continue;
                }

                $loc = route('front.list', [
                    'category_slug' => $category->category_url
                ]);
            }

            /*
             * CORPORATE CATEGORY
             *
             * /corporate-gifts-dubai/{cat_slug}
             */
            elseif ($category->category_type == 2)
            {
                if (empty($category->category_url))
                {
                    continue;
                }

                $loc = route('front.corporate.vault', [
                    'cat_slug' => $category->category_url
                ]);
            }

            /*
             * WEDDING CATEGORY
             *
             * /wedding-products/{category_id}
             */
            elseif ($category->category_type == 3)
            {
                $loc = route('front.ceremonials', [
                    'category_id' => $category->id
                ]);
            }

            else
            {
                continue;
            }

            $lastmod = optional($category->updated_at)->toAtomString();

            $xml .= '<url>';

            $xml .= '<loc>'
                . htmlspecialchars($loc, ENT_XML1, 'UTF-8')
                . '</loc>';

            if ($lastmod)
            {
                $xml .= '<lastmod>'
                    . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8')
                    . '</lastmod>';
            }

            $xml .= '<priority>0.80</priority>';

            $xml .= '</url>' . "\n";
        }


        // ============================================================
        // 3. ALL PRODUCTS
        // PRIORITY: 0.80
        //
        // Includes:
        // - Normal Products
        // - Gift Shop Products
        // ============================================================

        // ------------------------------------------------------------
        // NORMAL PRODUCTS
        // ------------------------------------------------------------

        // Product URLs that should NOT appear in sitemap
        $excludedProductUrls = [
            'the-fluted-pedestal',
            'pedestal-platters',
            'elephant-pedestal-cake-stand',
            'malachite-monolith-frame',
            'keepsake-boxes',
            'card-holders',
            'pen-holders-organisers',
            'paperweights',
            'silver-grid-frames',
            'malachite-stone-frames',
            'malachite-stem-sculpture',
            'silver-leaf-bowl',
            'lotus-bowl',
            'the-offering-stand',
            'the-peacock-vessel',
            'the-malachite-offering-platter',
            'kamadhenu-ceremonial-idol',
        ];

        $products = Product::where('is_active', 0)
            ->whereNull('deleted_at')
            ->whereNotIn('product_url', $excludedProductUrls)
            ->get();

        foreach ($products as $product)
        {
            if (empty($product->product_url))
            {
                continue;
            }

            $loc = route('front.product.details', [
                'product_slug' => $product->product_url
            ]);

            $lastmod = optional($product->updated_at)->toAtomString();

            $xml .= '<url>';

            $xml .= '<loc>'
                . htmlspecialchars($loc, ENT_XML1, 'UTF-8')
                . '</loc>';

            if ($lastmod)
            {
                $xml .= '<lastmod>'
                    . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8')
                    . '</lastmod>';
            }

            $xml .= '<priority>0.80</priority>';

            $xml .= '</url>' . "\n";
        }

        // ============================================================
        // 4. ALL PAGES
        // PRIORITY: 0.60
        //
        // Includes:
        // - Corporate main page
        // - Bespoke main page
        // - Wedding main page
        // - Normal static pages
        // - Blessings library
        // - Individual blessings
        // ============================================================

        $staticRoutes = [
            // Main / landing pages
            'front.corporate.vault',
            'front.bespoke.commission',
            'front.wedding.vault.inside',

            // Static pages
            'front.about',
            'front.faqs',
            'front.journal',
            'front.atelier',
            'front.author',
            'front.editions',
            'front.contactus',
            'front.blogs',
        ];

        foreach ($staticRoutes as $name)
        {
            $loc = route($name);

            $xml .= '<url>';

            $xml .= '<loc>'
                . htmlspecialchars($loc, ENT_XML1, 'UTF-8')
                . '</loc>';

            $xml .= '<lastmod>'
                . htmlspecialchars($todayTime, ENT_XML1, 'UTF-8')
                . '</lastmod>';

            $xml .= '<priority>0.60</priority>';

            $xml .= '</url>' . "\n";
        }


        // ------------------------------------------------------------
        // BLESSINGS LIBRARY PAGE
        // ------------------------------------------------------------

        $xml .= '<url>';

        $xml .= '<loc>'
            . htmlspecialchars(
                route('front.blessings.library'),
                ENT_XML1,
                'UTF-8'
            )
            . '</loc>';

        $xml .= '<lastmod>'
            . htmlspecialchars($todayTime, ENT_XML1, 'UTF-8')
            . '</lastmod>';

        $xml .= '<priority>0.60</priority>';

        $xml .= '</url>' . "\n";


        // ------------------------------------------------------------
        // INDIVIDUAL BLESSINGS
        // ------------------------------------------------------------

        $blessings = Blessing::where('is_active', 0)
            ->whereNull('deleted_at')
            ->get();

        foreach ($blessings as $blessing)
        {
            if (empty($blessing->slug))
            {
                continue;
            }

            $loc = route('front.blessings.library', [
                'slug' => $blessing->slug
            ]);

            $lastmod = optional($blessing->updated_at)->toAtomString();

            $xml .= '<url>';

            $xml .= '<loc>'
                . htmlspecialchars($loc, ENT_XML1, 'UTF-8')
                . '</loc>';

            if ($lastmod)
            {
                $xml .= '<lastmod>'
                    . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8')
                    . '</lastmod>';
            }

            $xml .= '<priority>0.60</priority>';

            $xml .= '</url>' . "\n";
        }


        // ============================================================
        // 5. ALL BLOGS
        // PRIORITY: 0.60
        // ============================================================

        $blogs = Blog::where('status', 'Active')
            ->get();

        foreach ($blogs as $blog)
        {
            if (empty($blog->url))
            {
                continue;
            }

            $loc = route('front.blog.detail', [
                'url' => $blog->url
            ]);

            $lastmod = optional($blog->updated_at)->toAtomString();

            $xml .= '<url>';

            $xml .= '<loc>'
                . htmlspecialchars($loc, ENT_XML1, 'UTF-8')
                . '</loc>';

            if ($lastmod)
            {
                $xml .= '<lastmod>'
                    . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8')
                    . '</lastmod>';
            }

            $xml .= '<priority>0.60</priority>';

            $xml .= '</url>' . "\n";
        }


        // ============================================================
        // END SITEMAP
        // ============================================================

        $xml .= '</urlset>';

        return $this->xmlResponse($xml);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Blessing;
use App\Models\Blog;
use App\Models\Category;
use App\Models\GiftShop;
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
        // START - HOMEPAGE
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
        // END - HOMEPAGE
        // ============================================================


        // ============================================================
        // START - CATEGORIES
        // ============================================================

        $categories = Category::where('is_active', 0)
            ->whereIn('category_url', [
                'luxury-gifts-for-her',
                'luxury-gifts-for-him',
                'luxury-home-decor'
            ])
            ->get();

        foreach ($categories as $category)
        {
            if (empty($category->category_url))
            {
                continue;
            }

            $loc = route('front.list', [
                'category_slug' => $category->category_url
            ]);

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
        // END - CATEGORIES
        // ============================================================


        // ============================================================
        // START - PRODUCTS
        // ============================================================

        $products = Product::where('is_active', 0)
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

            $xml .= '<priority>0.60</priority>';

            $xml .= '</url>' . "\n";
        }

        // ============================================================
        // END - PRODUCTS
        // ============================================================


        // ============================================================
        // START - GIFT SHOP PRODUCTS
        // ============================================================

        $gifts = GiftShop::where('is_active', 0)
            ->get();

        foreach ($gifts as $gift)
        {
            if (empty($gift->product_url))
            {
                continue;
            }

            $loc = route('front.gift.details', [
                'product_slug' => $gift->product_url
            ]);

            $lastmod = optional($gift->updated_at)->toAtomString();

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
        // END - GIFT SHOP PRODUCTS
        // ============================================================


        // ============================================================
        // START - BLOG POSTS
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
        // END - BLOG POSTS
        // ============================================================


        // ============================================================
        // START - BLESSINGS
        // ============================================================

        $blessings = Blessing::where('is_active', 0)
            ->whereNull('deleted_at')
            ->get();

        // Blessings Library Main Page

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


        // Individual Blessings

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
        // END - BLESSINGS
        // ============================================================


        // ============================================================
        // START - STATIC PAGES
        // ============================================================

        $staticRoutes = [
            'front.about',
            'front.faqs',
            'front.journal',
            'front.atelier',
            'front.bespoke.commission',
            'front.privacy',
            'front.rituals',
            'front.bespoke.wedding.hampers',
            'front.everyday-sacred',
            'front.memory-shelf',
            'front.modern-majilis',
            'front.architect-study',
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

        // ============================================================
        // END - STATIC PAGES
        // ============================================================


        $xml .= '</urlset>';

        return $this->xmlResponse($xml);
    }
}
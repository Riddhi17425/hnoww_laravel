<?php
namespace App\Http\Controllers;

use App\Models\Blessing;
use App\Models\Blog;
use App\Models\Category;
use App\Models\GiftShop;
use App\Models\Product;

class SitemapController extends Controller
{
    protected function xmlResponse(string $xml)
    {
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function index()
    {
        $sitemaps = [
            route('sitemap.posts'),
            route('sitemap.pages'),
            route('sitemap.products'),
            route('sitemap.categories'),
            route('sitemap.blessings'),
        ];

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($sitemaps as $loc) {
            $xml .= "<sitemap><loc>{$loc}</loc><lastmod>" . now()->toAtomString() . "</lastmod></sitemap>\n";
        }
        $xml .= '</sitemapindex>';

        return $this->xmlResponse($xml);
    }

    public function posts()
    {
        $blogs = Blog::where('status', 'Active')->get();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($blogs as $blog) {
            $loc      = route('front.blog.detail', $blog->url);
            $lastmod  = optional($blog->updated_at)->toAtomString();
            $xml     .= "<url><loc>{$loc}</loc><lastmod>{$lastmod}</lastmod></url>\n";
        }
        $xml .= '</urlset>';

        return $this->xmlResponse($xml);
    }

    public function products()
    {
        $products = Product::where('is_active', 0)->get();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($products as $product) {
            $loc      = route('front.product.details', $product->product_url);
            $lastmod  = optional($product->updated_at)->toAtomString();
            $xml     .= "<url><loc>{$loc}</loc><lastmod>{$lastmod}</lastmod></url>\n";
        }
        $xml .= '</urlset>';

        return $this->xmlResponse($xml);
    }

    public function categories()
    {
        $categories = Category::where('is_active', 0)
            ->whereIn('category_url', ['luxury-gifts-for-her', 'luxury-gifts-for-him', 'luxury-home-decor'])
            ->get();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($categories as $category) {
            $loc      = route('front.list', $category->category_url);
            $lastmod  = optional($category->updated_at)->toAtomString();
            $xml     .= "<url><loc>{$loc}</loc><lastmod>{$lastmod}</lastmod></url>\n";
        }
        $xml .= '</urlset>';

        return $this->xmlResponse($xml);
    }

    public function gifts()
    {
        $gifts = GiftShop::where('is_active', 0)->get();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($gifts as $gift) {
            $loc      = route('front.gift.details', $gift->product_url);
            $lastmod  = optional($gift->updated_at)->toAtomString();
            $xml     .= "<url><loc>{$loc}</loc><lastmod>{$lastmod}</lastmod></url>\n";
        }
        $xml .= '</urlset>';

        return $this->xmlResponse($xml);
    }

    public function blessings()
    {
        $blessings = Blessing::where('is_active', 0)->whereNull('deleted_at')->get();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        $xml .= "<url><loc>" . route('front.blessings.library') . "</loc></url>\n";

        foreach ($blessings as $blessing) {
            if (empty($blessing->slug)) {
                continue; // skip any legacy rows without a slug
            }
            $loc      = route('front.blessings.library', ['slug' => $blessing->slug]);
            $lastmod  = optional($blessing->updated_at)->toAtomString();
            $xml     .= "<url><loc>{$loc}</loc><lastmod>{$lastmod}</lastmod></url>\n";
        }
        $xml .= '</urlset>';

        return $this->xmlResponse($xml);
    }

    public function pages()
    {
        $staticRoutes = [
            'front.home', 'front.about', 'front.faqs', 'front.journal',
            'front.atelier', 'front.bespoke.commission',
            'front.privacy', 'front.rituals', 'front.bespoke.wedding.hampers',
            'front.everyday-sacred', 'front.memory-shelf', 'front.modern-majilis',
            'front.architect-study', 'front.author', 'front.editions',
            'front.contactus', 'front.blogs',
        ];

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($staticRoutes as $name) {
            $loc  = route($name);
            $xml .= "<url><loc>{$loc}</loc></url>\n";
        }
        $xml .= '</urlset>';

        return $this->xmlResponse($xml);
    }
}

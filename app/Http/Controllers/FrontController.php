<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Models\{User, Category, Product, ProductInquiry, NewsLetter, FaqType, ContactInquiry, RequestCatalogue, CorporateProposalRequest, Journal, Blessing, WeddingCatalogueRequest, GiftBlessing, Ceremonial, CeremonialInquiry, GiftShop, CorporateKit, CorporateKitRequest, BespokeCommissionEnquiry};
use Exception;
use Illuminate\Validation\Rule;

use App\Services\PaymentService;
use Stripe;
use Illuminate\Support\Facades\Log;

class FrontController extends Controller
{
    protected $adminEmail;
    protected $adminWhatsappNo;
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->adminEmail = config('global_values.admin_email');
        $this->adminWhatsappNo = config('global_values.admin_whatsapp_no');
        $this->paymentService = $paymentService;
    }

    public function getStripe(Request $request){
        return view('front.stripe');
    }

    public function stripePost(Request $request, PaymentService $paymentService)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $intent = $paymentService->createPaymentIntent($request->amount);
        return response()->json([
            'client_secret' => $intent->client_secret
        ]);

    }

    public function index(Request $request){
        $selectFields = [
            'id', 'category_id', 'product_name', 'short_description', 'is_active', 'deleted_at', 'product_url', 'list_page_img'
        ];

        $herProduct = Product::select($selectFields)->isActive()->notDeleted()
            ->whereHas('category', function($q){
                $q->where('category_url', 'for-her')
                ->where('is_active', 0)
                ->whereNull('deleted_at');
            })->with('category')->orderBy('id', 'DESC')->get();

        $himProduct = Product::select($selectFields)->isActive()->notDeleted()
            ->whereHas('category', function($q){
                $q->where('category_url', 'for-him')
                ->where('is_active', 0)
                ->whereNull('deleted_at');
            })->with('category')->orderBy('id', 'DESC')->get();

        $homeProduct = Product::select($selectFields)->isActive()->notDeleted()
            ->whereHas('category', function($q){
                $q->where('category_url', 'for-home')
                ->where('is_active', 0)
                ->whereNull('deleted_at');
            })->with('category')->orderBy('id', 'DESC')->get();
            

        $corporateProduct = Product::select('id', 'product_name')->where('product_type', 2)->isActive()->notDeleted()->get();
        $weddingProduct = Product::select('id', 'product_name')->where('product_type', 3)->isActive()->notDeleted()->get();
        //$allProd = Product::isActive()->notDeleted()->latest()->take(8)->get();
        $allGifts = GiftShop::where('is_active', 0)->whereNull('deleted_at');
        if (request()->filled('gift_for') && request()->filled('gift_for') != '') {
            $allGifts->where('gift_for', request('gift_for'));
        }
        if (request()->filled('to_celebrate') && request()->filled('to_celebrate') != '') {
            $allGifts->where('to_celebrate', request('to_celebrate'));
        }
        $allGifts = $allGifts->latest()->take(3)->get();
        if (request()->ajax()) {
            return view('front.partials.gift-list', compact('allGifts'))->render();
        }
        
        // Take 2 items from each collection
        $herProductsSubset = $herProduct->take(2);
        $himProductsSubset = $himProduct->take(2);
        $homeProductsSubset = $homeProduct->take(2);
        // Merge them into a single collection
        $combinedProducts = $herProductsSubset
            ->merge($himProductsSubset)
            ->merge($homeProductsSubset);
        // If you want a plain array instead of collection
        $desiredProductsArray = $combinedProducts->values()->all();

        return view('front.home', compact('herProduct', 'himProduct', 'homeProduct', 'corporateProduct', 'weddingProduct', /*'allProd',*/ 'allGifts', 'desiredProductsArray'));
    }

    public function getList(Request $request, $catSlug, $from = null){
        $category = Category::where('category_url', $catSlug)->first();
        $catProducts = Product::select('id', 'category_id', 'product_url', 'product_name', 'short_description', 'list_page_img', 'is_active', 'deleted_at')->where('category_id', $category->id)->where('product_type', 1)->isActive()->notDeleted()->get();

        return view('front.list', compact('category', 'catProducts', 'catSlug', 'from'));
    }

    public function getProductDetails(Request $request, $productSlug){
        $product = Product::select('id', 'category_id', 'product_name', 'product_price', 'short_description', 'list_page_img', 'is_active', 'deleted_at', 'large_description', 'dimensions', 'detail_page_imgs', 'moq', 'short_note', 'product_stock', 'care_maintenance', 'meta_title', 'meta_description')->where('product_url', $productSlug)->isActive()->notDeleted()->first();
        $productDetailImages = $product->detail_page_imgs ? json_decode($product->detail_page_imgs) : '';
        $productTab = $product->tabs ?? [];
        if(!isset($product) && $product == ''){
            return redirect()->back()->with('error', 'Product not Found');
        }

        $similarProduct = Product::select('id', 'category_id', 'product_name', 'product_price', 'short_description', 'list_page_img', 'is_active', 'deleted_at', 'product_url')->where('category_id', $product->category_id)->where('id', '!=', $product->id)->isActive()->notDeleted()->latest('id')->take(3) ->get();

        return view('front.product_details', compact('product', 'productDetailImages', 'productTab', 'similarProduct'));
    }

    public function getGiftDetails(Request $request, $productSlug){
        $product = GiftShop::select('id', 'gift_for', 'to_celebrate', 'product_name', 'product_price', 'short_description', 'list_page_img', 'is_active', 'deleted_at', 'large_description', 'dimensions', 'detail_page_imgs', 'product_url')->where('product_url', $productSlug)->isActive()->notDeleted()->first();
        $productDetailImages = $product->detail_page_imgs ? json_decode($product->detail_page_imgs) : '';
        if(!isset($product) && $product == ''){
            return redirect()->back()->with('error', 'Product not Found');
        }

        $similarProduct = GiftShop::select('id', 'gift_for', 'to_celebrate', 'product_name', 'product_url', 'product_price', 'short_description', 'list_page_img', 'is_active', 'deleted_at', 'large_description', 'dimensions', 'detail_page_imgs')->where('gift_for', $product->gift_for)->where('id', '!=', $product->id)->isActive()->notDeleted()->latest('id')->take(3) ->get();

        return view('front.gift_details', compact('product', 'productDetailImages',  'similarProduct'));
    }

    public function storeProductInquiry(Request $request){
        $isGift = isset($request->inquiry_for) && strtolower($request->inquiry_for) == 'gift';
        
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'product_id' => $isGift ? 'required|exists:gift_shops,id' : 'required|exists:products,id',
            'email'      => ['required', 'email', 'max:255',
                $isGift
                    ? Rule::unique('product_inquiries')->where(function ($query) {
                        $query->where('is_gift_inquiry', 1);
                    })
                    : Rule::unique('product_inquiries')->where(function ($query) {
                        $query->where('is_gift_inquiry', 0);
                    })
            ],
            'contact_no'  => 'nullable|string|max:15|min:8',
            'message'     => 'nullable|string',
        ], [
            'name.required'       => 'Please enter your name.',
            'name.string'         => 'Name must contain only letters.',
            'name.max'            => 'Name may not be greater than 255 characters.',
            'product_id.required' => 'Product information is required.',
            'email.required'      => 'Please enter your email address.',
            'email.email'         => 'Please enter a valid email address.',
            'email.unique'        => 'This email has already been used for an inquiry.',
            'contact_no.max'      => 'Contact number may not exceed 15 digits.',
            'message.string'      => 'Message must be valid text.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $storeData = [
            'name'        => $request->name,
            'product_id'  => $request->product_id,
            'email'       => $request->email,
            'contact_no'  => $request->contact_no,
            'message'     => $request->message ?? NULL,
        ];

        $product = Product::where('id', $request->product_id)->first();
        $adminSubject = 'New Product Inquiry Received';
        $messageTitle = "*New Product Inquiry Received* 🛒";
        if(isset($request->inquiry_for) && strtolower($request->inquiry_for) == 'gift'){
            $storeData['is_gift_inquiry'] = 1;
            $product = GiftShop::where('id', $request->product_id)->first();
            $adminSubject = 'New Gift Product Inquiry Received';
            $messageTitle = "*New Gift Product Inquiry Received* 🛒";
        }    

        ProductInquiry::create($storeData);
        
        // SEND MAIL TO USER AND ADMIN
        $adminEmail = $this->adminEmail;
        $userEmail = $request->email;
        $data = [
            'name'        => $request->name,
            'product_name'  => $product->product_name,
            'email'       => $request->email,
            'contact_no'  => $request->contact_no,
            'message_data'     => $request->message ?? NULL,
        ];

        try {
            Mail::send('email.admin.product_inquiry', $data, function ($message) use ($adminEmail, $adminSubject) {
                $message->to($this->adminEmail)->subject($adminSubject);
            });
       
            Mail::send('email.front.product_inquiry', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Product Inquiry send Successfully');
            });
        } catch (Exception $e) {
            Log::error('Inquiry Mail sending failed: '.$e->getMessage());
        }

        // SEND WHATSAPP MESSAGE TO ADMIN
        $message = $messageTitle . "\n\n" .
            "*Name:* {$request->name}\n" .
            "*Email:* {$request->email}\n" .
            "*Contact No:* {$request->contact_no}\n" .
            "*Product:* {$product->product_name}\n" .
            "*Message:* " . ($request->message ?? 'N/A') . "\n\n" .
            "— HNoWW";

        try {
            $url = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode($message);
            //return redirect()->away($url);
            return back()->with('whatsapp_url', $url);
        } catch (Exception $e) {
            Log::error('Inquiry Whatsapp message sending failed: '.$e->getMessage());
        }
        return back()->with('success', 'Your inquiry has been submitted successfully!');
    }

    public function storeGiftBlessing(Request $request){
        $validator = Validator::make($request->all(), [
            'blessing_id' => 'required',
            'from_name' => 'required',
            'from_email' => 'required|email',
            'from_phone' => 'required',
            'to_name' => 'required',
            'to_email' => 'required|email',
            'to_phone' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'blessing_id' => $request->blessing_id,
            'from_name'   => $request->from_name,
            'from_email'  => $request->from_email,
            'from_phone'  => $request->from_phone,
            'to_name'     => $request->to_name,
            'to_email'    => $request->to_email,
            'to_phone'    => $request->to_phone,
        ];
        $gift = GiftBlessing::create($data);
        $adminEmail = $this->adminEmail;
        $userEmail = $request->from_email;
        $data['blessing_title'] = optional($gift->blessing)->title;
        // 📧 Send Mail
        try {
            Mail::send('email.admin.gift_blessing_request', $data, function ($message) use ($adminEmail) {
                $message->to($adminEmail)->subject('New Blessing gifting Request');
            });
       
            Mail::send('email.front.gift_blessing_request', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Gift blessing request send Successfully');
            });
        } catch (Exception $e) {
            \Log::error('Gift blessing sending failed: '.$e->getMessage());
        }

        // WhatsApp
        $message =
            "*New Gift Blessing* 🎁\n\n" .
            "*From*\n" .
            "Name: {$gift->from_name}\n" .
            "Email: {$gift->from_email}\n" .
            "Phone: {$gift->from_phone}\n\n" .
            "*To*\n" .
            "Name: {$gift->to_name}\n" .
            "Email: {$gift->to_email}\n" .
            "Phone: {$gift->to_phone}\n\n" .
            "*Blessing:* " . ($gift->blessing->title ?? '-') . "\n\n" .
            "— HNoWW";

        //try {
            $url = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode($message);
            //return back()->with('whatsapp_url', $url);
            return response()->json([
                'status' => true,
                'message' => 'Gift blessing sent successfully',
                'whatsapp_url' => $url
            ]);

        // } catch (Exception $e) {
        //     \Log::error('Gift Blessing Whatsapp message sending failed: '.$e->getMessage());
        // }

        return response()->json(['message' => 'Blessing gifted successfully']);
    }

    public function checkEmailUnique(Request $request){
        $table = $request->table;
        $email = $request->email;
        $exists = false; 
        if($table === 'newsletters') {
            $exists = DB::table('newsletters')->where('email', $email)->exists();
        } elseif($table === 'product_inquiries') {
            $exists = DB::table('product_inquiries')->where('email', $email)->where('is_gift_inquiry', 0)->exists();
        } elseif($table === 'contact_inquiries') {
            $exists = DB::table('contact_inquiries')->where('email', $email)->exists();
        } elseif($table === 'request_catalogues') {
            $exists = DB::table('request_catalogues')->where('email', $email)->exists();
        } elseif($table === 'gift_shops') {
            $exists = DB::table('product_inquiries')->where('email', $email)->where('is_gift_inquiry', 1)->exists();
        } elseif($table === 'corporate_kit_requests') {
            $exists = DB::table('corporate_kit_requests')->where('email', $email)->exists();
        } elseif($table === 'users') {
            $exists = DB::table('users')->where('email', $email)->exists();
        } elseif($table === 'bespoke_commission_enquiries') {
            $exists = DB::table('bespoke_commission_enquiries')->where('email', $email)->exists();
        }

        return response()->json([
            'unique' => !$exists
        ]);
    }

    public function storeNewsletterInquiry(Request $request){
        $validator = Validator::make($request->all(), [
            'newsletter_email' => 'required|email|unique:newsletters,email',
        ], [
            'newsletter_email.required'      => 'Please enter your email address.',
            'newsletter_email.email'         => 'Please enter a valid email address.',
            'newsletter_email.unique'        => 'This email has already been used for an inquiry.',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        try {
            // Save to database
            $newsletter = Newsletter::create([
                'email' => $request->newsletter_email,
            ]);

            // SEND MAIL TO USER AND ADMIN
            $adminEmail = $this->adminEmail;
            $adminWhatsappNo = config('global_values.admin_whatsapp_no'); // admin whatsapp number
            $data = [
                'email'       => $newsletter->email,
            ];
            try {
                Mail::send('email.admin.newsletter_subscription', $data, function ($message) use ($adminEmail) {
                    $message->to($adminEmail)->subject('New Newsletter subscription');
                });
                Mail::send('email.front.newsletter_subscription', $data, function ($message) use ($newsletter) {
                    $message->to($newsletter->email)->subject('Thank you for subscribing to our newsletter!');
                });
            } catch (Exception $e) {
                Log::error('Newsletter subscriptionl sending failed: '.$e->getMessage());
            }
            

            // WhatsApp link (user must click to open)
            $waUrl = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode('New Newsletter subscription with Email Id - ' . $newsletter->email);

            return response()->json([
                'success' => true,
                'message' => 'Subscription successful!',
                'whatsappUrl' => $waUrl,
            ]);

        } catch (\Exception $e) {
            Log::error('Newsletter subscription failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }
    }

    public function getRequestCatalogue(Request $request){
        return view('front.request_catalogue');
    }

    public function storeRequestCatalogue(Request $request){
        $interest = config('global_values.request_catalogue_interest');
        $validator = Validator::make($request->all(), [
            'full_name'      => 'required|string|min:2|max:100',
            'email'         => 'required|email|unique:request_catalogues,email',
            'phone'         => 'required|min:7|max:15',
            'interest'  => 'required|string',
        ], [
            'full_name.required'       => 'Please enter your Full name.',
            'full_name.string'         => 'Full Name must contain only letters.',
            'full_name.max'            => 'Full Name may not be greater than 100 characters.',
            'email.required'      => 'Please enter your email address.',
            'email.email'         => 'Please enter a valid email address.',
            'email.unique'        => 'This email has already been used for an inquiry.',
            'phone.max'      => 'Phone number may not exceed 15 digits.',
            'interest.required' => 'Please select Interest',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save Request Catalogue
        RequestCatalogue::create([
            'name'        => $request->full_name,
            'email'       => $request->email,
            'contact_no'  => $request->phone,
            'interest' => $request->interest,
        ]);

        // SEND MAIL TO USER AND ADMIN
        $adminEmail = $this->adminEmail;
        $userEmail = $request->email;
        $data = [
            'name'        => $request->full_name,
            'email'       => $request->email,
            'contact_no'  => $request->phone,
            'interest' => $interest[$request->interest],
        ];

        try {
            Mail::send('email.admin.request_catalogue', $data, function ($message) use ($adminEmail) {
                $message->to($this->adminEmail)->subject('New Request Catalogue Received');
            });
       
            Mail::send('email.front.request_catalogue', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Request Catalogue send Successfully');
            });
        } catch (Exception $e) {
            Log::error('Request Catalogue Mail sending failed: '.$e->getMessage());
        }

        // SEND WHATSAPP MESSAGE TO ADMIN
        //$message = 'New Request Catalogue is placed using email - '.$request->email;
        $message = "📦 *New Catalogue Request*\n\n" .
            "*Name:* {$request->full_name}\n" .
            "*Email:* {$request->email}\n" .
            "*Contact No:* {$request->phone}\n" .
            "*Interest:* {$interest[$request->interest]}\n\n" .
            "— HNoWW";

        try {
            $url = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode($message);
            //return redirect()->away($url);
            return back()->with('whatsapp_url', $url);
        } catch (Exception $e) {
            Log::error('Request Catalogue Whatsapp message sending failed: '.$e->getMessage());
        }
        return back()->with('success', 'Your Request Catalogue has been submitted successfully!');
    }

    public function getContactUs(Request $request){
        return view('front.contact_us');
    }

    public function storeContactInquiry(Request $request){
        $enquiryType = config('global_values.contact_enquiry_type');
        $validator = Validator::make($request->all(), [
            'full_name'      => 'required|string|min:2|max:100',
            'email'         => 'required|email|unique:contact_inquiries,email',
            'phone'         => 'required|min:7|max:15',
            'enquiry_type'  => 'required|string',
            'message'       => 'required|string|min:5|max:255',

        ], [
            'full_name.required'       => 'Please enter your Full name.',
            'full_name.string'         => 'Full Name must contain only letters.',
            'full_name.max'            => 'Full Name may not be greater than 100 characters.',
            'email.required'      => 'Please enter your email address.',
            'email.email'         => 'Please enter a valid email address.',
            'email.unique'        => 'This email has already been used for an inquiry.',
            'phone.max'      => 'Phone number may not exceed 15 digits.',
            'enquiry_type.required' => 'Please select Enquiry Type',
            'message.string'      => 'Message must be valid text.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save inquiry
        ContactInquiry::create([
            'name'        => $request->full_name,
            'email'       => $request->email,
            'contact_no'  => $request->phone,
            'inquiry_type' => $request->enquiry_type,
            'message'     => $request->message ?? NULL,
        ]);

        // SEND MAIL TO USER AND ADMIN
        $adminEmail = $this->adminEmail;
        $userEmail = $request->email;
        $data = [
            'name'        => $request->full_name,
            'email'       => $request->email,
            'contact_no'  => $request->phone,
            'inquiry_type' => $enquiryType[$request->enquiry_type],
            'message_data'     => $request->message ?? NULL,
        ];

        try {
            Mail::send('email.admin.contact_inquiry', $data, function ($message) use ($adminEmail) {
                $message->to($this->adminEmail)->subject('New Contact Inquiry Received');
            });
       
            Mail::send('email.front.contact_inquiry', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Contact Inquiry send Successfully');
            });
        } catch (Exception $e) {
            Log::error('Inquiry Mail sending failed: '.$e->getMessage());
        }

        // SEND WHATSAPP MESSAGE TO ADMIN
        //$message = 'New Contact inquiry is placed using email - '.$request->email;
        $message = "📩 *New Contact Inquiry*\n\n" .
            "*Full Name:* {$request->full_name}\n" .
            "*Email:* {$request->email}\n" .
            "*Contact No:* {$request->phone}\n" .
            "*Enquiry Type:* {$enquiryType[$request->enquiry_type]}\n" .
            "*Message:* " . ($request->message ?? 'N/A') . "\n\n" .
            "— HNoWW";

        try {
            $url = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode($message);
            //return redirect()->away($url);
            return back()->with('whatsapp_url', $url);
        } catch (Exception $e) {
            Log::error('Inquiry Whatsapp message sending failed: '.$e->getMessage());
        }
        return back()->with('success', 'Your inquiry has been submitted successfully!');
    }

    public function getFaqs(Request $request){
        $faq = FaqType::where('is_active', 0)->whereNull('deleted_at')
                ->with(['faqs' => function($q) {
                    $q->where('is_active', 0) 
                      ->whereNull('deleted_at');
                }])->get();
                
        return view('front.faqs', compact('faq'));
    }

    public function getCorporateVault(Request $request, $catSlug = NULL){
        $categories = Category::where('category_type', 2)->where('is_active', 0)->whereNull('deleted_at')->get();
        $selectedCategory = Category::where('category_url', $catSlug)->first();
        $products = Product::where('product_type', 2)->isActive()->notDeleted();
        if($catSlug != NULL && $selectedCategory != ''){
            $products = $products->where('category_id', $selectedCategory->id);
        }
        $products = $products->get();
        $corporateProduct = Product::select('id', 'product_name')->where('product_type', 2)->whereNull('deleted_at')->where('is_active', 0)->get();
        $weddingProduct = Product::select('id', 'product_name')->where('product_type', 3)->whereNull('deleted_at')->where('is_active', 0)->get();
        $corporateKits = CorporateKit::isActive()->notDeleted()->get();

        return view('front.corporate_vault', compact('categories', 'products', 'corporateProduct', 'weddingProduct', 'corporateKits'));
    }

    public function storeCorporateProposalRequest(Request $request){
        $qualityRange = config('global_values.quality_range');
        $corporateBudget = config('global_values.corporate_budget');
        $timeline = config('global_values.corporate_timeline');
        // $rules = [
        //     'full_name'             => 'required|string|min:2|max:100',
        //     'company_name'          => 'required|string|min:2|max:150',
        //     'phone'                 => 'required|regex:/^[0-9\s\-\+\(\)]+$/|min:7|max:20',
        //     'email'                 => 'required|email|max:150',
        //     'product_of_interest'   => 'nullable|array',
        //     'product_of_interest.*' => 'string',
        //     'quantity_range'        => 'required|string',
        //     'budget'                => 'nullable|string|max:100',
        //     'branding_requirements' => 'nullable|string|max:255',
        //     'delivery_date'         => 'required|date|after_or_equal:today',
        //     'message'               => 'nullable|string|max:500',
        // ];
        // $messages = [
        //     'full_name.required'             => 'Full Name is required.',
        //     'full_name.min'                  => 'Full Name must be at least 2 characters.',
        //     'full_name.max'                  => 'Full Name cannot be longer than 100 characters.',
        //     'company_name.required'          => 'Company Organization is required.',
        //     'phone.required'                 => 'Phone Number is required.',
        //     'phone.regex'                   => 'Phone Number format is invalid.',
        //     'phone.min'                     => 'Phone Number is too short.',
        //     'phone.max'                     => 'Phone Number is too long.',
        //     'email.required'                => 'Email Address is required.',
        //     'email.email'                   => 'Email must be a valid email address.',
        //     'quantity_range.required'       => 'Quantity Range is required.',
        //     'quantity_range.in'             => 'Selected Quantity Range is invalid.',
        //     'delivery_date.required'        => 'Delivery Timeline is required.',
        //     'delivery_date.date'            => 'Delivery Timeline must be a valid date.',
        //     'delivery_date.after_or_equal'  => 'Delivery Timeline cannot be in the past.',
        //     'message.max'                   => 'Message cannot exceed 500 characters.',
        // ];
        $rules = [
            'full_name'             => 'required|string|min:2|max:100',
            'company_name'          => 'required|string|min:2|max:150',
            'role'                  => 'required|string|max:100',
            //'phone'                 => 'nullable|regex:/^[0-9\s\-\+\(\)]+$/|min:7|max:20',
            'email'                 => 'required|email|max:150',
            'nature_of_requirement'   => 'required|array|min:1',
            'nature_of_requirement.*' => 'string|max:150',
            'quantity_range'        => 'required|string|max:50',
            'corporate_budget'      => 'required|string|max:100',
            'timeline'              => 'required|string|max:50',
            'message'               => 'nullable|string|max:500',
        ];
        $messages = [
            'full_name.required'         => 'Full Name is required.',
            'full_name.min'              => 'Full Name must be at least 2 characters.',
            'full_name.max'              => 'Full Name cannot be longer than 100 characters.',
            'company_name.required'      => 'Company Name is required.',
            'company_name.min'           => 'Company Name must be at least 2 characters.',
            'company_name.max'           => 'Company Name cannot exceed 150 characters.',
            'role.required'              => 'Role / Designation is required.',
            'role.max'                   => 'Role cannot exceed 100 characters.',
            // 'phone.regex'                => 'Phone Number format is invalid.',
            // 'phone.min'                  => 'Phone Number is too short.',
            // 'phone.max'                  => 'Phone Number is too long.',
            'email.required'             => 'Email Address is required.',
            'email.email'                => 'Email must be a valid email address.',
            'nature_of_requirement.required'   => 'Please select at least one Nature of Requirement.',
            'nature_of_requirement.array'      => 'Invalid Nature of Requirement selection.',
            'nature_of_requirement.*.max'      => 'Each selected Nature of Requirement cannot exceed 150 characters.',
            'quantity_range.required'    => 'Please select a Quantity Range.',
            'quantity_range.max'         => 'Quantity Range cannot exceed 50 characters.',
            'corporate_budget.required' => 'Please select a Budget Comfort.',
            'corporate_budget.max'      => 'Budget Comfort cannot exceed 100 characters.',
            'timeline.required'         => 'Please select a Timeline.',
            'timeline.max'              => 'Timeline cannot exceed 50 characters.',
            'message.max'                => 'Message cannot exceed 500 characters.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save the data (example: assuming you have a model CorporateProposal)
        $data = $request->only([
            'full_name', 
            'company_name', 
            'role', 
            'email', 
            'quantity_range', 
            'corporate_budget', 
            'timeline', 
            'message'
        ]); 

        // Convert array to string for product_of_interest if needed (or save JSON)
        // if ($request->has('product_of_interest')) {
        //     $data['product_of_interest'] = json_encode($request->input('product_of_interest'));
        // } else {
        //     $data['product_of_interest'] = null;
        // }

        if ($request->has('nature_of_requirement')) {
            $data['nature_of_requirement'] = json_encode($request->input('nature_of_requirement'));
        } else {
            $data['nature_of_requirement'] = null;
        }

        CorporateProposalRequest::create($data);
        $commaSeparatedRequirements = '';
        $requirements = $request->nature_of_requirement;
        if (isset($requirements) && is_countable($requirements) && count($requirements) > 0) {
            $commaSeparatedRequirements = implode(', ', $requirements);
        }

        // $commaSeparatedProducts = '';
        // $productIds = $request->product_of_interest;
        // $productNames = Product::whereIn('id', $productIds)->pluck('product_name')->toArray();
        // if(isset($productNames) && is_countable($productNames) && count($productNames) > 0){
        //     $commaSeparatedProducts = implode(', ', $productNames);
        // }

        // SEND MAIL TO USER AND ADMIN
        $adminEmail = $this->adminEmail;
        $userEmail = $request->email;
        $qualityRange = $qualityRange[$request->quantity_range];
        $corporateBudget = $corporateBudget[$request->corporate_budget];
        $timeline = $timeline[$request->timeline];
        $data = [
            // 'name'        => $request->full_name,
            // 'company_name'        => $request->company_name,
            // 'phone'        => $request->phone,
            // 'email'       => $request->email,
            // 'product_of_interest' => $commaSeparatedProducts,
            // 'quantity_range'  => $qualityRange[$request->quantity_range],
            // 'budget'  => $request->budget,
            // 'branding_requirements'  => $request->branding_requirements,
            // 'delivery_date'  => $request->delivery_date,
            // 'message_data'     => $request->message ?? NULL,
            'name'                   => $request->full_name,
            'company_name'           => $request->company_name,
            'role'                   => $request->role,
            'email'                  => $request->email,
            'quantity_range'         => $qualityRange,
            'corporate_budget'       => $corporateBudget,
            'timeline'               => $timeline,
            'nature_of_requirement'  => $commaSeparatedRequirements,
            'message_data'           => $request->message ?? null,
        ];

        //try {
            Mail::send('email.admin.corporate_proposal_request', $data, function ($message) use ($adminEmail) {
                $message->to($this->adminEmail)->subject('New Corporate Proposal Request Received');
            });
       
            Mail::send('email.front.corporate_proposal_request', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Corporate Proposal Request send Successfully');
            });
        // } catch (Exception $e) {
        //     Log::error('Inquiry Mail sending failed: '.$e->getMessage());
        // }

        // SEND WHATSAPP MESSAGE TO ADMIN
        //$message = 'New Corporate Proposal Request is placed using email - '.$request->email;
        // $message = "📩 *New Corporate Proposal Request*\n\n" .
        //         "*Full Name:* {$request->full_name}\n" .
        //         "*Company Name:* {$request->company_name}\n" .
        //         "*Phone:* {$request->phone}\n" .
        //         "*Email:* {$request->email}\n" .
        //         "*Product of Interest:* " . ($commaSeparatedProducts ?? 'N/A') . "\n" .
        //         "*Quantity Range:* {$qualityRange[$request->quantity_range]}\n" .
        //         "*Budget:* {$request->budget}\n" .
        //         "*Branding Requirements:* {$request->branding_requirements}\n" .
        //         "*Delivery Date:* {$request->delivery_date}\n" .
        //         "*Message:* " . ($request->message ?? 'N/A') . "\n\n" .
        //         "— HNoWW";
        $message = "📩 *New Corporate Proposal Request*\n\n" .
                    "*Full Name:* {$request->full_name}\n" .
                    "*Company Name:* {$request->company_name}\n" .
                    "*Role / Designation:* {$request->role}\n" .
                    "*Email:* {$request->email}\n" .
                    "*Quantity Range:* {$qualityRange}\n" .
                    "*Budget Comfort:* {$corporateBudget}\n" .
                    "*Timeline:* {$timeline}\n" .
                    "*Nature of Requirement:* " . ($commaSeparatedRequirements ?? 'N/A') . "\n" .
                    "*Message:* " . ($request->message ?? 'N/A') . "\n\n" .
                    "— HNoWW";

        try {
            $url = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode($message);
            //return redirect()->away($url);
            return back()->with('whatsapp_url', $url);
        } catch (Exception $e) {
            Log::error('Inquiry Whatsapp message sending failed: '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Corporate proposal request submitted successfully.');
    }

    public function storeCorporateKitRequest(Request $request){
        $qualityRange = config('global_values.quality_range');
        $rules = [
            'k_full_name'             => 'required|string|min:2|max:100',
            'k_company_name'          => 'required|string|min:2|max:150',
            'k_phone'                 => 'required|regex:/^[0-9\s\-\+\(\)]+$/|min:7|max:20',
            'k_email'                 => 'required|email|max:150',
            'k_product_of_interest'   => 'nullable|array',
            'k_product_of_interest.*' => 'string',
            'k_quantity_range'        => 'required|string',
            'k_budget'                => 'nullable|string|max:100',
            'k_branding_requirements' => 'nullable|string|max:255',
            'k_delivery_date'         => 'required|date|after_or_equal:today',
            'k_message'               => 'nullable|string|max:500',
        ];
        $messages = [
            'k_full_name.required'             => 'Full Name is required.',
            'k_full_name.min'                  => 'Full Name must be at least 2 characters.',
            'k_full_name.max'                  => 'Full Name cannot be longer than 100 characters.',
            'k_company_name.required'          => 'Company Organization is required.',
            'k_phone.required'                 => 'Phone Number is required.',
            'k_phone.regex'                   => 'Phone Number format is invalid.',
            'k_phone.min'                     => 'Phone Number is too short.',
            'k_phone.max'                     => 'Phone Number is too long.',
            'k_email.required'                => 'Email Address is required.',
            'k_email.email'                   => 'Email must be a valid email address.',
            'k_quantity_range.required'       => 'Quantity Range is required.',
            'k_quantity_range.in'             => 'Selected Quantity Range is invalid.',
            'k_delivery_date.required'        => 'Delivery Timeline is required.',
            'k_delivery_date.date'            => 'Delivery Timeline must be a valid date.',
            'k_delivery_date.after_or_equal'  => 'Delivery Timeline cannot be in the past.',
            'k_message.max'                   => 'Message cannot exceed 500 characters.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       
        $data = [
            'full_name' => $request->k_full_name,
            'company_name' => $request->k_company_name,
            'phone' => $request->k_phone,
            'email' => $request->k_email,
            'quantity_range' => $request->k_quantity_range,
            'budget' => $request->k_budget,
            'branding_requirements' => $request->k_branding_requirements,
            'delivery_date' => $request->k_delivery_date,
            'message' => $request->k_message,
        ];

        // Convert array to string for product_of_interest if needed (or save JSON)
        if ($request->has('k_product_of_interest')) {
            $data['product_of_interest'] = json_encode($request->input('k_product_of_interest'));
        } else {
            $data['product_of_interest'] = null;
        }

        CorporateKitRequest::create($data);

        $commaSeparatedProducts = '';
        $productIds = $request->k_product_of_interest;
        $productNames = CorporateKit::whereIn('id', $productIds)->pluck('title')->toArray();
        if(isset($productNames) && is_countable($productNames) && count($productNames) > 0){
            $commaSeparatedProducts = implode(', ', $productNames);
        }

        // SEND MAIL TO USER AND ADMIN
        $adminEmail = $this->adminEmail;
        $userEmail = $request->k_email;
        $data = [
            'name'        => $request->k_full_name,
            'company_name'        => $request->k_company_name,
            'phone'        => $request->k_phone,
            'email'       => $request->k_email,
            'product_of_interest' => $commaSeparatedProducts,
            'quantity_range'  => $qualityRange[$request->k_quantity_range],
            'budget'  => $request->k_budget,
            'branding_requirements'  => $request->k_branding_requirements,
            'delivery_date'  => $request->k_delivery_date,
            'message_data'     => $request->k_message ?? NULL,
        ];

        try {
            Mail::send('email.admin.wedding_catalogue_request', $data, function ($message) use ($adminEmail) {
                $message->to($this->adminEmail)->subject('New Corporate Kit Request Received');
            });
       
            Mail::send('email.front.wedding_catalogue_request', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Corporate Kit Request send Successfully');
            });
        } catch (Exception $e) {
            Log::error('Inquiry Mail sending failed: '.$e->getMessage());
        }

        // SEND WHATSAPP MESSAGE TO ADMIN
        //$message = 'New Corporate Kit Request is placed using email - '.$request->w_email;
        $message = "📩 *New Corporate Kit Request*\n\n" .
                "*Full Name:* {$request->k_full_name}\n" .
                "*Company Name:* {$request->k_company_name}\n" .
                "*Phone:* {$request->k_phone}\n" .
                "*Email:* {$request->k_email}\n" .
                "*Product of Interest:* " . ($commaSeparatedProducts ?? 'N/A') . "\n" .
                "*Quantity Range:* {$qualityRange[$request->k_quantity_range]}\n" .
                "*Budget:* {$request->k_budget}\n" .
                "*Branding Requirements:* {$request->k_branding_requirements}\n" .
                "*Delivery Date:* {$request->k_delivery_date}\n" .
                "*Message:* " . ($request->k_message ?? 'N/A') . "\n\n" .
                "— HNoWW";

        try {
            $url = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode($message);
            //return redirect()->away($url);
            return back()->with('whatsapp_url', $url);
        } catch (Exception $e) {
            Log::error('Inquiry Whatsapp message sending failed: '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Wedding Catalogue request submitted successfully.');
    }

    public function storeWeddingCatalogueRequest(Request $request){
        // $qualityRange = config('global_values.quality_range');
        $weddingRole = config('global_values.wedding_role');
        $rules = [
            // 'w_full_name'             => 'required|string|min:2|max:100',
            // 'w_company_name'          => 'required|string|min:2|max:150',
            // 'w_phone'                 => 'required|regex:/^[0-9\s\-\+\(\)]+$/|min:7|max:20',
            // 'w_email'                 => 'required|email|max:150',
            // 'w_product_of_interest'   => 'nullable|array',
            // 'w_product_of_interest.*' => 'string',
            // 'w_quantity_range'        => 'required|string',
            // 'w_budget'                => 'nullable|string|max:100',
            // 'w_branding_requirements' => 'nullable|string|max:255',
            // 'w_delivery_date'         => 'required|date|after_or_equal:today',
            // 'w_message'               => 'nullable|string|max:500',

            'w_full_name'      => 'required|string|min:2|max:100',
            //'w_phone'          => 'nullable|regex:/^[0-9]+$/|min:7|max:15',
            'w_email'          => 'required|email|max:150',
            'w_role'           => 'required|string|max:100',
            'w_location'       => 'nullable|string|max:150',
            'w_wedding_date'   => 'required|date|after_or_equal:today',
            'w_looking_for'    => 'required|array|min:1',
            'w_looking_for.*'  => 'string|max:150',
            'w_guest_count'    => 'required|string|max:50',
            'w_budget_band'    => 'required|string|max:100',
            'w_message'        => 'nullable|string|max:500',
        ];
        // $messages = [
        //     'w_full_name.required'             => 'Full Name is required.',
        //     'w_full_name.min'                  => 'Full Name must be at least 2 characters.',
        //     'w_full_name.max'                  => 'Full Name cannot be longer than 100 characters.',
        //     'w_company_name.required'          => 'Company Organization is required.',
        //     'w_phone.required'                 => 'Phone Number is required.',
        //     'w_phone.regex'                   => 'Phone Number format is invalid.',
        //     'w_phone.min'                     => 'Phone Number is too short.',
        //     'w_phone.max'                     => 'Phone Number is too long.',
        //     'w_email.required'                => 'Email Address is required.',
        //     'w_email.email'                   => 'Email must be a valid email address.',
        //     'w_quantity_range.required'       => 'Quantity Range is required.',
        //     'w_quantity_range.in'             => 'Selected Quantity Range is invalid.',
        //     'w_delivery_date.required'        => 'Delivery Timeline is required.',
        //     'w_delivery_date.date'            => 'Delivery Timeline must be a valid date.',
        //     'w_delivery_date.after_or_equal'  => 'Delivery Timeline cannot be in the past.',
        //     'w_message.max'                   => 'Message cannot exceed 500 characters.',
        // ];
        $messages = [
            'w_full_name.required' => 'Full Name is required.',
            'w_full_name.string'   => 'Full Name must be a valid text.',
            'w_full_name.min'      => 'Full Name must be at least 2 characters.',
            'w_full_name.max'      => 'Full Name cannot exceed 100 characters.',

            // 'w_phone.required' => 'Phone Number is required.',
            // 'w_phone.regex'    => 'Phone Number must contain only digits.',
            // 'w_phone.min'      => 'Phone Number must be at least 7 digits.',
            // 'w_phone.max'      => 'Phone Number cannot exceed 15 digits.',

            'w_email.required' => 'Email Address is required.',
            'w_email.email'    => 'Please enter a valid Email Address.',
            'w_email.max'      => 'Email Address cannot exceed 150 characters.',

            'w_role.required' => 'Please select your Role.',
            'w_role.string'   => 'Role must be valid.',
            'w_role.max'      => 'Role cannot exceed 100 characters.',

            'w_location.string' => 'Wedding Location must be valid text.',
            'w_location.max'    => 'Wedding Location cannot exceed 150 characters.',

            'w_wedding_date.required' => 'Wedding Date is required.',
            'w_wedding_date.date'     => 'Please select a valid Wedding Date.',
            'w_wedding_date.after_or_equal' => 'Wedding Date cannot be in the past.',

            'w_looking_for.required' => 'Please select at least one option.',
            'w_looking_for.array'    => 'Invalid selection for What you are looking for.',
            'w_looking_for.min'      => 'Please select at least one option.',
            'w_looking_for.*.string' => 'Invalid selection value.',
            'w_looking_for.*.max'    => 'Selection value is too long.',

            'w_guest_count.required' => 'Please select the Approximate Guest Count.',
            'w_guest_count.string'   => 'Guest Count must be valid.',
            'w_guest_count.max'      => 'Guest Count cannot exceed 50 characters.',

            'w_budget_band.required' => 'Please select the Budget Band.',
            'w_budget_band.string'   => 'Budget Band must be valid.',
            'w_budget_band.max'      => 'Budget Band cannot exceed 100 characters.',

            'w_message.string' => 'Message must be valid text.',
            'w_message.max'    => 'Message cannot exceed 500 characters.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $role = $request->w_role ? $weddingRole[$request->w_role] : '-';
        $weddingDate = $request->w_wedding_date ?? null;
        $lookingFor = is_array($request->w_looking_for) ? implode(', ', $request->w_looking_for) : $request->w_looking_for;
        $data = [
            // 'full_name' => $request->w_full_name,
            // 'company_name' => $request->w_company_name,
            // 'phone' => $request->w_phone,
            // 'email' => $request->w_email,
            // 'quantity_range' => $request->w_quantity_range,
            // 'budget' => $request->w_budget,
            // 'branding_requirements' => $request->w_branding_requirements,
            // 'delivery_date' => $request->w_delivery_date,
            // 'message' => $request->w_message,
            'full_name'      => $request->w_full_name,
            //'phone'          => $request->w_phone,
            'email'          => $request->w_email,
            'role'           => $role,
            'location'       => $request->w_location,
            'wedding_date'   => $weddingDate,
            'looking_for'    => $lookingFor,
            'guest_count'    => $request->w_guest_count,
            'budget_band'    => $request->w_budget_band,
            'message_note'        => $request->w_message,
        ];

        // Convert array to string for product_of_interest if needed (or save JSON)
        // if ($request->has('w_product_of_interest')) {
        //     $data['product_of_interest'] = json_encode($request->input('w_product_of_interest'));
        // } else {
        //     $data['product_of_interest'] = null;
        // }

        WeddingCatalogueRequest::create($data);

        // $commaSeparatedProducts = '';
        // $productIds = $request->w_product_of_interest;
        // $productNames = Product::whereIn('id', $productIds)->pluck('product_name')->toArray();
        // if(isset($productNames) && is_countable($productNames) && count($productNames) > 0){
        //     $commaSeparatedProducts = implode(', ', $productNames);
        // }

        // SEND MAIL TO USER AND ADMIN
        $adminEmail = $this->adminEmail;
        $userEmail = $request->w_email;
        $weddingDate = $request->w_wedding_date ? date('d-m-Y', strtotime($request->w_wedding_date)) : '-';
        $data['wedding_date'] = $weddingDate;
        try {
            Mail::send('email.admin.wedding_catalogue_request', $data, function ($message) use ($adminEmail) {
                $message->to($this->adminEmail)->subject('New Wedding Catalogue Request Received');
            });
       
            Mail::send('email.front.wedding_catalogue_request', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Wedding Catalogue Request send Successfully');
            });
        } catch (Exception $e) {
            Log::error('Inquiry Mail sending failed: '.$e->getMessage());
        }
        
        // SEND WHATSAPP MESSAGE TO ADMIN
        // $message = "📩 *New Wedding Catalogue Request*\n\n" .
        //         "*Full Name:* {$request->w_full_name}\n" .
        //         "*Company Name:* {$request->w_company_name}\n" .
        //         "*Phone:* {$request->w_phone}\n" .
        //         "*Email:* {$request->w_email}\n" .
        //         "*Product of Interest:* " . ($commaSeparatedProducts ?? 'N/A') . "\n" .
        //         "*Quantity Range:* {$qualityRange[$request->w_quantity_range]}\n" .
        //         "*Budget:* {$request->w_budget}\n" .
        //         "*Branding Requirements:* {$request->w_branding_requirements}\n" .
        //         "*Delivery Date:* {$request->w_delivery_date}\n" .
        //         "*Message:* " . ($request->w_message ?? 'N/A') . "\n\n" .
        //         "— HNoWW";
        $message = "📩 *New Wedding Consultation Request*\n\n" .
            "*Full Name:* {$request->w_full_name}\n" .
            //"*Phone:* {$request->w_phone}\n" .
            "*Email:* {$request->w_email}\n" .
            "*Role:* {$role}\n" .
            "*Wedding Location:* " . ($request->w_location ?? 'N/A') . "\n" .
            "*Wedding Date:* {$weddingDate}\n" .
            "*Looking For:* " . ($lookingFor) . "\n" .
            "*Guest Count:* {$request->w_guest_count}\n" .
            "*Budget Band:* {$request->w_budget_band}\n" .
            "*Message:* " . ($request->w_message ?? 'N/A') . "\n\n" .
            "— HNoWW";

        try {
            $url = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode($message);
            //return redirect()->away($url);
            return back()->with('whatsapp_url', $url);
        } catch (Exception $e) {
            Log::error('Inquiry Whatsapp message sending failed: '.$e->getMessage());
        }

        return redirect()->back()->with('success', 'Wedding Catalogue request submitted successfully.');
    }

    public function storeBespokeCommissionRequest(Request $request){
        $commissionType = config('global_values.commission_type');
        $timelineValues = config('global_values.timeline');
        $budgetValues = config('global_values.budget_range');

        // Validation rules
        $rules = [
            'bc_full_name'                  => 'required|string|min:2|max:100',
            'bc_email'                      => 'required|email|max:150',
            'bc_phone'                      => 'required|regex:/^[0-9\s\-\+\(\)]+$/|min:7|max:20',
            'bc_type_of_commission'          => 'required|string',
            'bc_type_of_commission_other'    => 'required_if:bc_type_of_commission,other|max:150',
            'bc_message'                     => 'nullable|string|max:500',
            'bc_timeline'                    => 'required|string',
            'bc_budget'                      => 'required|string',
            'bc_additional_message'          => 'nullable|string|max:500',
        ];

        // Custom messages
        $messages = [
            'bc_full_name.required' => 'Full Name is required.',
            'bc_full_name.min' => 'Full Name must be at least 2 characters.',
            'bc_full_name.max' => 'Full Name cannot be longer than 100 characters.',
            'bc_email.required' => 'Email Address is required.',
            'bc_email.email' => 'Email must be a valid email address.',
            'bc_phone.required' => 'Phone Number is required.',
            'bc_phone.regex' => 'Phone Number format is invalid.',
            'bc_phone.min' => 'Phone Number is too short.',
            'bc_phone.max' => 'Phone Number is too long.',
            'bc_type_of_commission.required' => 'Type of Commission is required.',
            'bc_type_of_commission_other.required_if' => 'Please specify your commission type.',
            'bc_timeline.required' => 'Intended Timeline is required.',
            'bc_budget.required' => 'Budget Comfort Range is required.',
            'bc_message.max' => 'Message cannot exceed 500 characters.',
            'bc_additional_message.max' => 'Additional Message cannot exceed 500 characters.',
        ];

        // Validate request
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Prepare data for saving
        $data = [
            'full_name' => $request->bc_full_name,
            'email' => $request->bc_email,
            'phone' => $request->bc_phone,
            'type_of_commission' => $request->bc_type_of_commission === 'other' 
                                    ? $request->bc_type_of_commission_other 
                                    : $commissionType[$request->bc_type_of_commission] ?? $request->bc_type_of_commission,
            'customer_hoping_to_create' => $request->bc_customer_hoping_to_create,
            'timeline' => $timelineValues[$request->bc_timeline] ?? $request->bc_timeline,
            'budget' => $budgetValues[$request->bc_budget] ?? $request->bc_budget,
            'additional_message' => $request->bc_additional_message,
        ];

        // Save to database
        BespokeCommissionEnquiry::create($data);

        // Prepare email data
        $adminEmail = $this->adminEmail; // Set in controller
        $userEmail = $request->bc_email;
        $emailData = $data;

        try {
            // Send email to admin
            Mail::send('email.admin.bespoke_commission_request', $emailData, function ($message) use ($adminEmail) {
                $message->to($adminEmail)->subject('New Bespoke Commission Request Received');
            });

            // Send email to user
            Mail::send('email.front.bespoke_commission_request', $emailData, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Bespoke Commission Request Submitted Successfully');
            });
        } catch (\Exception $e) {
            Log::error('Bespoke Commission Mail sending failed: ' . $e->getMessage());
        }

        // Send WhatsApp notification to admin
        //if(isset($request->bc_phone) && $request->bc_phone != '') {
            try {
                $messageText = "📩 *New Bespoke Commission Request*\n\n" .
                            "*Full Name:* {$request->bc_full_name}\n" .
                            "*Email:* {$request->bc_email}\n" .
                            "*Phone:* {$request->bc_phone}\n" .
                            "*Type of Commission:* {$data['type_of_commission']}\n" .
                            "*Timeline:* {$data['timeline']}\n" .
                            "*Budget:* {$data['budget']}\n" .
                            "*Customer hoping to create:* " . ($request->bc_customer_hoping_to_create ?? 'N/A') . "\n" .
                            "*Additional Info:* " . ($request->bc_additional_message ?? 'N/A');

                $waUrl = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode($messageText);
                return back()->with('whatsapp_url', $waUrl);
            } catch (\Exception $e) {
                Log::error('Bespoke Commission WhatsApp sending failed: '.$e->getMessage());
            }
        //}

        return redirect()->back()->with('success', 'Thank you.</br> We review bespoke enquiries slowly and intentionally.</br>If your request aligns with our practice, a member of the Atelier will be in touch.');
    }

    public function getJournal(Request $request){
        $journal = Journal::where('is_active', 0)->orderBy('sort_by', 'ASC')->get();

        return view('front.journal', compact('journal'));
    }

    public function getBlessings(Request $request, $blessingsOf = NULL){
        $blessings = Blessing::where('is_active', 0)->whereNull('deleted_at');
        if(isset($blessingsOf) && $blessingsOf != NULL){
            $blessings = $blessings->whereRaw("FIND_IN_SET(?, blessing_of)", [$blessingsOf]);
        }
        $blessings = $blessings->orderBy('id', 'DESC')->get();
 
        return view('front.blessings', compact('blessings'));
    }

    public function blessingDetail(Request  $request, $blessingsOf = NULL){
        $blessing = Blessing::where('is_active', 0)->whereNull('deleted_at');
        if(isset($blessingsOf) && $blessingsOf != NULL){
            $blessing = $blessing->where('id', $blessingsOf); 
        }
        $blessing = $blessing->first();
        return view('front.blessing_detail', compact('blessing'));
    }

    public function getAtelier(Request $request){
        $corporateProduct = Product::select('id', 'product_name')->where('product_type', 2)->whereNull('deleted_at')->where('is_active', 0)->get();
        $weddingProduct = Product::select('id', 'product_name')->where('product_type', 3)->whereNull('deleted_at')->where('is_active', 0)->get();

        return view('front.atelier', compact('corporateProduct', 'weddingProduct'));
    }

    public function getWeddingVault(Request $request){
        return view('front.wedding_vault');
    }

    public function sendUnlockWeddingEmail(Request $request){
        $validator = Validator::make($request->all(), [
            'unlock_email' => 'required|email',
        ], [
            'unlock_email.required' => 'Please enter your email address.',
            'unlock_email.email' => 'Please enter a valid email address.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $userEmail = $request->unlock_email;
        $otp = random_int(100000, 999999);

        try {
            // Store OTP and email in session
            session(['wedding_vault_otp' => $otp]);
            session(['wedding_vault_email' => $userEmail]);

            // SEND MAIL TO USER
            $data = ['otp' => $otp];

            Mail::send('email.front.wedding_vault_unlock_otp', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Wedding Vault Unlock OTP');
            });

            return response()->json([
                'success' => true,
                'message' => 'OTP sent Successfully',
            ]);

        } catch (\Exception $e) {
            Log::error('Wedding Vault mail sending failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }
    }

    public function verifyWeddingVaultOtp(Request $request)
    {
        $sessionOtp = session('wedding_vault_otp');
        $sessionEmail = session('wedding_vault_email');

        if (!$sessionOtp || !$sessionEmail) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired or not found. Please request a new OTP.'
            ]);
        }

        if ($request->otp == $sessionOtp && $request->unlock_email == $sessionEmail) {
            // OTP matched, clear from session if you want
            session()->forget(['wedding_vault_otp', 'wedding_vault_email']);

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully',
                'redirect' => route('front.wedding.vault.inside'), 
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please try again.'
            ]);
        }
    }

    public function getWeddingVaultInside(Request $request){
        // $weddingProduct = Product::select('id', 'product_name', 'short_description', 'list_page_img', 'product_url')->where('product_type', 3)->isActive()->notDeleted()->get();
        $weddingCategory = Category::select('id', 'category_name', 'title', 'banner_image', 'category_url', 'category_type')->where('category_type', 3)->isActive()->notDeleted()->get();

        return view('front.wedding_vault_inside', compact('weddingCategory'));
    }

    public function getCeremonials($categoryId = null){
        $products = Product::select('id', 'category_id', 'product_url', 'product_name', 'short_description', 'list_page_img', 'is_active', 'deleted_at')->whereNull('deleted_at')->where('is_active', 0)->where('category_id', $categoryId)->get();
        
        return view('front.ceremonials', compact('products'));
    }

    public function storeCeremonialInquiry(Request $request){
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'ceremonial_id'  => 'required|exists:ceremonials,id',
            'email'       => 'required|email|max:255|unique:ceremonial_inquiries,email',
            'contact_no'  => 'nullable|string|max:15',
            'message'     => 'nullable|string',
        ], [
            'name.required'       => 'Please enter your name.',
            'name.string'         => 'Name must contain only letters.',
            'name.max'            => 'Name may not be greater than 255 characters.',
            'email.required'      => 'Please enter your email address.',
            'email.email'         => 'Please enter a valid email address.',
            'email.unique'        => 'This email has already been used for an inquiry.',
            'contact_no.max'      => 'Contact number may not exceed 15 digits.',
            'message.string'      => 'Message must be valid text.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save inquiry
        CeremonialInquiry::create([
            'name'        => $request->name,
            'ceremonial_id'  => $request->ceremonial_id,
            'email'       => $request->email,
            'contact_no'  => $request->contact_no,
            'message'     => $request->message ?? NULL,
        ]);
        $ceremonial = Ceremonial::where('id', $request->ceremonial_id)->first();
        // SEND MAIL TO USER AND ADMIN
        $adminEmail = $this->adminEmail;
        $userEmail = $request->email;
        $data = [
            'name'        => $request->name ?? '',
            'ceremonial'  => $ceremonial->title ?? '',
            'email'       => $request->email ?? '',
            'contact_no'  => $request->contact_no ?? '',
            'message_data'     => $request->message ?? NULL,
        ];

        //try {
            Mail::send('email.admin.ceremonial_inquiry', $data, function ($message) use ($adminEmail) {
                $message->to($this->adminEmail)->subject('New Ceremonial Inquiry Received');
            });
       
            Mail::send('email.front.ceremonial_inquiry', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Product Ceremonial send Successfully');
            });
        // } catch (Exception $e) {
        //     Log::error('Ceremonial Inquiry Mail sending failed: '.$e->getMessage());
        // }

        // SEND WHATSAPP MESSAGE TO ADMIN
        //$message = 'New Product inquiry is placed using email - '.$request->email;
        $message = "*New Ceremonial Inquiry Received* 🛒\n\n" .
            "*Name:* {$request->name}\n" .
            "*Email:* {$request->email}\n" .
            "*Contact No:* {$request->contact_no}\n" .
            "*Ceremonial:* {$ceremonial->title}\n" .
            "*Message:* " . ($request->message ?? 'N/A') . "\n\n" .
            "— HNoWW";

        //try {
            $url = 'https://wa.me/' . $this->adminWhatsappNo . '?text=' . urlencode($message);
            //return redirect()->away($url);
            return back()->with('whatsapp_url', $url);
        // } catch (Exception $e) {
        //     Log::error('Ceremonial Inquiry Whatsapp message sending failed: '.$e->getMessage());
        // }
        return back()->with('success', 'Your Ceremonial inquiry has been submitted successfully!');
    }

    public function getGiftShop(Request $request){
        $giftPrices = [];
        $allGifts = GiftShop::where('is_active', 0)->whereNull('deleted_at');
        if (request()->filled('gift_for') && request()->filled('gift_for') != '') {
            $allGifts->where('gift_for', request('gift_for'));
        }
        if (request()->filled('to_celebrate') && request()->filled('to_celebrate') != '') {
            $allGifts->where('to_celebrate', request('to_celebrate'));
        }
        if (request()->filled('gift_price_range')) {
            $range = request('gift_price_range');
            [$min, $max] = explode('-', $range);
            $min = (int) $min;
            $max = (int) $max;
            if ($max > 0) {
                $allGifts->whereBetween('product_price', [$min, $max]);
            } else {
                $allGifts->where('product_price', '>=', $min);
            }
        }
        $allGifts = $allGifts->get();
        if (request()->ajax()) {
            return view('front.partials.gift-list', compact('allGifts'))->render();
        }

        $giftProducts = GiftShop::select('id', 'product_name')->where('is_active', 0)->whereNull('deleted_at')->get();

        return view('front.giftshop', compact('allGifts', 'giftProducts'));
    }

    public function getBespokeCommission(){
        //$allProd = Product::isActive()->notDeleted()->get();
        //return view('front.bespoke-commission', compact('allProd'));
        return view('front.bespoke-commission');
    }

    public function getEverydaySacred(){
        return view('front.everyday_sacred');
    }

    public function getMemoryShelf(){
        return view('front.memory_shelf');
    }

    public function getModernMajilis(){
        return view('front.modern_majilis');
    }

    public function getArchitectStudy(){
        return view('front.architect_study');
    }

    public function getprivacy(){
        return view('front.privacy');
    }

    public function getRituals(){
        return view('front.rituals');
    }

     public function getAbout(){
        return view('front.about');
    }

    public function bespokeWeddingHampers(){
        return view('front.bespoke-wedding-hampers');
    }
    public function profile(){
        $user = User::where('id', auth()->id())->first();
        return view('front.profile', compact('user'));
    }
    


}
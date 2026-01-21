<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\RegistationController;
// use App\Http\Controllers\superAdminController;

use App\Http\Controllers\{FrontController};

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\{AdminController, CategoryController, ProductController, ProductTabController, ProductImageController, FaqController, JournalController, BlessingController, CeremonialController, GiftShopController, CorporateKitController};
use App\Http\Middleware\RedirectIfNotAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//FRONT ROUTE
Route::name('front.')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('list/{category_slug}', [FrontController::class, 'getList'])->name('list');
    Route::get('product-details/{product_slug}', [FrontController::class, 'getProductDetails'])->name('product.details');
    Route::post('store-product-inquiry', [FrontController::class, 'storeProductInquiry'])->name('store.product.inquiry');
    Route::post('/check-email-unique', [FrontController::class, 'checkEmailUnique'])
     ->name('check.email.unique');
    Route::post('/newsletter/store', [FrontController::class, 'storeNewsletterInquiry'])->name('newsletter.store');
    Route::get('/request-catalogue', [FrontController::class, 'getRequestCatalogue'])->name('request.catalogue');
    Route::post('store-request-catalogue', [FrontController::class, 'storeRequestCatalogue'])->name('store.request.catalogue');
    Route::get('/contact-us', [FrontController::class, 'getContactUs'])->name('contactus');
    Route::post('store-contact-inquiry', [FrontController::class, 'storeContactInquiry'])->name('store.contact.inquiry');
    Route::get('/faqs', [FrontController::class, 'getFaqs'])->name('faqs');
	Route::get('/journal', [FrontController::class, 'getJournal'])->name('journal');
	Route::get('/blessings-library/{blessings_of?}', [FrontController::class, 'getBlessings'])->name('blessings.library');
	Route::get('/blessings-detail/{blessings_of?}', [FrontController::class, 'blessingDetail'])->name('blessings.detail');
	Route::post('/gift-blessing', [FrontController::class, 'storeGiftBlessing'])->name('store.gift.blessing');

	Route::get('/atelier', [FrontController::class, 'getAtelier'])->name('atelier');
	Route::post('store-corporate-proposal-request', [FrontController::class, 'storeCorporateProposalRequest'])->name('store.corporate.proposal.request');
	Route::post('store-corporate-kit-request', [FrontController::class, 'storeCorporateKitRequest'])->name('store.corporate.kit.request');
    Route::post('store-wedding-catelogue-request', [FrontController::class, 'storeWeddingCatalogueRequest'])->name('store.wedding.catelogue.request');

	Route::get('/ceremonials', [FrontController::class, 'getCeremonials'])->name('ceremonials');
	Route::post('store-ceremonial-inquiry', [FrontController::class, 'storeCeremonialInquiry'])->name('store.ceremonial.inquiry');
	Route::get('/gift-shop', [FrontController::class, 'getGiftShop'])->name('giftshop');
    Route::get('gift-details/{product_slug}', [FrontController::class, 'getGiftDetails'])->name('gift.details');
	Route::get('/bespoke-commission', [FrontController::class, 'getBespokeCommission'])->name('bespoke.commission');
	Route::get('/privacy', [FrontController::class, 'getprivacy'])->name('privacy');

	//NOT VISIBLE DIRECTLY ON SITE IT VISIBLE TO ONLY VIP CLIENTS
    Route::get('/corporate-vault/{cat_slug?}', [FrontController::class, 'getCorporateVault'])->name('corporate.vault');
    Route::get('/wedding-vault', [FrontController::class, 'getWeddingVault'])->name('wedding.vault');
	Route::post('/wedding-vault/send-email', [FrontController::class, 'sendUnlockWeddingEmail'])->name('wedding-vault.send-email');
	Route::post('/wedding-vault/verify-otp', [FrontController::class, 'verifyWeddingVaultOtp'])->name('wedding-vault.verify-otp');
    Route::get('/wedding-vault-inside', [FrontController::class, 'getWeddingVaultInside'])->name('wedding.vault.inside');
    

	// NOT MADE DYNAMIC - START
	Route::get('/rituals', [FrontController::class, 'getRituals'])->name('rituals'); 
	Route::get('/bespoke-wedding-hampers', [FrontController::class, 'bespokeWeddingHampers'])->name('bespoke.wedding.hampers');

	Route::get('/everyday-sacred', [FrontController::class, 'getEverydaySacred'])->name('everyday-sacred'); 
	Route::get('/memory-shelf', [FrontController::class, 'getMemoryShelf'])->name('memory-shelf'); 
	Route::get('/modern-majilis', [FrontController::class, 'getModernMajilis'])->name('modern-majilis'); 
	Route::get('/architect-study', [FrontController::class, 'getArchitectStudy'])->name('architect-study'); 
	Route::get('/about', [FrontController::class, 'getAbout'])->name('about'); 


	// NOT MADE DYNAMIC - END

});
  
//Route::get('login', [dashboardController::class, 'login'])->name('login');
// Auth::routes();
// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/admin/dashboard',[dashboardController::class, 'admin'])->name('/admin/dashboard');
//     Route::get('/superAdmin', [superAdminController::class, 'superAdmin'])->name('superAdmin');  
//  	Route::get('/admin/dashboard', [adminController::class, 'admin'])->name('admin/dashboard');
//     Route::prefix('backend')->group(function () {
//         // Route::get('home', [adminController::class, 'index'])->name('home');
//     });
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ----------------------------------
//ADMIN ROUTES
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

   Route::middleware([RedirectIfNotAdmin::class])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [AdminController::class, 'adminProfile'])->name('profile');
		Route::post('profile/update', [AdminController::class, 'profileUpdate'])->name('profile.update');

        // PRODUCT CATEGORY
		Route::prefix('categories')->name('categories.')->group(function () {
			Route::get('/', [CategoryController::class, 'index'])->name('index');
			Route::get('/fetch', [CategoryController::class, 'getCategories'])->name('fetch');
			Route::get('/create', [CategoryController::class, 'create'])->name('create');
			Route::post('/store', [CategoryController::class, 'store'])->name('store');
			Route::get('/edit/{cat_id}', [CategoryController::class, 'edit'])->name('edit');
			Route::put('/update/{cat_id}', [CategoryController::class, 'update'])->name('update');
			Route::delete('/delete/{cat_id}', [CategoryController::class, 'delete'])->name('delete');
			Route::post('/update-status', [CategoryController::class, 'updateStatus'])->name('update.status');
		});

        //PRODUCT
        Route::prefix('products')->name('products.')->group(function () {
			Route::get('/', [ProductController::class, 'index'])->name('index');
			Route::get('/fetch', [ProductController::class, 'getProducts'])->name('fetch');
			Route::get('/create', [ProductController::class, 'create'])->name('create');
			Route::post('/store', [ProductController::class, 'store'])->name('store');
			Route::get('/edit/{product_id}', [ProductController::class, 'edit'])->name('edit');
			Route::put('/update/{product_id}', [ProductController::class, 'update'])->name('update');
			Route::delete('/delete/{product_id}', [ProductController::class, 'delete'])->name('delete');
			Route::post('/update-status', [ProductController::class, 'updateStatus'])->name('update.status');

			Route::post('delete-detail-image', [ProductController::class, 'deleteDetailImage'])->name('delete.detail.image');
			Route::post('delete-all-detail-images', [ProductController::class, 'deleteAllDetailImages'])->name('delete.alldetail.images');
		});

        //PRODCUCT TABS
        Route::prefix('product-tabs')->name('product-tabs.')->group(function () {
			Route::get('/', [ProductTabController::class, 'index'])->name('index');
			Route::get('/fetch', [ProductTabController::class, 'getProductTabs'])->name('fetch');
			Route::get('/create', [ProductTabController::class, 'create'])->name('create');
			Route::post('/store', [ProductTabController::class, 'store'])->name('store');
			Route::get('/edit/{product_id}', [ProductTabController::class, 'edit'])->name('edit');
			Route::post('/update/{product_id}', [ProductTabController::class, 'update'])->name('update');
			Route::delete('/delete/{product_id}', [ProductTabController::class, 'destroyByProduct'])->name('delete');
			Route::post('/update-status', [ProductTabController::class, 'updateStatus'])->name('update.status');
		});

        //PRODCUCT TABS
        Route::prefix('product-images')->name('product-images.')->group(function () {
			Route::get('/', [ProductImageController::class, 'index'])->name('index');
			Route::get('/fetch', [ProductImageController::class, 'getProductImages'])->name('fetch');
			Route::get('/create', [ProductImageController::class, 'create'])->name('create');
			Route::post('/store', [ProductImageController::class, 'store'])->name('store');
			Route::get('/edit/{product_id}', [ProductImageController::class, 'edit'])->name('edit');
			Route::put('/update/{product_id}', [ProductImageController::class, 'update'])->name('update');
			Route::delete('/delete/{product_id}', [ProductImageController::class, 'destroyByProduct'])->name('delete');
			Route::post('/update-status', [ProductImageController::class, 'updateStatus'])->name('update.status');
		});

		//FAQs
        Route::prefix('faqs')->name('faqs.')->group(function () {
            route::get('/' , [FaqController::class , 'index'])->name('index');
            route::get('/create' , [FaqController::class , 'create'])->name('create');
            route::post('/store' , [FaqController::class , 'store'])->name('store');
            route::get('/fetch' , [FaqController::class , 'getFaqs'])->name('fetch');
            route::get('/edit/{type_id}' , [FaqController::class , 'editFaqs'])->name('edit');
            route::post('/update/{type_id}' , [FaqController::class , 'updateFaqs'])->name('update');
            Route::delete('/delete/{type_id}', [FaqController::class, 'destroyByType'])->name('delete');
        });
		
		Route::resource('journals', JournalController::class);
		route::get('journal/fetch' , [JournalController::class , 'getJournals'])->name('journal.fetch');
		route::post('journal/update/status' , [JournalController::class , 'updateStatus'])->name('journal.update.status');

		Route::resource('blessings', BlessingController::class);
		route::get('blessing/fetch' , [BlessingController::class , 'getBlessings'])->name('blessing.fetch');
		route::post('blessing/update/status' , [BlessingController::class , 'updateStatus'])->name('blessing.update.status');

		Route::resource('ceremonials', CeremonialController::class);
		route::get('ceremonial/fetch' , [CeremonialController::class , 'getCeremonials'])->name('ceremonial.fetch');
		route::post('ceremonial/update/status' , [CeremonialController::class , 'updateStatus'])->name('ceremonial.update.status');

		Route::resource('giftshops', GiftShopController::class);
		route::get('giftshop/fetch' , [GiftShopController::class , 'getGifts'])->name('giftshop.fetch');
		route::post('giftshop/update/status' , [GiftShopController::class , 'updateStatus'])->name('giftshop.update.status');
		Route::post('gift/delete-detail-image', [GiftShopController::class, 'deleteGiftDetailImage'])->name('gift.delete.detail.image');
		Route::post('gift/delete-all-detail-images', [GiftShopController::class, 'deleteAllGiftDetailImages'])->name('gift.delete.alldetail.images');

		Route::resource('corporate-kits', CorporateKitController::class);
		route::get('corporate-kit/fetch' , [CorporateKitController::class , 'getCorporateKits'])->name('corporate-kit.fetch');
		route::post('corporate-kit/update/status' , [CorporateKitController::class , 'updateStatus'])->name('corporate-kit.update.status');


    });

});


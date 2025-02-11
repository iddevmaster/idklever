<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrganizController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Promotion;
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\PromotionController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| Fontend
|--------------------------------------------------------------------------
*/
// Route::get('/welcome', function () {
//     Auth::logout();
//     return view('welcome');
// });


// Landing page
Route::get('/', function (Request $request) {
    return view('landing_page');
})->middleware('track.visitors');
Route::view('/home', 'landing_page')->middleware('track.visitors');
Route::view('/promotions', 'portfolio')->middleware('track.visitors');
Route::view('/contacts', 'contacts')->middleware('track.visitors');
Route::view('/courses', 'products')->middleware('track.visitors');
Route::view('/blogs', 'blogs')->middleware('track.visitors');
Route::view('/aboutme', 'about')->middleware('track.visitors');
Route::get('/course/detail/{prod_id}', function ($prod_id) {
    $product = Product::find($prod_id);
    return view('product_detail', ['prod_id' => $prod_id, 'product' => $product]);
})->middleware('track.visitors');
Route::get('/blog/detail/{blog_id}', function ($blog_id) {
    $blog = Blog::find($blog_id);
    return view('blog_detail', ['blog_id' => $blog_id, 'blog' => $blog]);
})->middleware('track.visitors');
Route::get('/promotion/detail/{prom_id}', function ($prom_id) {
    $promotion = Promotion::find($prom_id);
    return view('promotion_detail', ['prom_id' => $prom_id, 'promotion' => $promotion]);
})->middleware('track.visitors');
Route::view('/services', 'services')->middleware('track.visitors');

Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);


// Switch Language
Route::get('/language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('switch-language');







/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::view('dashboard', 'dashboard')
        ->middleware('verified') // Specific middleware for this route
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');


    Route::get('/info', function () {
        phpinfo();
    });

    // Main Page Route
    Route::get('/admin', function () {
        return redirect()->route('dashboard-analytics');
    });
    Route::get('/admin/main', [Analytics::class, 'index'])->name('dashboard-analytics');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('dashboard-analytics');
    });

    // pages

        // Product
        Route::get('/admin/products', [ProductController::class, 'index'])->name('admin-products');
        Route::get('/admin/products/add', [ProductController::class, 'addProduct'])->name('add-products');
        Route::get('/admin/products/edit/{pid}', [ProductController::class, 'editProduct'])->name('edit-product');
        Route::post('/admin/products/store', [ProductController::class, 'storeProduct'])->name('store-product');
        Route::post('/admin/products/update/{pid}', [ProductController::class, 'updateProduct'])->name('update-product');
        Route::post('/admin/products/category/add', [ProductController::class, 'addCate'])->name('add-product-cate');
        Route::get('/admin/products/del/{pid}', [ProductController::class, 'delProduct'])->name('del-product');

        // News
        Route::get('/admin/news', [NewsController::class, 'index'])->name('admin-news');
        Route::get('/admin/news/add', [NewsController::class, 'addNews'])->name('add-news');
        Route::get('/admin/news/edit/{bid}', [NewsController::class, 'editNews'])->name('edit-news');
        Route::post('/admin/news/store', [NewsController::class, 'storeNews'])->name('store-news');
        Route::post('/admin/news/update/{bid}', [NewsController::class, 'updateNews'])->name('update-news');
        Route::get('/admin/news/del/{bid}', [NewsController::class, 'delNews'])->name('del-news');

        // Promotion
        Route::get('/admin/promotion', [PromotionController::class, 'index'])->name('admin-promotion');
        Route::get('/admin/promotion/add', [PromotionController::class, 'addPromotion'])->name('add-promotion');
        Route::get('/admin/promotion/edit/{bid}', [PromotionController::class, 'editPromotion'])->name('edit-promotion');
        Route::post('/admin/promotion/store', [PromotionController::class, 'storePromotion'])->name('store-promotion');
        Route::post('/admin/promotion/update/{bid}', [PromotionController::class, 'updatePromotion'])->name('update-promotion');
        Route::get('/admin/promotion/del/{bid}', [PromotionController::class, 'delPromotion'])->name('del-promotion');

        // Activity
        Route::get('/admin/activities', [ActivityController::class, 'index'])->name('admin-activities');
        Route::get('/admin/activity/add', [ActivityController::class, 'addActivity'])->name('add-activity');
        Route::post('/admin/activity/store', [ActivityController::class, 'storeActivity'])->name('store-activity');
        Route::post('/admin/activity/update/{aid}', [ActivityController::class, 'updateActivity'])->name('update-activity');
        Route::get('/admin/activity/edit/{aid}', [ActivityController::class, 'editActivity'])->name('edit-activity');
        Route::get('/admin/activity/del/{aid}', [ActivityController::class, 'delActivity'])->name('delete-activity');
        Route::get('/admin/activity/{aid}/delete/media/{delmedia}', [ActivityController::class, 'delMedia'])->name('delete-media');

        // Account
        Route::get('/admin/account-setting', [AccountController::class, 'index'])->name('admin-account-setting');
        Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('update-profile');
        Route::post('/update-account', [AccountController::class, 'updateAccount'])->name('update-account');

        // Organization
        Route::get('/admin/organization', [OrganizController::class, 'index'])->name('admin-organization');
        Route::post('/admin/organization/add', [OrganizController::class, 'addAgn']);
        Route::post('/admin/organization/delete', [OrganizController::class, 'deleteData']);

        // Contacts
        Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin-contacts');

    // Log out
    Route::get('/admin/logout', function () {
        Auth::logout();
        return redirect('login');
    });

    Route::get('/admin/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
    Route::get('/admin/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
    Route::get('/admin/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
    Route::get('/admin/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
    Route::get('/admin/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

    // authentication
    Route::get('/admin/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
    Route::get('/admin/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
    Route::get('/admin/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

    // cards
    Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

    // User Interface
    Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
    Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
    Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
    Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
    Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
    Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
    Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
    Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
    Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
    Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
    Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
    Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
    Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
    Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
    Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
    Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
    Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
    Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
    Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

    // extended ui
    Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
    Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

    // icons
    Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

    // form elements
    Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
    Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

    // form layouts
    Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
    Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

    // tables
    Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;

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

Route::get('test',function (){
//    Config::set('services.mailgun.domain','auvi@auvi.com');
//    dd(Config::get('services.facebook.client_id'));

});

Route::fallback(function (){
    return abort(404);
});

Route::get('clear',function (){
    \Artisan::call('view:clear');
    \Artisan::call('config:cache');
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');


});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([

    'register'=> app_settings()->user_register,
    'verify' => Config::get('USER_REGISTER'),
]);

Route::get('logout',function (){
    auth()->logout();
    return redirect('/');
})->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('login/{provider}', 'Auth\RegisterController@redirectToProvider')->name('login.provider');
Route::get('login/{provider}/callback', 'Auth\RegisterController@handleProviderCallback')->name('login.callback');


//....... Admin Routes .......



Route::group(['prefix'=>'web_admin'],function (){

    //    .... Inside Admin Folder Controllers ....
    Route::namespace('Admin')->group(function (){

        // .... Admin Protected Pages ........

        Route::group(['middleware'=>'auth'],function(){
//             ......... Admin Middleware .......
            Route::group(['middleware'=>'admin'],function (){

                Route::get('admin/dashboard',[
                    'uses'=>'AdminController@index',
                    'as'=>'admin.dashboard'
                ]);
                Route::resource('settings','SettingsController');

                Route::post('social/settings/{id}',[
                    'uses'=> 'SettingsController@socialUpdate',
                    'as'=> 'admin_social.update'
                ]);
                Route::post('social-login/settings/update',[
                    'uses'=> 'SettingsController@socialEdit',
                    'as'=> 'admin_social.edit'
                ]);
                Route::get('logo/settings',[
                    'uses'=> 'SettingsController@logo',
                    'as'=> 'settings.logo'
                ]);
                Route::post('logo/settings/update/{id}',[
                    'uses'=> 'SettingsController@logoUpdate',
                    'as'=> 'logo.update'
                ]);

                Route::get('language/settings',[
                    'uses'=> 'LanguageController@index',
                    'as'=> 'language'
                ]);
                Route::post('language/settings/store',[
                    'uses'=> 'LanguageController@store',
                    'as'=> 'language.store'
                ]);
                Route::post('language/settings/update',[
                    'uses'=> 'LanguageController@update',
                    'as'=> 'language.update'
                ]);
                Route::post('language/delete',[
                    'uses'=> 'LanguageController@destroy',
                    'as'=> 'language.delete'
                ]);
                Route::get('settings/language/show/{id}',[
                    'uses'=> 'LanguageController@show',
                    'as'=> 'language.show'
                ]);
                Route::post('language/key/{id}',[
                    'uses'=> 'LanguageController@langKey',
                    'as'=> 'lang.key'
                ]);

                // ...... Category ....

                Route::resource('category','CategoryController')->except('destroy','update');

                Route::post('category/update',[
                    'uses'=> 'CategoryController@update',
                    'as'=> 'category.update'
                ]);

                Route::post('category/delete',[
                    'uses'=> 'CategoryController@destroy',
                    'as'=> 'category.destroy'
                ]);

                // ... Tag ...

                Route::resource('tags','TagController')->except('update','destroy');

                Route::post('tags/update',[
                    'uses'=> 'TagController@update',
                    'as'=> 'tag.update'
                ]);


                // ... Blog ...

                Route::resource('posts','PostsController')->except('destroy');
                Route::post('post/delete',[
                    'uses'=> 'PostsController@destroy',
                    'as'=> 'posts.destroy'
                ]);

                // .... Products ...

                Route::resource('products','ProductsController')->except('destroy');

                Route::post('product/destroy',[
                    'uses'=> 'ProductsController@destroy',
                    'as'=> 'product.destroy'
                ]);

                Route::get('product/excel/output',[
                    'uses'=> 'ProductsController@export',
                    'as'=> 'product.export'
                ]);
                Route::post('product/excel/upload',[
                    'uses'=> 'ProductsController@excelUpload',
                    'as'=> 'product.upload'
                ]);

                Route::get('product_custom_search',[
                    'uses' => 'ProductsController@custom_search',
                    'as' => 'admin.product_search'
                ]);



                // .... Fronted ...

                Route::resource('frontend','FrontendController');

                Route::get('frontend-manager/blogs',[
                    'uses'=>  'FrontendController@blog',
                    'as'=> 'frontend.blog'
                ]);
                Route::post('frontend/blogs/delete',[
                    'uses'=> 'FrontendController@destroy',
                    'as'=> 'frontend.destroy'
                ]);

                // ... Users Controller

                Route::resource('users','UsersController')->except(['create']);
                Route::get('active/users','UsersController@active')->name('users.active');
                Route::get('banned/users','UsersController@banned')->name('users.banned');
                Route::get('email/unverified/users','UsersController@email_unverified')->name('users.unverified');
                Route::get('email/availability/check','UsersController@availablityCheck');

                // ... Login History Controller

                Route::resource('login-history','LoginHistoryController')->except('destroy');

                Route::post('login-history/delete','LoginHistoryController@destroy')->name('login-history.destroy');

                // Email Manager

                Route::resource('email-manager','EmailManagerController')->except(['edit','destroy']);
                Route::post('email-manager/template_edit/{id}',[
                    'uses'=> 'EmailManagerController@edit',
                    'as'=> 'email.design'
                ]);
                Route::get('save-template/email-manager',[
                    'uses' => 'EmailManagerController@template',
                    'as'=> 'admin.emailTemplate'
                ]);
                Route::post('store-template',[
                    'uses' => 'EmailManagerController@store',
                    'as'=> 'admin.template-store'
                ]);
                Route::get('email-manager-draft/edit/{id}',[
                    'uses'=> 'EmailManagerController@draftEdit',
                    'as' => 'email.draftEdit'
                ]);
                Route::post('email-manager-draft/update/{id}',[
                    'uses'=> 'EmailManagerController@draftUpdate',
                    'as' => 'email.draftUpdate'
                ]);
                Route::post('delete-template',[
                    'uses' => 'EmailManagerController@destroy',
                    'as'=> 'admin.templateDestroy'
                ]);
                Route::post('send-email/users',[
                    'uses'=> 'EmailManagerController@sendMail',
                    'as' => 'send.mail'
                ]);
                Route::get('email/to-all/users',[
                    'uses'=> 'EmailManagerController@allMailView',
                    'as' => 'all.mail'
                ]);
                Route::post('sending-email-to-all',[
                    'uses'=> 'EmailManagerController@allMailSend',
                    'as' => 'sendmail.all'
                ]);
                Route::get('sending-email-using-template/email/{id}',[
                    'uses'=> 'EmailManagerController@usingTemplate',
                    'as'=> 'using.template'
                ]);

                // Payment Controllers
                Route::resource('payments','PaymentMethodController');

                //Support Tickets Controller

                Route::get('supports',[
                    'uses'=> 'SupportTicketController@index',
                    'as'=> 'admin.support_index'
                ]);
                Route::post('supports/ticket/delete',[
                    'uses'=> 'SupportTicketController@destroy',
                    'as'=> 'admin.support_delete'
                ]);
                Route::get('supports/ticket/{id}',[
                    'uses'=> 'SupportTicketController@show',
                    'as'=> 'admin.support_show'
                ]);
                Route::get('supports/ticket/get_chat/{id}','SupportTicketController@get_chat');
                Route::get('supports/ticket/get_chat/{id}',[
                    'uses'=> 'SupportTicketController@get_chat',
                    'as'=> 'admin.support_get_chat'
                ]);

                Route::post('supports/ticket/chat/{id}',[
                    'uses'=> 'SupportTicketController@chat',
                    'as' => 'admin.chat_send'
                ]);
                Route::get('supports/ticket/get_chat_attachments/{id}','SupportTicketController@get_chat_attach');
                Route::get('supports/ticket/get_chat_attachments/{id}',[
                    'uses'=> 'SupportTicketController@get_chat_attach'
                ]);
                Route::post('supports/ticket/let-it-open',[
                    'uses'=> 'SupportTicketController@open',
                    'as'=> 'admin.support.open'
                ]);
                Route::post('supports/ticket/let-it-close',[
                    'uses'=> 'SupportTicketController@closed',
                    'as'=> 'admin.support.closed'
                ]);

                // Add Role

                Route::post('add-role',[
                    'uses'=> 'SettingsController@addRole',
                    'as' => 'admin.add-role'
                ]);

                // Permission

                Route::get('permission-settings',[
                    'uses'=>'SettingsController@permShow',
                    'as'=> 'admin.perm_show'
                ]);

                Route::get('permission-settings/{id}',[
                    'uses'=>'SettingsController@permSet',
                    'as'=> 'admin.perm_set'
                ]);
                Route::post('permission-settings-update/{role}',[
                    'uses'=> 'SettingsController@permUpdate',
                    'as'=> 'admin.perm_update'
                ]);

                //Orders

                Route::get('orders',[
                    'uses'=> 'OrderController@index',
                    'as'=> 'admin.order_show'
                ]);
                Route::get('orders/completed',[
                    'uses' => 'OrderController@completed_order',
                    'as'=> 'admin.completed_order'
                ]);
                Route::post('orders/approve',[
                    'uses' => 'OrderController@approve',
                    'as'=> 'admin.order_approve'
                ]);
                Route::post('orders/cancel',[
                    'uses' => 'OrderController@cancel',
                    'as'=> 'admin.order_cancel'
                ]);
                Route::get('orders/cancelled',[
                    'uses' => 'OrderController@cancelled_order',
                    'as'=> 'admin.order_cancelled'
                ]);
                Route::post('orders/delete',[
                    'uses' => 'OrderController@destroy',
                    'as'=> 'admin.order_destroy'
                ]);

                //Subscribers
                Route::get('subscribers',[
                    'uses'=> 'SubscribersController@index',
                    'as'=> 'admin.subscribers'
                ]);







            });

        });

    });





});


// For General Users
Route::get('pay-test','PaymentsController@index');
Route::post('pay-with-paypal','PaymentsController@pay_by_paypal')->name('paypal.pay');
Route::post('payment-execute','PaymentsController@execute_payment')->name('paypal.execute');
Route::post('pay-with-stripe','PaymentsController@pay_by_stripe')->name('stripe.pay');
Route::get('pay-with-sslcom','PaymentsController@pay_by_sslcom');

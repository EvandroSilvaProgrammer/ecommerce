<?php

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

use App\Mail\sendEmailAdmin;
use App\Mail\SendEmailCompra;
use App\Mail\SendEmailConfirm;
use App\Mail\SendEmailFinal;
use App\Mail\SendEmailNewClient;
use App\Models\Client;
use App\Models\ClientContact;
use App\Models\User;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// STORAGE LINK COMMAND

/*
Route::get('storage-link', function(){
    if (file_exists(public_path('storage'))) {
            return 'The "public/storage" directory already exists.';
        }

        app('files')->link(
            storage_path('app/public'), public_path('storage')
        );

        return 'The [public/storage] directory has been linked.';
});

*/

/*-------------------------------------------*/
/*              SITES ROUTES                 */
/*-------------------------------------------*/

   /* Route::group(['middleware' => 'stats'], function ()
    { */
        //Route::get('/home', 'HomeController@index')->name('home');

        Route::any('livros/pesquisa', 'Site\ProductController@personalizedQuery')
        ->name('products.personalizedQuery');

        Route::any('livros/categoria/pesquisa', 'Site\CategorieProductController@personalizedQueryCategorie')
        ->name('products.categorie.personalizedQuery');

        Route::any('livros/subcategoria/pesquisa', 'Site\SubCategorieProductController@personalizedQuerysubcategorie')
        ->name('products.subcategorie.personalizedQuery');

        Route::get('/', 'Site\HomeController@showHome')->name('products.showHome');

        Route::get('livros', 'Site\ProductController@index')->name('products.index');
        Route::get('livros/{id}', 'Site\ProductController@show')->name('product.show');

        Route::get('livros/categoria/{id}', 'Site\CategorieProductController@show')->name('categorie.show');

        Route::get('livros/subcategoria/{id}', 'Site\SubCategorieProductController@show')->name('subcategorie.show');

        Route::get('servicos', 'Site\ServiceController@index')->name('services.index');
        Route::get('servicos/{id}', 'Site\ServiceController@show')->name('service.show');

        Route::get('promocoes', 'Site\PromotionController@index')->name('promotion.index');

        Route::get('cliente/registro', 'Site\ClientLoginController@showRegister')->name('client.showRegister');
        Route::post('cliente/terminar_registro', 'Site\ClientLoginController@register')->name('client.register');
        Route::post('cliente/actualizar', 'Site\ClientLoginController@updateRegister')->name('client.updateRegister');

        Route::get('cliente/perfil', 'Site\ClientLoginController@profileClient')->name('client.profile');
        Route::PUT('cliente/perfil/actualizar', 'Site\ClientLoginController@updateClient')->name('client.profile.update');


        Route::get('cliente/registro/cancel', function(){
        return redirect()->route('home');
            //return redirect()->route('admim.promotion.index');
        })->name('client.register.cancel');

        //Pegar Municípios relacionados a uma província
        Route::get('cliente/municipios/{id}', 'Site\ClientLoginController@getDistricts');

        // //Pegar Marcas relacionadas a uma sub-categoria EDIT
        // Route::get('administracao/especialidades/{id}', 'Admim\ProductController@getBrandsAdd');

        // //Pegar Marcas relacionadas a uma sub-categoria ADD
        // Route::get('administracao/livros/{outro}/especialidades/{id}', 'Admim\ProductController@getBrandsEdit');

        Route::get('cliente/login', 'Site\ClientLoginController@showLogin')->name('client.showLogin');
        Route::post('cliente/login', 'Site\ClientLoginController@login')->name('client.login');
        Route::get('cliente/logout', 'Site\ClientLoginController@logout')->name('client.logout');

        Route::get('/carrinho', 'Site\ShopCartController@index')->name('shopCart.index');

        Route::get('/carrinho/adicionar', function(){
            return redirect()->back();
        });

        Route::post('carrinho/adicionar', 'Site\ShopCartController@store')->name('shopCart.store');
        Route::post('carrinho/actualizarQtd', 'Site\ShopCartController@updateQtd')->name('shopCart.updateQtd');

        Route::post('carrinho/cancelar', 'Site\ShopCartController@cancel')->name('shopCart.cancel');
        Route::delete('carrinho/remover', 'Site\ShopCartController@destroy')->name('shopCart.destroy');

        Route::get('carrinho/adicionar/qtd/{productid}/{color}/{status}', 'Site\ShopCartController@upQtd')->name('shopCart.upQtd');
        Route::get('carrinho/diminuir/qtd/{productid}/{color}/{status}', 'Site\ShopCartController@downQtd')->name('shopCart.downQtd');


        Route::get('/carrinho/concluir', function(){
            return redirect()->back();
        });
        Route::post('carrinho/concluir', 'Site\ShopCartController@toEnd')->name('shopCart.toEnd');

        Route::get('carrinho/compras', 'Site\ShopCartController@purchases')->name('shopCart.purchases');
        Route::get('carrinho/checkout', 'Site\ShopCartController@checkout')->name('shopCart.checkout');
        Route::POST('carrinho/checkout', 'Site\ShopCartController@checkout')->name('shopCart.checkoutPOST');

        //Pegar Municípios relacionados a uma província
        Route::get('carrinho/municipios/{id}', 'Site\ClientLoginController@getDistricts');

        /*-------------------------------------CARRINHO COM SESSÃO--------------------------------------------------------------*/

            Route::get('producto/sessao/exclusao/{chave}', 'Site\ShopCartController@sessionDestroy')->name('cart.session.destroy');

        /*---------------------------------------------------------------------------------------------------------------------*/


    //});

    Route::get('/stats-today', 'Admim\StatisticsController@visitsToday')->name('stats.visitsToday');
    Route::get('/stats-month', 'Admim\StatisticsController@visitsInMonth');
    Route::get('/stats-year', 'Admim\StatisticsController@visitsInYear');
    Route::get('/stats/{column}/{date?}/{limit?}', 'Admim\StatisticsController@columnStats');


    /*-----------------------------EMAIL DE EFECTIVAÇÃO DE COMPRA------------------------------------------------------------------------*/

    Route::get('sendEmail/{idRequest}', function($idRequest) {

        // $user = new stdClass();
        $user = Client::find(Auth::guard('client')->id());

        $admin = new stdClass();
        $admin->name = 'Doriema Online';
        $admin->email = 'info@doriema.com';

        Mail::send(new sendEmailAdmin($admin, $idRequest)); // Envio de email para o Admin (app/Mail/SendEmailAdmin)
        Mail::send(new SendEmailCompra($user, $idRequest));// Envio de email para o Cliente (app/Mail/SendEmailCompra)

        return redirect()->route('shopCart.purchases');

        // return (new SendEmailCompra($user, $idRequest));


    })->name('sendEmail.Compra');

    /*-----------------------------------------------------------------------------------------------------------------------------------*/

    /*-----------------------------EMAIL PARA NOVOS CLIENTES------------------------------------------------------------------------*/

    //Envio de emails para novos clientes
    Route::get('emailNewClient', function() {
        $client = Client::find(Auth::guard('client')->id());

        Mail::send(new SendEmailNewClient($client));


        return redirect()->route('products.showHome');


    })->name('sendEmail.newClient');

    /*-----------------------------------------------------------------------------------------------------------------------------------*/


    /*-----------------------------EMAIL PARA CONFIRMAÇÃO DE PAGAMENTO-------------------------------------------------------------------*/

    //Envio de emails para confirmação de pagamento
    Route::get('emailConfirm/{idReq}', function($idReq) {


        Mail::send(new SendEmailConfirm($idReq));

        return redirect()->back();


    })->name('sendEmail.Confirm');

    /*-----------------------------------------------------------------------------------------------------------------------------------*/


    /*-----------------------------EMAIL PARA CONFIRMAR ENTREGA-------------------------------------------------------------------*/

    //Envio de emails para confirmação de pagamento
    Route::get('emailFinal/{idReq}', function($idReq) {


        Mail::send(new SendEmailFinal($idReq));

        return redirect()->back();


    })->name('sendEmail.Final');

    /*-----------------------------------------------------------------------------------------------------------------------------------*/



    /*-----------------------------NEWSLLETER------------------------------------------------------------------------*/
    Route::post('newslletter', 'Site\NewsletterController@store')
        ->name('newslleter.store');


    /*-----------------------------SOBRE NÓS -- SITE ------------------------------------------------------------------------*/
    Route::get('sobrenos', 'Site\AboutDoriema@index')->name('aboutUs.info');

    /*-----------------------------TERMOS E POLITICAS -- SITE ------------------------------------------------------------------------*/
    Route::get('termosecondicoes', 'Site\TermosController@index')->name('terms.info');


    // Route::get('/', 'Site\AutoCompleteController@index');

   Route::post('/search/site', 'Site\AutoCompleteController@fetch')->name('site.search.product');
   Route::any('/pesquisar/livro', 'Site\AutoCompleteController@search')->name('site.search');

    /*-----------------------------PDF REQUESTS REPORTS------------------------------------------------------------------------*/
        Route::get('pedido/factura/{request_id}/{total_request}', 'Site\FacturaController@clientPF')
        ->name('site.Reportsrequest.clientPF');

        Route::get('pedido/factura/{total_request}', 'Site\FacturaController@visitantePF')
        ->name('site.Reportsrequest.visitantePF');
    /*-----------------------------------------------------------------------------------------------------------------------------*/


/*---------------------------------------------*/



/*----------------------------------------------------------------------------------------------------*/
/*                                       ADMIM ROUTES                                                */
/*---------------------------------------------------------------------------------------------------*/

    Route::get('administracao', 'Admim\AccessController@home')->name('admim');

    Route::get('administracao/login', 'Admim\AccessController@showLogin')->name('admim.showLogin');

    Route::post('administracao/login', 'Admim\AccessController@login')->name('admim.login');

    Route::get('administracao/logout', 'Admim\AccessController@logout')->name('admim.logout');

    Route::get('administracao/usuarios/perfil', 'Admim\UserController@profile')
    ->name('admim.users.profile')->middleware('auth');

    Route::PUT('administracao/usuarios/perfil/actualizar', 'Admim\UserController@updateProfile')
    ->name('admim.users.profileUpdate')->middleware('auth');

    /*----------------------------------------USERS-----------------------------------------------------------*/
        //Create
        Route::post('administracao/usuarios', 'Admim\UserController@store')
        ->name('admim.users.store')->middleware('auth');

        //Read
        Route::get('administracao/usuarios', 'Admim\UserController@index')
        ->name('admim.users.index')->middleware('auth');

        Route::get('administracao/usuarios/{id}', 'Admim\UserController@show')
        ->name('admim.users.show')->middleware('auth');

        //Update
        Route::put('administracao/usuarios/{id}', 'Admim\UserController@update')
        ->name('admim.users.update')->middleware('auth');

        Route::get('administracao/usuarios/{id}/edit', 'Admim\UserController@edit')
        ->name('admim.users.edit')->middleware('auth');

        //Delete
        Route::get('administracao/usuarios/{id}/remove', 'Admim\UserController@destroy')
        ->name('admim.users.destroy')->middleware('auth');

        /*----------------------------------------ROLE_USER-----------------------------------------------------------*/
            //Create
            Route::post('administracao/funcoes_usuarios', 'Admim\RoleUserController@store')
            ->name('admim.rolesUsers.store')->middleware('auth');

            //Delete
            Route::get('administracao/funcoes_usuarios/{id}/remove', 'Admim\RoleUserController@destroy')
            ->name('admim.rolesUsers.destroy')->middleware('auth');
        /*---------------------------------------------------------------------------------------------------------*/

        /*----------------------------------------ROLES-----------------------------------------------------------*/
            //Create
            Route::post('administracao/funcoes', 'Admim\RoleController@store')
            ->name('admim.roles.store')->middleware('auth');


            //Read
            Route::get('administracao/funcoes', 'Admim\RoleController@index')
            ->name('admim.roles.index')->middleware('auth');

            Route::get('administracao/funcoes/{id}', 'Admim\RoleController@show')
            ->name('admim.roles.show')->middleware('auth');

            //Update
            Route::put('administracao/funcoes/{id}', 'Admim\RoleController@update')
            ->name('admim.roles.update')->middleware('auth');

            Route::get('administracao/funcoes/{id}/edit', 'Admim\RoleController@edit')
            ->name('admim.roles.edit')->middleware('auth');

            //Delete
            Route::get('administracao/funcoes/{id}/remove', 'Admim\RoleController@destroy')
            ->name('admim.roles.destroy')->middleware('auth');
        /*---------------------------------------------------------------------------------------------------------*/

        /*----------------------------------------PERMISSION_ROLE-----------------------------------------------------------*/
            //Create
            Route::post('administracao/permissao_funcao', 'Admim\PermissionRoleController@store')
            ->name('admim.permissionRole.store')->middleware('auth');

            //Delete
            Route::get('administracao/permissao_funcao/{id}/remove', 'Admim\PermissionRoleController@destroy')
            ->name('admim.permissionRole.destroy')->middleware('auth');
        /*---------------------------------------------------------------------------------------------------------*/

    /*---------------------------------------------------------------------------------------------------------*/



    /*----------------------------------------REQUESTS-----------------------------------------------------------*/
        //Create
        Route::post('administracao/pedidos', 'Admim\RequestController@store')
        ->name('admim.request.store')->middleware('auth');

        //Read
        Route::get('administracao/novos_pedidos', 'Admim\RequestController@news')
        ->name('admim.request.news')->middleware('auth');

        Route::get('administracao/pedidos_cancelados', 'Admim\RequestController@canceled')
        ->name('admim.request.canceled')->middleware('auth');

        Route::get('administracao/pedidos_pagos', 'Admim\RequestController@pay')
        ->name('admim.request.pay')->middleware('auth');

        Route::get('administracao/pedidos_entregues', 'Admim\RequestController@delivery')
        ->name('admim.request.delivery')->middleware('auth');

        Route::get('administracao/pedido/{id}', 'Admim\RequestController@show')
        ->name('admim.request.show')->middleware('auth');

        Route::get('administracao/relatorios', 'Admim\RequestController@reports')
        ->name('admim.request.reports')->middleware('auth');

        //Update
        Route::get('administracao/actualizar/pedido/{id}', 'Admim\RequestController@update')
        ->name('admim.request.update')->middleware('auth');

        Route::get('administracao/confirmarentrega/pedido/{id}', 'Admim\RequestController@confirmDelivery')
        ->name('admim.request.confirmDelivery')->middleware('auth');

        //Delete
        Route::get('administracao/pedidos/{id}/remove', 'Admim\RequestController@destroy')
        ->name('admim.request.destroy')->middleware('auth');

        /*-----------------------------REQUESTS REPORTS-----------------------------------------------------------*/

            /*-----------------------------EXCEL REQUESTS REPORTS------------------------------------------------------------------------*/
                Route::get('administracao/pedidos/relatorios/todos/excel', 'Admim\ReportsRequestsController@allRequestsExcel')
                ->name('admim.Reportsrequest.allRequestsExcel')->middleware('auth');

                Route::get('administracao/pedidos/relatorios/encomendados/excel', 'Admim\ReportsRequestsController@orderedRequestsExcel')
                ->name('admim.Reportsrequest.orderedRequestsExcel')->middleware('auth');

                Route::get('administracao/pedidos/relatorios/entregues/excel', 'Admim\ReportsRequestsController@deliveryRequestsExcel')
                ->name('admim.Reportsrequest.deliveryRequestsExcel')->middleware('auth');

                Route::get('administracao/pedidos/relatorios/cancelados/excel', 'Admim\ReportsRequestsController@canceledRequestsExcel')
                ->name('admim.Reportsrequest.canceledRequestsExcel')->middleware('auth');
            /*-------------------------------------------------------------------------------------------------------------------------*/

            /*-----------------------------PDF REQUESTS REPORTS------------------------------------------------------------------------*/
                Route::get('administracao/pedidos/relatorios/todos/PDF', 'Admim\ReportsRequestsController@allRequestsPDF')
                ->name('admim.Reportsrequest.allRequestsPDF')->middleware('auth');

                Route::get('administracao/pedidos/relatorios/encomendados/PDF', 'Admim\ReportsRequestsController@orderedRequestsPDF')
                ->name('admim.Reportsrequest.orderedRequestsPDF')->middleware('auth');

                Route::get('administracao/pedidos/relatorios/entregues/PDF', 'Admim\ReportsRequestsController@deliveryRequestsPDF')
                ->name('admim.Reportsrequest.deliveryRequestsPDF')->middleware('auth');

                Route::get('administracao/pedidos/relatorios/cancelados/PDF', 'Admim\ReportsRequestsController@canceledRequestsPDF')
                ->name('admim.Reportsrequest.canceledRequestsPDF')->middleware('auth');
            /*-------------------------------------------------------------------------------------------------------------------------*/

            /*-----------------------------PDF REQUESTS REPORTS------------------------------------------------------------------------*/
                Route::post('administracao/pedidos/relatorios/personalizados', 'Admim\ReportsRequestsController@personalizedRequests')
                ->name('admim.Reportsrequest.personalizedRequests')->middleware('auth');
            /*-------------------------------------------------------------------------------------------------------------------------*/

            /*-----------------------------REQUESTPRODUCTS REPORTS------------------------------------------------------------------------*/
                Route::post('administracao/pedidoindividual/relatorio', 'Admim\ReportsRequestsController@requestProducts')
                ->name('admim.ReportsRequestProducts.requestProducts')->middleware('auth');
            /*-------------------------------------------------------------------------------------------------------------------------*/



        /*----------------------------------------------------------------------------------------------------------------------------*/



    /*---------------------------------------------------------------------------------------------------------*/


    /*-----------------------------PRODUCTS-----------------------------------------------------------*/
        //Create
        Route::get('administracao/livros/create', 'Admim\ProductController@create')
        ->name('admim.products.create')->middleware('auth');;

        Route::post('administracao/livros', 'Admim\ProductController@store')
        ->name('admim.products.store')->middleware('auth');;

        //Read
        Route::get('administracao/livros', 'Admim\ProductController@index')
        ->name('admim.products.index')->middleware('auth');

        Route::get('administracao/livros/{id}', 'Admim\ProductController@show')
        ->name('admim.products.show')->middleware('auth');;

        //Update
        Route::put('administracao/livros/{id}', 'Admim\ProductController@update')
        ->name('admim.products.update');

        Route::get('administracao/livros/{id}/edit', 'Admim\ProductController@edit')
        ->name('admim.products.edit');

        //Delete
        Route::get('administracao/livros/{id}/remove', 'Admim\ProductController@destroy')
        ->name('admim.products.destroy');

        //Colocar produto online
        Route::get('administracao/livros/{id}/online', 'Admim\ProductController@online')
        ->name('admim.product.online');

        Route::get('administracao/livros/{id}/offline', 'Admim\ProductController@offline')
        ->name('admim.product.offline');

        /*-----------------------------DETAILS PRODUCTS-----------------------------------------------------------*/
            //Create
            Route::post('administracao/livros/{id}/adicionardetalhes', 'Admim\DetailController@store')
            ->name('admim.products.addDetail.store');

            //DELETE
            Route::get('administracao/livros/{image}/removerdetalhes', 'Admim\DetailController@destroy')
            ->name('admim.products.addDetail.destroy');
        /*---------------------------------------------------------------------------------------------------------*/




        /*-----------------------------EXTRA IMAGES-----------------------------------------------------------*/
            //Create
            Route::post('administracao/livros/{id}/adicionarimagem', 'Admim\ExtraImagesController@store')
            ->name('admim.products.addImage.store');

            //DELETE
            Route::get('administracao/livros/{image}/removerimagem', 'Admim\ExtraImagesController@destroy')
            ->name('admim.products.addImage.destroy');
        /*---------------------------------------------------------------------------------------------------------*/

        /*-----------------------------PRODUCTS COLOR-----------------------------------------------------------*/
            //Create
            Route::post('administracao/livro', 'Admim\ProductColorController@store')
            ->name('admim.productColors.store');

            //Delete
            Route::get('administracao/livro/{id}/remove', 'Admim\ProductColorController@destroy')
            ->name('admim.productColors.destroy');
        /*---------------------------------------------------------------------------------------------------------*/


        /*-----------------------------CATEGORIES PRODUCTS-----------------------------------------------------------*/
            //Create
            Route::post('administracao/categoriaslivros', 'Admim\ProductCategorieController@store')
            ->name('admim.productCategories.store');

            //Read
            Route::get('administracao/categoriaslivros', 'Admim\ProductCategorieController@index')
            ->name('admim.productCategories.index');

            //Update
            Route::put('administracao/categoriaslivros/{id}', 'Admim\ProductCategorieController@update')
            ->name('admim.productCategories.update');

            Route::get('administracao/categoriaslivros/{id}/edit', 'Admim\ProductCategorieController@edit')
            ->name('admim.productCategories.edit');

            //Delete
            Route::get('administracao/categoriaslivros/{id}/remove', 'Admim\ProductCategorieController@destroy')
            ->name('admim.productCategories.destroy');
        /*---------------------------------------------------------------------------------------------------------*/

        /*----------------------------- PRODUCTS SUB-CATEGORIES -----------------------------------------------------------*/
            //Create
            Route::post('administracao/subcategoriaslivros', 'Admim\ProductSubCategorieController@store')
            ->name('admim.productSubCategories.store');

            //Read
            Route::get('administracao/subcategoriaslivros', 'Admim\ProductSubCategorieController@index')
            ->name('admim.productSubCategories.index');

            //Show
            Route::get('administracao/subcategoriaslivros/{id}', 'Admim\ProductSubCategorieController@show')
            ->name('admim.productSubCategories.show');


            //Update
            Route::put('administracao/subcategoriaslivros/{id}', 'Admim\ProductSubCategorieController@update')
            ->name('admim.productSubCategories.update');

            Route::get('administracao/subcategoriaslivros/{id}/edit', 'Admim\ProductSubCategorieController@edit')
            ->name('admim.productSubCategories.edit');

            //Delete
            Route::get('administracao/subcategoriaslivros/{id}/remove', 'Admim\ProductSubCategorieController@destroy')
            ->name('admim.productSubCategories.destroy');
        /*---------------------------------------------------------------------------------------------------------*/


        /*----------------------------- PRODUCTS BRANDS -----------------------------------------------------------*/
            //Create
            Route::post('administracao/especialidadeslivros', 'Admim\ProductBrandController@store')
            ->name('admim.productBrands.store');

            //Read
            Route::get('administracao/especialidadeslivros', 'Admim\ProductBrandController@index')
            ->name('admim.productBrands.index');

            //Update
            Route::put('administracao/especialidadeslivros/{id}', 'Admim\ProductBrandController@update')
            ->name('admim.productBrands.update');

            Route::get('administracao/especialidadeslivros/{id}/edit', 'Admim\ProductBrandController@edit')
            ->name('admim.productBrands.edit');

            //Delete
            Route::get('administracao/especialidadeslivros/{id}/remove', 'Admim\ProductBrandController@destroy')
            ->name('admim.productBrands.destroy');

            //Brand-SubCategorie
            Route::post('administracao/especialidadeslivros/{id}/addsubcategoria', 'Admim\BrandSubCategorieController@store')
            ->name('admim.productsBrand.addSubCategorie.store');

            //Pegar especialidades relacionadas a uma sub-categoria EDIT
            Route::get('administracao/especialidades/{id}', 'Admim\ProductController@getBrandsAdd');

            //Pegar especialidades relacionadas a uma sub-categoria ADD
            Route::get('administracao/livros/{outro}/especialidades/{id}', 'Admim\ProductController@getBrandsEdit');
        /*---------------------------------------------------------------------------------------------------------*/


        /*----------------------------- BRAND_SUBCATEGORIE -----------------------------------------------------------*/
            //Create
            Route::post('administracao/especialidadesubcategorias', 'Admim\BrandSubcategorieController@store')
            ->name('admim.brandSubcategorie.store');

            //Delete
            Route::get('administracao/especialidadesubcategorias/{id}/remove', 'Admim\BrandSubcategorieController@destroy')
            ->name('admim.brandSubcategorie.destroy');
        /*---------------------------------------------------------------------------------------------------------*/


        /*-----------------------------Exchange--------------------------------------------------------------------*/
            Route::put('administracao/exchange', 'Admim\ExchangeController@update')
            ->name('admim.exchange.update');
        /*---------------------------------------------------------------------------------------------------------*/

        /*-----------------------------PERCENTAGEM DE PRODUTO--------------------------------------------------------------------*/
        Route::put('administracao/taxa', 'Admim\TaxaController@update')
        ->name('admim.taxa.update');
    /*---------------------------------------------------------------------------------------------------------*/


        /*-----------------------------PRODUCT SLIDE SHOW--------------------------------------------------------------------*/
            Route::get('administracao/product/slideShow', 'Admim\ProductController@slideShow')
            ->name('admim.product.slideShow');

            Route::post('administracao/product/slideShow/off', 'Admim\ProductController@slideShowOff')
            ->name('admim.product.slideShowOff');

            Route::post('administracao/product/slideShow/on', 'Admim\ProductController@slideShowOn')
            ->name('admim.product.slideShowOn');
        /*---------------------------------------------------------------------------------------------------------*/

    /*---------------------------------------------------------------------------------------------------------*/


    /*-----------------------------SUPPLYING-----------------------------------------------------------*/
        //Create
        Route::post('administracao/fornecedores', 'Admim\SupplyingController@store')
        ->name('admim.supplying.store')->middleware('auth');

        //Pegar Municípios relacionados a uma província
        Route::get('administracao/municipios/{id}', 'Admim\SupplyingController@getDistricts');

        //Read
        Route::get('administracao/fornecedores', 'Admim\SupplyingController@index')
        ->name('admim.supplying.index')->middleware('auth');

        Route::get('administracao/fornecedores/{id}', 'Admim\SupplyingController@show')
        ->name('admim.supplying.show');

        //Update
        Route::put('administracao/fornecedores/{id}', 'Admim\SupplyingController@update')
        ->name('admim.supplying.update');

        Route::get('administracao/fornecedores/{id}/edit', 'Admim\SupplyingController@edit')
        ->name('admim.supplying.edit');

        //Delete
        Route::get('administracao/fornecedores/{id}/remove', 'Admim\SupplyingController@destroy')
        ->name('admim.supplying.destroy');

        /*-----------------------------SUPPLYING CONTACT-----------------------------------------------------------*/

            /*---------TELEPHONE-----------------------------------------------------------------------------*/
                //Create
                Route::post('administracao/fornecedores/telefone', 'Admim\SupplyingTelephoneController@store')
                ->name('admim.supplyingTelephone.store');

                //Delete
                Route::get('administracao/fornecedores/telefone/{id}/remove', 'Admim\SupplyingTelephoneController@destroy')
                ->name('admim.supplyingTelephone.destroy');
            /*---------------------------------------------------------------------------------------------------------*/


            /*---------EMAIL--------------------------------------------------------------------------------------*/
                //Create
                Route::post('administracao/fornecedores/email', 'Admim\SupplyingEmailController@store')
                ->name('admim.supplyingEmail.store');

                //Delete
                Route::get('administracao/fornecedores/email/{id}/remove', 'Admim\SupplyingEmailController@destroy')
                ->name('admim.supplyingEmail.destroy');
            /*---------------------------------------------------------------------------------------------------------*/

        /*---------------------------------------------------------------------------------------------------------*/

        /*-----------------------------SUPPLY-----------------------------------------------------------*/
            // CRIA NOVO FORNECIMENTO BASEADO EM UM FORNCEDOR
            Route::post('administracao/fornecedoreslivro/novofornecimento', 'Admim\SupplyController@store')
            ->name('admim.supply.store');

            //Delete
            Route::get('administracao/fornecedoreslivro/novofornecimento/{id}/remove', 'Admim\SupplyController@destroy')
            ->name('admim.supply.destroy');
        /*---------------------------------------------------------------------------------------------------------*/


    /*---------------------------------------------------------------------------------------------------------*/


    /*-----------------------------SERVICES-----------------------------------------------------------*/
        //Create
        Route::post('administracao/servicos', 'Admim\ServiceController@store')
        ->name('admim.services.store');

        //Read
        Route::get('administracao/servicos', 'Admim\ServiceController@index')
        ->name('admim.services.index');

        Route::get('administracao/servicos/{id}', 'Admim\ServiceController@show')
        ->name('admim.services.show');

        //Update
        Route::get('administracao/servicos/{id}/edit', 'Admim\ServiceController@edit')
        ->name('admim.services.edit');

        Route::put('administracao/servicos/{id}', 'Admim\ServiceController@update')
        ->name('admim.services.update');

        //Delete
        Route::get('administracao/servicos/{id}/remove', 'Admim\ServiceController@destroy')
        ->name('admim.services.destroy');

        /*-----------------------------EXTRA IMAGES-----------------------------------------------------------*/
            //CREATE
            Route::post('administracao/servicos/{id}/adicionarimagem', 'Admim\AddImagesServiceController@store')
            ->name('admim.services.addImage.store');

            //DELETE
            Route::get('administracao/servicos/{image}/removerimagem', 'Admim\AddImagesServiceController@destroy')
            ->name('admim.services.addImage.destroy');
        /*---------------------------------------------------------------------------------------------------------*/

    /*---------------------------------------------------------------------------------------------------------*/


    /*-----------------------------DASHBOARDS-----------------------------------------------------------*/

        Route::get('administracao/dashboards', 'Admim\DashboardController@index')
        ->name('admim.dashboards.index');
    /*---------------------------------------------------------------------------------------------------------*/

    /*-----------------------------CAMPANHA-----------------------------------------------------------*/
        Route::get('administracao/campanha', 'Admim\PromotionController@index')
        ->name('admim.promotion.index');

        Route::post('administracao/campanha', 'Admim\PromotionController@store')
        ->name('admim.promotion.store');

        Route::get('administracao/campanha/editar', 'Admim\PromotionController@edit')
        ->name('admim.promotion.edit');

        Route::get('/administracao/campanha/editar/cancelar', function(){
            return redirect()->route('admim.promotion.index');
        })->name('admim.promotion.edit.cancel');

        Route::put('administracao/campanha/editar', 'Admim\PromotionController@update')
        ->name('admim.promotion.update');
    /*---------------------------------------------------------------------------------------------------------*/





    /*------------------------------------------- GERAR PDF -----------------------------------------------------------------*/

        Route::get('pdf', 'PDF\MakePDFController@gerar');

    /*------------------------------------------------------------------------------------------------------------------------------*/





//SOBRE NÓS ----- LADO ADMIN

Route::get('administracao/sobrenos', 'Admim\AboutUsController@index')
        ->name('admim.sobrenos.index')->middleware('auth');

Route::post('administracao/sobrenos', 'Admim\AboutUsController@store')
        ->name('admim.sobrenos.store')->middleware('auth');;


Route::get('administracao/contactos', 'Admim\ContactsController@index')
        ->name('admim.contacts.index')->middleware('auth');

Route::post('administracao/contactos', 'Admim\ContactsController@store')
        ->name('admim.contacts.store')->middleware('auth');;


Route::get('administracao/coordBancarias', 'Admim\CoordBancariasController@index')
        ->name('admim.coordenadas.index')->middleware('auth');

Route::post('administracao/coordBancarias', 'Admim\CoordBancariasController@store')
        ->name('admim.coordenadas.store')->middleware('auth');;

Route::get('administracao/coordBancarias/{id}/edit', 'Admim\CoordBancariasController@edit')
        ->name('admim.coordenadas.edit');

Route::put('administracao/coordBancarias/{id}', 'Admim\CoordBancariasController@update')
        ->name('admim.coordenadas.update');






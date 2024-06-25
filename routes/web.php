<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LocaleMiddleware;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Services\PostService;
use App\Services\UserService;
use App\Services\CategoryService;
use App\Services\CommentService;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Illuminate\Support\Facades\Cookie;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');




// Route::prefix("{locale}")->middleware(LocaleMiddleware::class)->group(function () {
// });

//ruta para la cookie the idioma
Route::middleware(LocaleMiddleware::class)->group(function () {


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //ruta invitados
    Route::get('/', [PostController::class, 'guest'])->name('home');

    Route::get('/locale/{locale}', function ($locale) {


        $cookie = Cookie::make('locale', $locale, 30 * 24 * 60);
        $response = redirect()->back()->withCookie($cookie);

        return $response;

    });

    Route::middleware(['auth'])->group(function () {

        //rutas servicios posts, comentarios y categorias
        Route::get('/services/comments', [CommentService::class, 'commentsJson'])->name('service.comments');
        Route::get('/services/categories', [CategoryService::class, 'categoriesJson'])->name('service.categories');
        Route::get('/services/posts', [PostService::class, 'publishedPosts'])->name('service.posts');


        //pagina inicial blog
        Route::get('/blog', [PostController::class, 'postList'])->name('blog');
        //mostrar un post concreto
        Route::get('/blog/posts/post/{slug}', [PostController::class, 'show'])->name('posts.show');

        //comments
        Route::get('blog/posts/post/{slug}/addComment', [CommentController::class, 'create'])->name('comments.create');
        Route::post('blog/posts/comments/store', [CommentController::class, 'store'])->name('comments.store');

        //categories
        Route::get('/blog/categories/{categoryId?}', [CategoryController::class, 'showPostsByCategory'])->name('categories.index');

        //permisos para writer
        Route::group(['middleware' => ['role_or_permission:create posts']], function () {
            Route::get('/blog/posts/create', [PostController::class, 'create'])->name('posts.create');
        });

        //permisos editor
        Route::group(['middleware' => ['role_or_permission:edit any post']], function () {
            // Posts
            Route::post('/blog/posts/store', [PostController::class, 'store'])->name('posts.store');
            Route::get('/blog/posts/post/{slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
            Route::put('/blog/posts/{slug}', [PostController::class, 'update'])->name('posts.update');
            Route::delete('/blog/posts/{slug}', [PostController::class, 'destroy'])->name('posts.destroy');
        });

        Route::group(['middleware' => ['role_or_permission:manage categories']], function () {
            // categorias

            Route::get('/blog/category/create-category', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/blog/category/store', [CategoryController::class, 'store'])->name('categories.store');

            Route::get('/categories/{slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/blog/categories/{slug}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/categories/{slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        });
            //comentarios
        Route::group(['middleware' => ['role_or_permission:delete any comment']], function () {
            Route::delete('/blog/posts/{slug}/{commentId}', [CommentController::class, 'destroy'])->name('comments.destroy');
        });

        //permisos especificos admin
        Route::group(['middleware' => ['role:admin']], function () {

            //Ruta service users
            Route::get('/services/users', [UserService::class, 'usersJson'])->name('service.users');


            //users
            Route::get('/blog/users', [UserController::class, 'index'])->name('users.index');
            Route::post('blog/users/{user}/change-role', [UserController::class, 'changeRole'])->name('users.changeRole');
            Route::delete('blog/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
            //jsons

            Route::get('/blog/jsons', [BlogController::class, 'allJsons'])->name('jsons');
        });



    });


    require __DIR__ . '/auth.php';





    //fin de la ruta para el idioma
});

//ruta para rss
Route::feeds();













//categorias

//ruta para registro, de login
//una ruta de vista para gente registrada, con botones adicionales segun el tipo de usario? ,




//select con categorias y si se puede añadir un searchable


//ruta mostrar post pertenecientes a una categoria en concreto

//ruta mostrar un post en concreto con sus comentarios, aparece en la vista el boton de añadir comentario si puede,editar si es suyo

//ruta protegida por auth para crear posts

//ruta protegida por auth para modificar post, usuario normal solo ve los suyos, editor+admin todos


//ruta para json

// Route::get('/show-posts-json', [PostController::class, 'showJson']);
// Route::get('/posts-json', [PostController::class, 'indexJson']);

//PRUEBA

// Route::get('/prueba', [BlogController::class, 'guest'])->name('publishedPosts');
// Route::get('/prueba2', [PostController::class, 'index']);

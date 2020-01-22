<?php

namespace App\Providers;
use Crypt;
use App\Model\Student;
use App\Model\Staff;
use App\User;
use App\Model\Classsetup;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        

        parent::boot();
        Route::bind('student', function ($valuestudent) {
                       $idstudent=Crypt::decrypt($valuestudent);
            return Student::where('id',$idstudent)->first();
        });
            Route::bind('studentAccount', function ($valuesa) {
                        $idsa=Crypt::decrypt($valuesa);
            return User::where('id',$idsa)->first();
        });
          Route::bind('staff', function ($valuestaff) {
                        $idstaff=Crypt::decrypt($valuestaff);
            return Staff::where('id',$idstaff)->first();
        });
        Route::bind('users', function ($valueuser) {
                        $iduser=Crypt::decrypt($valueuser);
             return User::where('id',$iduser)->first();
        });

         Route::bind('classsetup', function ($valuesetup) {
                        $idsetup=Crypt::decrypt($valuesetup);
             return Classsetup::where('id',$idsetup)->first();
        });
        
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}

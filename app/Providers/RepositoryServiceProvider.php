<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\SellerRepository;
use App\Repositories\SellerRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(SellerRepositoryInterface::class, SellerRepository::class);
    }
}

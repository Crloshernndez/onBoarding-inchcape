<?php

namespace App\Tests\Functional;

use App\Core\Product\Doctrine\Entity\Product;
use App\Core\Product\Doctrine\Repository\ProductRepository;
use App\Tests\FunctionalTester;

class DoctrineCest
{
    public function grabNumRecords(FunctionalTester $I)
    {
        $numRecords = $I->grabNumRecords(Product::class);
        $I->assertSame(1, $numRecords);
    }

    public function grabRepository(FunctionalTester $I)
    {
        //With classes
        $repository = $I->grabRepository(Product::class);
        $I->assertInstanceOf(ProductRepository::class, $repository);

        //With Repository classes
        $repository = $I->grabRepository(ProductRepository::class);
        $I->assertInstanceOf(ProductRepository::class, $repository);

        //With Entities
        // $user = $I->grabEntityFromRepository(Product::class, [
        //     'name' => 'mouse'
        // ]);
        // $repository = $I->grabRepository($user);
        // $I->assertInstanceOf(ProductRepository::class, $repository);

        //With Repository interfaces
        // $repository = $I->grabRepository(UserRepositoryInterface::class);
        // $I->assertInstanceOf(UserRepository::class, $repository);
    }

    // public function seeNumRecords(FunctionalTester $I)
    // {
    //     $I->seeNumRecords(1, Product::class);
    // }
}
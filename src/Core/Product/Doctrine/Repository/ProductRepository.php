<?php

namespace App\Core\Product\Doctrine\Repository;

use App\Core\Product\Doctrine\Entity\Product;
use App\Core\Product\Domain\Model\Product as DomainProduct;
use App\Core\Product\Domain\Ports\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findOneById(string $id): ?DomainProduct
    {
        $productEntity = $this->find($id);
    
        if ($productEntity === null) {
            return null;
        }
    
        return $this->createDomainProductFromEntity($productEntity);
    }

    public function create(DomainProduct $product): string
    {
        $productEntity = new Product();
        $productEntity->name = $product->getName();
        $productEntity->slug = $product->getSlug();
        $productEntity->price = $product->getPrice();
        $productEntity->description = $product->getDescription();

        $entityManager = $this->getEntityManager();
        $entityManager->persist($productEntity);
        $entityManager->flush();

        return $product->getName();
    }

    public function createDomainProductFromEntity(Product $product): DomainProduct
    {
        return new DomainProduct(
            name : $product->name,
            price : $product->price,
            description : $product->description,
            slug : $product->slug
        );
    }

    // public function deleteProduct(string $query, array $params): ?DomainProduct
    // {
    //     $deletedProductEntity = $this->findOneById($params['id']);

    //     if(null === $deletedProductEntity){
    //         dd("Producto no existe");
    //     }

    //     $entityManager = $this->getEntityManager()
    //         ->getConnection()
    //         ->executeQuery($query, $params);

    //     return $this->createDomainProductFromEntity($deletedProductEntity);
    // }

    // public function updateProduct(string $query, array $params): ?DomainProduct
    // {
    //     $this->getEntityManager()
    //         ->getConnection()
    //         ->executeQuery($query, $params);

    //     $updatedProductEntity = $this->findOneById($params['id']);

    //     if (null === $updatedProductEntity) {
    //         return null;
    //     }
    //     return $this->createDomainProductFromEntity($updatedProductEntity);
    // }
}
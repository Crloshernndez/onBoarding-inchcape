<?php

namespace App\Core\Product\Doctrine\Repository;

use App\Core\Product\Doctrine\Entity\Product;
use App\Core\Product\Domain\Model\Product as DomainProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function create(DomainProduct $localProduct): DomainProduct
    {

        $product = new Product();
        $product->name = $localProduct->getName();
        $product->price = $localProduct->getPrice();
        $product->description = $localProduct->getDescription();
        $product->slug = $localProduct->getSlug();
        
        $entityManager = $this->getEntityManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->createDomainProductFromEntity($product);
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

    public function searchProducts($query): array
    {
        $result = $this->getEntityManager()
            ->getConnection()
            ->executeQuery($query)
            ->fetchAllAssociative();
        
        return $result;
    }

    public function searchProduct(string $query, array $params): array
    {
        $result = $this->getEntityManager()
            ->getConnection()
            ->executeQuery($query, $params)
            ->fetchAllAssociative();

        return $result;
    }

    public function findOneById(string $id): ?Product
    {
        return $this->find($id);
    }

    public function deleteProduct(string $query, array $params): ?DomainProduct
    {
        $deletedProductEntity = $this->findOneById($params['id']);

        if(null === $deletedProductEntity){
            dd("Producto no existe");
        }

        $entityManager = $this->getEntityManager()
            ->getConnection()
            ->executeQuery($query, $params);

        return $this->createDomainProductFromEntity($deletedProductEntity);
    }

    public function updateProduct(string $query, array $params): ?DomainProduct
    {
        $this->getEntityManager()
            ->getConnection()
            ->executeQuery($query, $params);

        $updatedProductEntity = $this->findOneById($params['id']);

        if (null === $updatedProductEntity) {
            return null;
        }
        return $this->createDomainProductFromEntity($updatedProductEntity);
    }
}
<?php

namespace App\Business;

use App\Models\Product;
use App\Operations\CartHandler;
use App\Repository\ProductRepository;
use App\Services\CartServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductManager
{
    protected ProductRepository $productRepository;
    protected CartServiceInterface $cartService;

    public function __construct(ProductRepository $productRepository)
    {
        $this->cartService = CartHandler::handler();
        $this->productRepository = $productRepository;
    }

    public function get()
    {
        return [$this->productRepository->get([], ['paginate' => true]), $this->cartService->getCart()];
    }

    public function getById(int $productId) : Product
    {
        return $this->productRepository->getById($productId);
    }
}

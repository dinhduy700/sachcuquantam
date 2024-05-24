<?php
namespace App\Http\Services;

use App\Http\Repositories\ProductRepository;

class SearchService {
    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function searchProductByName($pagination,$search) {
        return $this->productRepository->list($pagination,$search, null, null);
    }
}

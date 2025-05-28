<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row): Product
    {
        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'sell_price' => $row['sell_price'],
            'marge' => $row['marge'],
            'stock' => $row['stock'],
            'categorie_id' => $row['categorie_id'],
            'image' => 'storage/products/' . $row['image'],
            'status' => $row['status'],
        ]);
    }
}

<?php

/**
 * Banner Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Brands;

use App\Models\Product;

/**
 * Banner Repositories handle query for module Product
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class BrandRepository
{
    /**
     * Query get list banner
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function list($pagination, $search, $status, $sortBy)
    {   
        $brands = new Brands();
        if (!empty($search)) {
            $brands = $brands->where('brand_name', 'like', '%'.$search.'%');
        }
        if ($status != null) {
            $brands = $brands->where('is_active', $status);
        }
        if ($sortBy !== null) {
            $conditionSort = 'DESC';
            $column = 'created_at';
            if ($sortBy % 2 != 1) {
                $conditionSort = 'ASC';
            }
            if ($sortBy == 0 || $sortBy == 1) {
                $column = 'brand_name';
            }
            $brands = $brands->orderBy($column, $conditionSort);
        } else {
            $brands = $brands->orderBy('brand_position', 'ASC')->orderBy('id', 'ASC');
        }
        if (!empty($pagination)) {
            $brands = $brands->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $brands = $brands->get();
        }
        return $brands;
    }

    /**
     * Save information product category
     *
     * @param Request $request - send information product category
     *
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $data = [
            'brand_name' => $request->brand_name ?? null,
            'brand_image' => $request->brand_image ?? null,
            'brand_link' => $request->brand_link ?? null,
            'brand_position' => $request->brand_position ?? null,
            'is_active' => $request->is_active ?? 0,
        ];

        Brands::create($data);
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $brand)
    {
        $data = [
            'brand_name' => $request->brand_name ?? null,
            'brand_image' => $request->brand_image ?? null,
            'brand_link' => $request->brand_link ?? null,
            'brand_position' => $request->brand_position ?? null,
            'is_active' => $request->is_active ?? 0,
        ];
        Brands::where('id', $brand)->update($data);
    }

    public function getInformationBrand($brand)
    {
        return Brands::findOrFail($brand);
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function delete(int $brand)
    {
        Product::whereJsonContains('brand_id', $brand)->update(['brand_id' => null]);
        Brands::find($brand)->delete();
    }
}
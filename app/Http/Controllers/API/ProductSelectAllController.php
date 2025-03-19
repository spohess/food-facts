<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\Models\GetAllProductsWithPaginateService;
use Illuminate\Contracts\Container\BindingResolutionException;

class ProductSelectAllController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Lista de produtos",
     *     description="Retorna uma lista de produtos com paginação",
     *     operationId="getAllProduct",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="code",
     *         in="path",
     *         description="Código único do produto",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=88
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de produtos",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="code", type="integer", example=17),
     *                     @OA\Property(property="status", type="string", example="published"),
     *                     @OA\Property(property="imported_t", type="string", format="date-time", nullable=true, example=null),
     *                     @OA\Property(property="url", type="string", example="http://world-en.openfoodfacts.org/product/0000000000017/vitoria-crackers"),
     *                     @OA\Property(property="creator", type="string", example="kiliweb"),
     *                     @OA\Property(property="created_t", type="string", format="date-time", example="2018-06-15T10:38:00.000000Z"),
     *                     @OA\Property(property="last_modified_t", type="string", format="date-time", example="2019-06-25T11:55:18.000000Z"),
     *                     @OA\Property(property="product_name", type="string", example="Vitória crackers"),
     *                     @OA\Property(property="quantity", type="string", example=""),
     *                     @OA\Property(property="brands", type="string", example=""),
     *                     @OA\Property(property="categories", type="string", example=""),
     *                     @OA\Property(property="labels", type="string", example=""),
     *                     @OA\Property(property="cities", type="string", example=""),
     *                     @OA\Property(property="purchase_places", type="string", example=""),
     *                     @OA\Property(property="stores", type="string", example=""),
     *                     @OA\Property(property="ingredients_text", type="string", example=""),
     *                     @OA\Property(property="traces", type="string", example=""),
     *                     @OA\Property(property="serving_size", type="string", example=""),
     *                     @OA\Property(property="serving_quantity", type="string", example=""),
     *                     @OA\Property(property="nutriscore_score", type="string", example=""),
     *                     @OA\Property(property="nutriscore_grade", type="string", example=""),
     *                     @OA\Property(property="main_category", type="string", example=""),
     *                     @OA\Property(property="image_url", type="string", example="https://static.openfoodfacts.org/images/products/000/000/000/0017/front_fr.4.400.jpg")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="from", type="integer", example=1),
     *                 @OA\Property(property="last_page", type="integer", example=45),
     *                 @OA\Property(
     *                     property="links",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="url", type="string", nullable=true, example=null),
     *                         @OA\Property(property="label", type="string", example="&laquo; Previous"),
     *                         @OA\Property(property="active", type="boolean", example=false)
     *                     )
     *                 ),
     *                 @OA\Property(property="path", type="string", example="http://localhost/api/products"),
     *                 @OA\Property(property="per_page", type="integer", example=20),
     *                 @OA\Property(property="to", type="integer", example=20),
     *                 @OA\Property(property="total", type="integer", example=899)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Produto não encontrado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     * @throws BindingResolutionException
     */
    public function __invoke()
    {
        $products = app()->make(GetAllProductsWithPaginateService::class)();

        return ProductResource::collection($products);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\Models\FindProductByCodeService;
use Illuminate\Contracts\Container\BindingResolutionException;

class ProductSelectController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products/{code}",
     *     summary="Obter detalhes de um produto específico",
     *     description="Retorna informações detalhadas de um produto baseado no código",
     *     operationId="getProduct",
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
     *         description="Detalhes do produto solicitado",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=88),
     *                 @OA\Property(property="status", type="string", nullable=true, example=null),
     *                 @OA\Property(property="imported_t", type="string", format="date-time", nullable=true, example=null),
     *                 @OA\Property(property="url", type="string", example="http://world-en.openfoodfacts.org/product/000000000088/pate-d-amende"),
     *                 @OA\Property(property="creator", type="string", example="kiliweb"),
     *                 @OA\Property(property="created_t", type="string", format="date-time", example="2019-12-26T11:03:42.000000Z"),
     *                 @OA\Property(property="last_modified_t", type="string", format="date-time", example="2019-12-26T11:06:50.000000Z"),
     *                 @OA\Property(property="product_name", type="string", example="Pate d'amende"),
     *                 @OA\Property(property="quantity", type="string", example=""),
     *                 @OA\Property(property="brands", type="string", example=""),
     *                 @OA\Property(property="categories", type="string", example="Pâte d'amende"),
     *                 @OA\Property(property="labels", type="string", example=""),
     *                 @OA\Property(property="cities", type="string", example=""),
     *                 @OA\Property(property="purchase_places", type="string", example=""),
     *                 @OA\Property(property="stores", type="string", example=""),
     *                 @OA\Property(property="ingredients_text", type="string", example=""),
     *                 @OA\Property(property="traces", type="string", example=""),
     *                 @OA\Property(property="serving_size", type="string", example=""),
     *                 @OA\Property(property="serving_quantity", type="string", example=""),
     *                 @OA\Property(property="nutriscore_score", type="string", example=""),
     *                 @OA\Property(property="nutriscore_grade", type="string", example=""),
     *                 @OA\Property(property="main_category", type="string", example="fr:pate-d-amende"),
     *                 @OA\Property(property="image_url", type="string", example="https://static.openfoodfacts.org/images/products/000/000/000/088/front_fr.3.400.jpg")
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
    public function __invoke($code)
    {
        $product = app()->make(FindProductByCodeService::class, [
            'code' => $code,
        ])();
        if (! $product) {
            return response()->json('Produto não encontrado', 404);
        }
        return new ProductResource($product);
    }
}

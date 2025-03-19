<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Models\DeleteProductService;
use App\Services\Models\FindProductByCodeService;
use Illuminate\Contracts\Container\BindingResolutionException;

class ProductDeleteController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/api/products/{code}",
     *     summary="Deleta um produto espeficífico",
     *     description="Efetua uma remoção lógico de um produto baseado no código",
     *     operationId="deleteProduct",
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
     *         description="Produto deletado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Produto deletado com sucesso")
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

        app()->make(DeleteProductService::class, [
            'productModel' => $product,
        ])();
        return response()->json('Produto deletado com sucesso');
    }
}

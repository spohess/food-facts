<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostUserTokenRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TokenCreateController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/tokens/create",
     *     summary="Criação de token de usuário para autênticação no uso da API",
     *     tags={"Token", "Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="email", example="teste@examplo"),
     *             @OA\Property(property="password", type="string", example="password"),
     *             @OA\Property(property="token_name", type="string", example="para_teste"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Token criado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="plainTextToken", type="string", example="1|lQ4sE0RwgWzHCRCKsV13ISg6jZlwWb2F9kOlNqCa627d5fd9")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Credênciais inválidas"
     *     )
     * )
     */
    public function __invoke(PostUserTokenRequest $request): JsonResponse
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $token = Auth::user()->createToken($request->input('token_name', 'acesso_api'));
            return response()->json(['token' => $token->plainTextToken]);
        }

        return response()->json(['error' => 'Credênciais inválidas'], 401);
    }
}

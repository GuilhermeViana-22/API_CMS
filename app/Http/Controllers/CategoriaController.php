<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Response;
use Exception;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriaRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCategoriaRequest $request)
    {
        try {
            $dados = $request->validated();
            $categoria = Categoria::create($dados);

            return response()->json([
                'status' => 'success',
                'message' => 'Categoria criada com sucesso.',
                'data' => $categoria,
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao criar a categoria: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Categoria $categoria)
    {
        return response()->json($categoria, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriaRequest  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        try {
            $dados = $request->validated();
            $categoria->update($dados);

            return response()->json([
                'status' => 'success',
                'message' => 'Categoria atualizada com sucesso.',
                'data' => $categoria,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar a categoria: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Categoria deletada com sucesso.',
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao deletar a categoria: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

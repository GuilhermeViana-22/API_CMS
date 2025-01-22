<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoUsuarioRequest;
use App\Http\Requests\UpdateTipoUsuarioRequest;
use App\Models\TipoUsuario;
use Illuminate\Http\Response;
use Exception;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tiposUsuario = TipoUsuario::all();
        return response()->json($tiposUsuario, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoUsuarioRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTipoUsuarioRequest $request)
    {
        try {
            $dados = $request->validated();
            $tipoUsuario = TipoUsuario::create($dados);

            return response()->json([
                'status' => 'success',
                'message' => 'Tipo de usuário criado com sucesso.',
                'data' => $tipoUsuario,
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao criar o tipo de usuário: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(TipoUsuario $tipoUsuario)
    {
        return response()->json($tipoUsuario, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoUsuarioRequest  $request
     * @param  \App\Models\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTipoUsuarioRequest $request, TipoUsuario $tipoUsuario)
    {
        try {
            $dados = $request->validated();
            $tipoUsuario->update($dados);

            return response()->json([
                'status' => 'success',
                'message' => 'Tipo de usuário atualizado com sucesso.',
                'data' => $tipoUsuario,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar o tipo de usuário: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TipoUsuario $tipoUsuario)
    {
        try {
            $tipoUsuario->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Tipo de usuário deletado com sucesso.',
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao deletar o tipo de usuário: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

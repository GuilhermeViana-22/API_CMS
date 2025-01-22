<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CursoResource;
use Illuminate\Http\Response;
use Exception;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::all();
        return response()->json(CursoResource::collection($cursos), Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCursoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCursoRequest $request)
    {
        // Recebe os dados validados da request
        $dados = $request->validated();

        DB::beginTransaction(); // Inicia a transação

        try {
            // Cria uma nova instância do modelo Curso
            $curso = new Curso($dados);
            $curso->save();

            // Cria a pasta no storage com base no ID do curso
            $pastaPath = "cursos/{$curso->id}";
            if (!Storage::exists($pastaPath)) {
                Storage::makeDirectory($pastaPath);
            }

            // Confirma a transação
            DB::commit();

            // Retorna uma resposta de sucesso
            return response()->json([
                'status' => 'success',
                'message' => 'O curso foi cadastrado com sucesso.',
            ],  Response::HTTP_OK);
        } catch (\Exception $e) {
            // Reverte a transação em caso de erro
            DB::rollBack();

            // Retorna uma resposta de erro
            return response()->json([
                'status' => 'error',
                'message' => 'Ocorreu um erro ao salvar o curso ou criar a pasta: ' . $e->getMessage(),
            ],  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function teste(){
        return response()->json([
            'status' => 'success',
            'message' => 'O curso foi cadastrado com sucesso.',
        ],  Response::HTTP_OK);
    }

   /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        return response()->json(new CursoResource($curso), Response::HTTP_OK);
    }

    /**
     * método para editar o curso
     *
     */
    public function update(UpdateCursoRequest $request, $id)
    {
        $dados = $request->validated();

        DB::beginTransaction();

        try {
            $curso = Curso::findOrFail($id); // Busca o curso pelo ID

            // Atualizar imagem, se enviada
            if ($request->hasFile('imagem')) {
                // Deletar imagem antiga
                if ($curso->imagem && Storage::exists($curso->imagem)) {
                    Storage::delete($curso->imagem);
                }

                // Salvar nova imagem
                $path = $request->file('imagem')->store('cursos');
                $dados['imagem'] = $path;
            }

            $curso->update($dados);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'O curso foi atualizado com sucesso.',
                'curso' => new CursoResource($curso),
            ],  Response::HTTP_OK);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar o curso: ' . $e->getMessage(),
            ],  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        DB::beginTransaction();

        try {
            // Deletar imagem do curso, se existir
            if ($curso->imagem && Storage::exists($curso->imagem)) {
                Storage::delete($curso->imagem);
            }

            // Deletar pasta associada ao curso, se existir
            $pastaPath = "cursos/{$curso->id}";
            if (Storage::exists($pastaPath)) {
                Storage::deleteDirectory($pastaPath);
            }

            $curso->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'O curso foi excluído com sucesso.',
            ],  Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao excluir o curso: ' . $e->getMessage(),
            ],  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

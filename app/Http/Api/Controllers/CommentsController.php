<?php

namespace App\Http\Api\Controllers;
use App\Http\Resources\Schemas\CommentsResponse;
use App\Http\Resources\Schemas\Comments;
use App\Http\Repositories\CommentsRepository;
use App\Http\Requests\CommentsCreateRequest;
use App\Http\Requests\CommentsUpdateRequest;
use Illuminate\Http\JsonResponse;

class CommentsController extends BaseController
{
    protected CommentsRepository $commentsRepository;

    public function __construct(CommentsRepository $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;
    }

    /**
     * @param CommentsRepository $commentsRepository
     *
     * @return JsonResponse
     *
     * @OA\Get (
     *      path="/comments",
     *      operationId="CommentsList",
     *      summary="List of Comments",
     *      tags={"Comments"},
     *
     *	    @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/CommentsResponse"
     *          )
     *      )
     * )
     */
    public function index(CommentsRepository $commentsRepository)
    {
        $data = $commentsRepository->all();
        $resource = CommentsResponse::make($data);

        return $this->responseOk($resource);
    }

    /**
     * @param CommentsCreateRequest $request
     *
     * @return JsonResponse
     *
     * @OA\Post (
     *      path="/comments",
     *      operationId="createComments",
     *      summary="Create a Comments",
     *      tags={"Comments"},
     *      requestBody={"$ref": "#/components/requestBodies/CommentsCreateRequestBody"},
     *
     *	    @OA\Response(
     *          response=422,
     *          description="",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/InvalidDataResponse"
     *          )
     *      ),
     *
     *	    @OA\Response(
     *          response=201,
     *          description="",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Comments"
     *          )
     *      ),
     * )
     */
    public function store(CommentsCreateRequest $request): JsonResponse
    {
        $comments = $this->commentsRepository->create($request);
        $commentsResource = Comments::make($comments);

        return $this->responseCreated($commentsResource);
    }

    /**
     * @param int $id
     * @param CommentsUpdateRequest $request
     *
     * @return JsonResponse
     *
     * @OA\Put (
     *      path="/comments/{id}",
     *      operationId="CommentsUpdate",
     *      summary="Update Comments state",
     *      tags={"Comments"},
     *      requestBody={"$ref": "#/components/requestBodies/CommentsUpdateRequestBody"},
     *
     *      @OA\Parameter (
     *          name = "id",
     *          in = "path",
     *          required = true,
     *			@OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *
     *	    @OA\Response(
     *          response=422,
     *          description="",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/InvalidDataResponse"
     *          )
     *      ),
     *
     *	    @OA\Response(
     *          response=400,
     *          description="Not found Comments for update"
     *      ),
     *
     *	    @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Comments"
     *          )
     *      ),
     * )
     */
    public function update(int $id, CommentsUpdateRequest $request): JsonResponse
    {
        if ( ! ($comments = $this->commentsRepository->find($id))) {
            return $this->responseBadRequest();
        }

        $this->commentsRepository->update($comments, $request);
        $resource = Comments::make($comments);

        return $this->responseOk($resource);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse|Response
     *
     * @OA\Delete (
     *      path="/comments/{id}",
     *      operationId="CommentsDestroy",
     *      summary="Destroy Comments",
     *      tags={"Comments"},
     *
     *      @OA\Parameter (
     *          name = "id",
     *          in = "path",
     *          required = true,
     *			@OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *
     *	    @OA\Response(
     *          response=422,
     *          description="",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/InvalidDataResponse"
     *          )
     *      )
     * )
     */
    public function destroy(int $id)
    {
        if ( ! $comments = $this->commentsRepository->find($id)) {
            return $this->responseBadRequest();
        }

        try {
            if ( ! $this->commentsRepository->destroy($comments)) {
                return $this->responseBadRequest();
            }
        } catch (ValidationException $exception) {
            return $this->responseInvalidData(
                $exception->getMessage(),
                $exception->errors()
            );
        }
        return response()->noContent();
    }
}

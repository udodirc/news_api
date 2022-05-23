<?php

namespace App\Http\Api\Controllers;
use App\Http\Resources\Schemas\NewsResponse;
use App\Http\Resources\Schemas\News;
use App\Http\Repositories\NewsRepository;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use Illuminate\Http\JsonResponse;

class NewsController extends BaseController
{
    protected NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param NewsRepository $newsRepository
     *
     * @return JsonResponse
     *
     * @OA\Get (
     *      path="/news",
     *      operationId="newsList",
     *      summary="List of news",
     *      tags={"News"},
     *
     *	    @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/NewsResponse"
     *          )
     *      )
     * )
     */
    public function index(NewsRepository $newsRepository)
    {
        $data = $newsRepository->all();
        $resource = NewsResponse::make($data);

        return $this->responseOk($resource);
    }

    /**
     * @param NewsCreateRequest $request
     *
     * @return JsonResponse
     *
     * @OA\Post (
     *      path="/news",
     *      operationId="createNews",
     *      summary="Create a news",
     *      tags={"News"},
     *      requestBody={"$ref": "#/components/requestBodies/NewsCreateRequestBody"},
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
     *              ref="#/components/schemas/News"
     *          )
     *      ),
     * )
     */
    public function store(NewsCreateRequest $request): JsonResponse
    {
        $news = $this->newsRepository->create($request);
        $resource = News::make($news);

        return $this->responseCreated($resource);
    }

    /**
     * @param int $id
     * @param NewsUpdateRequest $request
     *
     * @return JsonResponse
     *
     * @OA\Put (
     *      path="/news/{id}",
     *      operationId="NewsUpdate",
     *      summary="Update News state",
     *      tags={"News"},
     *      requestBody={"$ref": "#/components/requestBodies/NewsUpdateRequestBody"},
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
     *          description="Not found news for update"
     *      ),
     *
     *	    @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/News"
     *          )
     *      ),
     * )
     */
    public function update(int $id, NewsUpdateRequest $request): JsonResponse
    {
        if ( ! ($news = $this->newsRepository->find($id))) {
            return $this->responseBadRequest();
        }

        $this->newsRepository->update($news, $request);
        $resource = News::make($news);

        return $this->responseOk($resource);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse|Response
     *
     * @OA\Delete (
     *      path="/news/{id}",
     *      operationId="NewsDestroy",
     *      summary="Destroy News",
     *      tags={"News"},
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
        if ( ! $news = $this->newsRepository->find($id)) {
            return $this->responseBadRequest();
        }

        try {
            if ( ! $this->newsRepository->destroy($news)) {
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

    /**
     * @param int $type
     * @param int $id
     *
     * @return JsonResponse|Response
     *
     * @OA\Post (
     *      path="/news/upvote/{type}/{id}",
     *      operationId="NewsUpvote",
     *      summary="Upvote News",
     *      tags={"News"},
     *
     *     @OA\Parameter (
     *          name = "type",
     *          in = "path",
     *          required = true,
     *			@OA\Schema(
     *             type="integer"
     *         )
     *      ),
     *
     *     @OA\Parameter (
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
    public function upvote(int $type, int $id)
    {
        if ( ! ($news = $this->newsRepository->find($id))) {
            return $this->responseBadRequest();
        }

        try {
            if ( ! $this->newsRepository->upvote($type, $news)) {
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

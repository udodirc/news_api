<?php

namespace App\Http\Repositories;

use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NewsRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return News::with(['user'])->get();
    }

    /**
     * @param array $data
     * @return News|null
     */
    public function create(NewsCreateRequest $request): ?News
    {
        return News::create($request->all());
    }

    /**
     * @param News $news
     * @return bool
     */
    public function update(News $news, NewsUpdateRequest $request): bool
    {
        return (bool)$news->update(
            $request->all()
        );
    }

    /**
     * @param int $id
     * @return News|null
     */
    public function find(int $id): ?News
    {
        return News::find($id);
    }
    /**
     * @param News $news
     * @return bool
     */
    public function destroy(News $news): bool
    {
        return (bool)$news->delete();
    }

    /**
     * @param int $type
     * @param News $news
     * @return bool
     */
    public function upvote(int $type, News $news): bool
    {
        if($type){
            return (bool)$news->increment('upvotes');
        } else{
            return (bool)$news->decrement('upvotes');
        }
    }
}

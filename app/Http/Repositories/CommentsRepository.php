<?php

namespace App\Http\Repositories;

use App\Http\Requests\CommentsCreateRequest;
use App\Http\Requests\CommentsUpdateRequest;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Collection;

class CommentsRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Comments::with(['user', 'news'])->get();
    }

    /**
     * @param array $data
     * @return Comments|null
     */
    public function create(CommentsCreateRequest $request): ?Comments
    {
        return Comments::create($request->all());
    }

    /**
     * @param Comments $Comments
     * @return bool
     */
    public function update(Comments $Comments, CommentsUpdateRequest $request): bool
    {
        return (bool)$Comments->update(
            $request->all()
        );
    }

    /**
     * @param int $id
     * @return Comments|null
     */
    public function find(int $id): ?Comments
    {
        return Comments::find($id);
    }
    /**
     * @param Comments $Comments
     * @return bool
     */
    public function destroy(Comments $Comments): bool
    {
        return (bool)$Comments->delete();
    }
}

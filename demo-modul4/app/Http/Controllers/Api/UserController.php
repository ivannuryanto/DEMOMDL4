<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Media;
use App\Http\Resources\MediaResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $users = User::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . trim((string) $request->query('search')) . '%');
            })
            ->with('collections:id,title,description,genre,episodes,release_year,type')
            ->orderBy('id')
            ->get();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
        $user->load('collections:id,title,description,genre,episodes,release_year,type');

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'message' => 'User berhasil dihapus.',
        ]);
    }

    public function favorites(User $user): JsonResponse
    {
        $collections = $user->collections()
            ->orderBy('media.id')
            ->get();

        return response()->json([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'collections' => MediaResource::collection($collections)->resolve(),
            ],
        ]);
    }

    public function collections(User $user): JsonResponse
    {
        return $this->favorites($user);
    }

    public function addFavorite(User $user, Media $media): JsonResponse
    {
        $user->collections()->syncWithoutDetaching([$media->id]);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi.',
            'data' => new MediaResource($media),
        ]);
    }

    public function addToCollection(User $user, Media $media): JsonResponse
    {
        return $this->addFavorite($user, $media);
    }

    public function removeFavorite(User $user, Media $media): JsonResponse
    {
        $user->collections()->detach($media->id);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi.',
        ]);
    }

    public function removeFromCollection(User $user, Media $media): JsonResponse
    {
        return $this->removeFavorite($user, $media);
    }
}

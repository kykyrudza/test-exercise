<?php

namespace App\Actions\Movie;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PublishAction
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function handle(int $id): void
    {
        $service = app()->get('movieService');

        DB::beginTransaction();

        try {
            $service->updateMovie($id, (object) ['is_published' => true]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Error publishing movie: ' . $e->getMessage());

            throw $e;
        }
    }
}

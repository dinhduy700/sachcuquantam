<?php

/**
 * Comment Service Application
 * PHP version ^7.3|^8.0
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Repositories\CommentRepository;
use Illuminate\Support\Facades\Log;

use Throwable;

class CommentService 
{
    protected $commentRepository;

    public function __construct(
        CommentRepository $commentRepository
    ) {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Get banner list
     *
     * @param int $pagination - pagination number
     * 
     * @return array
     */
    public function getCommentList($pagination = null, $filter = null, $search = null, $status = null, $sortBy = null)
    {
        if ($filter == 'news') {
            return $this->commentRepository->listNewsComment($pagination, $search, $status, $sortBy);
        }
        return $this->commentRepository->listProductComment($pagination, $search, $status, $sortBy);
    }

    /**
     * Delete product category service
     *
     * @param \App\Models\ProductCategory $category - category detail delete
     * 
     * @return \Illuminate\Http\Response delete product category information
     */
    public function deleteComment($comment, $filter = null)
    {
        DB::beginTransaction();
        try {
            if ($filter == 'news') {
                $this->commentRepository->deleteNewsComment($comment);
            } else {
                $this->commentRepository->deleteProductComment($comment);
            }
            $result = [
                'message' => __('messages.delete_success'),
                'status'  => Response::HTTP_OK
            ];
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            if ($e instanceof ModelNotFoundException) {
                $result = [
                    'message' => __('messages.data_not_found'),
                    'status'  => Response::HTTP_NOT_FOUND
                ];
            } else {
                $result = [
                    'message' => __('messages.internal_server_error'),
                    'status'  => Response::HTTP_INTERNAL_SERVER_ERROR
                ];
            }
            DB::rollback();
        }
        return $result;
    }

    /**
     * Get information banner service
     *
     * @param \App\Models\Banner $banner - banner detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function getInformationComment($comment, $filter = null)
    {
        if ($filter == 'news') {
            return $this->commentRepository->getInformationNewsComment($comment);
        }
        return $this->commentRepository->getInformationProductComment($comment);
    }

    /**
     * Update banner service
     *
     * @param \Illuminate\Http\Request $request - send information banner
     * @param \App\Models\Banner       $banner  - banner edit
     * 
     * @return \Illuminate\Http\Response save product category information
     */
    public function updateComment($request, $comment, $filter = null)
    {
        DB::beginTransaction();
        try {
            if ($filter == 'news') {
                $this->commentRepository->updateNewsComment($request, $comment);
            } else {
                $this->commentRepository->updateProductComment($request, $comment);
            }
            $result = [
                'message' => __('messages.save_success'),
                'status'  => Response::HTTP_OK
            ];
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            if ($e instanceof ModelNotFoundException) {
                $result = [
                    'message' => __('messages.data_not_found'),
                    'status'  => Response::HTTP_NOT_FOUND
                ];
            } else {
                $result = [
                    'message' => __('messages.internal_server_error'),
                    'status'  => Response::HTTP_INTERNAL_SERVER_ERROR
                ];
            }
            DB::rollback();
        }
        return $result;
    }

}

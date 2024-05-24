<?php

/**
 * Contact Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Contact
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\NewsComment;

use App\Models\ProductComment;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

class CommentRepository 
{
    /**
     * Query get list banner
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function listNewsComment($pagination, $search, $status, $sortBy)
    {   
        $comments = new NewsComment();
        if (!empty($search)) {
            $comments = $comments->where('name', 'like', '%'.$search.'%')->orWhere('email', 'like', '%'.$search.'%');
        }
        if ($status != null) {
            $comments = $comments->where('is_active', $status);
        }
        if ($sortBy !== null) {
            $conditionSort = 'DESC';
            $column = 'id';
            if ($sortBy % 2 != 1) {
                $conditionSort = 'ASC';
            }
            if ($sortBy == 0 || $sortBy == 1) {
                $column = 'name';
            }
            $comments = $comments->orderBy($column, $conditionSort);
        } else {
            $comments = $comments->orderBy('id', 'DESC');
        }
        if (!empty($pagination)) {
            $comments = $comments->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $comments = $comments->get();
        }
        return $comments;
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function deleteNewsComment($comment)
    {
        NewsComment::find($comment)->delete();
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function updateNewsComment($request, $comment)
    {
        $data = [
            'is_active' => $request->is_active ?? 0,
        ];
        NewsComment::where('id', $comment)->update($data);
    }

    public function getInformationNewsComment($comment)
    {
        return NewsComment::findOrFail($comment);
    }

    /**
     * Query get list banner
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function listProductComment($pagination, $search, $status, $sortBy)
    {   
        $comments = ProductReview::where('reply_id', 0);
        if (!empty($search)) {
            $comments = $comments->where('name', 'like', '%'.$search.'%');
        }
        if ($status != null) {
            $comments = $comments->where('is_active', $status);
        }
        if ($sortBy !== null) {
            $conditionSort = 'DESC';
            $column = 'id';
            if ($sortBy % 2 != 1) {
                $conditionSort = 'ASC';
            }
            if ($sortBy == 0 || $sortBy == 1) {
                $column = 'name';
            }
            if ($sortBy == 4 || $sortBy == 5) {
                $column = 'score';
            }
            $comments = $comments->orderBy($column, $conditionSort);
        } else {
            $comments = $comments->orderBy('id', 'DESC');
        }
        if (!empty($pagination)) {
            $comments = $comments->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $comments = $comments->get();
        }
        return $comments;
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function deleteProductComment($comment)
    {
        ProductReview::find($comment)->delete();
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function updateProductComment($request, $comment)
    {
        $review = ProductReview::find($comment);
        $review->is_active = $request->is_active ?? 0;
        $review->save();
        if(!empty($request->review_content))
        {
            $reply = [
                'name' => Auth::user()->name,
                'product_id' => $review->product_id,
                'reply_id' => $comment,
                'review_content' => $request->review_content ?? null,
                'is_active' => 1
            ];
            ProductReview::create($reply);
        }
    }

    public function getInformationProductComment($comment)
    {
        return ProductReview::findOrFail($comment);
    }
}
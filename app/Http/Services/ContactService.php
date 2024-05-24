<?php

/**
 * Contact Service Application
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

use App\Http\Repositories\ContactRepository;
use Illuminate\Support\Facades\Log;

use Throwable;

class ContactService {
    protected $contactRepository;

    public function __construct(
        ContactRepository $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
    }

    public function addContact($request) {
        DB::beginTransaction();
        try {
            $contact = $this->contactRepository->add($request);
            $result = [
                'message' => __('messages.save_success'),
                'status'  => Response::HTTP_OK,
                'contact' => $contact
            ];
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
        DB::commit();
        return $result;
    }

    /**
     * Get banner list
     *
     * @param int $pagination - pagination number
     * 
     * @return array
     */
    public function getContactList($pagination = null, $search = null, $status = null, $sortBy = null)
    {
        return $this->contactRepository->list($pagination, $search, $status, $sortBy);
    }

    /**
     * Delete product category service
     *
     * @param \App\Models\ProductCategory $category - category detail delete
     * 
     * @return \Illuminate\Http\Response delete product category information
     */
    public function deleteContact($contact)
    {
        DB::beginTransaction();
        try {
            $this->contactRepository->delete($contact);
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
    public function getInformationContact($contact)
    {
        return $this->contactRepository->getInformationContact($contact);
    }

    /**
     * Update banner service
     *
     * @param \Illuminate\Http\Request $request - send information banner
     * @param \App\Models\Banner       $banner  - banner edit
     * 
     * @return \Illuminate\Http\Response save product category information
     */
    public function updateContact($request, $contact)
    {
        DB::beginTransaction();
        try {
            $this->contactRepository->update($request, $contact);
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

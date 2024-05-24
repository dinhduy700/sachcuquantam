<?php

/**
 * Banner Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Video;

use App\Models\VideoTranslation;

use Illuminate\Support\Str;

/**
 * Banner Repositories handle query for module Product
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class VideoRepository
{
    /**
     * Query get list banner
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function list($pagination, $search, $status, $sortBy)
    {   
        $videos = Video::select('videos.*');
        if (!empty($search)) {
            $videos = $videos->whereHas(
                'translation', function ($query) use ($search) {
                    $query->where('video_title', 'like', '%'.$search.'%');
                }
            );
        }
        if ($status != null) {
            $videos = $videos->where('is_active', $status);
        }
        if ($sortBy !== null) {
            $conditionSort = 'DESC';
            if ($sortBy % 2 != 1) {
                $conditionSort = 'ASC';
            }
            if ($sortBy == 0 || $sortBy == 1) {
                $videos = $videos->join('video_translation', 'videos.id', '=', 'video_translation.video_id')->where('locale', config('app.locale'))->orderBy('video_title', $conditionSort);
            } else if ($sortBy == 2 || $sortBy == 3) {
                $videos = $videos->orderBy('created_at', $conditionSort);
            }
        } else {
            $videos = $videos->orderBy('video_position', 'ASC')->orderBy('id', 'ASC');
        }
        $videos = $videos->with('translation');
        if (!empty($pagination)) {
            $videos = $videos->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $videos = $videos->get();
        }
        return $videos;
    }

    /**
     * Save information product category
     *
     * @param Request $request - send information product category
     *
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $data = [
            'video_image' => $request->video_image ?? null,
            'video_position' => $request->video_position ?? 0,
            'is_active' => $request->is_active ?? 0,
        ];

        $video = Video::create($data);
    
        if ($video) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation[] = [
                    'locale' => $lang,
                    'video_id' => $video->id,
                    'video_title' => $request->$lang['video_title'] ?? null,
                    'video_slug' => $request->$lang['video_slug'] ?? Str::slug($request->$lang['video_title']) . '-' . $video->id,
                    'video_link' => $request->$lang['video_link'] ?? null
                ];
            }
            VideoTranslation::insert($dataTranslation);
        }
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $video)
    {
        $data = [
            'video_image' => $request->video_image ?? null,
            'video_position' => $request->video_position ?? 0,
            'is_active' => $request->is_active ?? 0,
        ];
        Video::where('id', $video)->update($data);
        if ($video) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation = [
                    'video_title' => $request->$lang['video_title'] ?? null,
                    'video_slug' => $request->$lang['video_slug'] ?? Str::slug($request->$lang['video_title']) . '-' . $video,
                    'video_link' => $request->$lang['video_link'] ?? null
                ];
                VideoTranslation::where(['locale' => $lang, 'video_id' => $video])->update($dataTranslation);
            }
        }
    }

    public function getInformationVideo($video)
    {
        return Video::findOrFail($video);
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function delete($video)
    {
        Video::find($video)->delete();
    }
}
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

use App\Models\Tag;

use App\Models\TagTranslation;

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

class TagRepository
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
        $tag = Tag::select('tags.*');
        if (!empty($search)) {
            $tag = $tag->whereHas(
                'translation', function ($query) use ($search) {
                    $query->where('tag_name', 'like', '%'.$search.'%');
                }
            );
        }
        if ($status != null) {
            $tag = $tag->where('is_active', $status);
        }
        if ($sortBy !== null) {
            $conditionSort = 'DESC';
            if ($sortBy % 2 != 1) {
                $conditionSort = 'ASC';
            }
            if ($sortBy == 0 || $sortBy == 1) {
                $tag = $tag->join('tag_translation', 'tags.id', '=', 'tag_translation.tag_id')->where('locale', config('app.locale'))->orderBy('tag_name', $conditionSort);
            } else if ($sortBy == 2 || $sortBy == 3) {
                $tag = $tag->orderBy('created_at', $conditionSort);
            }
        } else {
            $tag = $tag->orderBy('position', 'ASC')->orderBy('id', 'ASC');
        }
        $tag = $tag->with('translation');
        if (!empty($pagination)) {
            $tag = $tag->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $tag = $tag->get();
        }
        return $tag;
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
            'position' => $request->position ?? 0,
            'is_active' => $request->is_active ?? 0,
        ];

        $tag = Tag::create($data);
    
        if ($tag) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation[] = [
                    'locale' => $lang,
                    'tag_id' => $tag->id,
                    'tag_name' => $request->$lang['tag_name'] ?? null,
                    'tag_slug' => $request->$lang['tag_slug'] ?? Str::slug($request->$lang['tag_name']) . '-' . $tag->id,
                ];
            }
            TagTranslation::insert($dataTranslation);
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
    public function update($request, $tag)
    {
        $data = [
            'position' => $request->position ?? 0,
            'is_active' => $request->is_active ?? 0,
        ];
        Tag::where('id', $tag)->update($data);
        if ($tag) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation = [
                    'tag_name' => $request->$lang['tag_name'] ?? null,
                    'tag_slug' => $request->$lang['tag_slug'] ?? Str::slug($request->$lang['tag_name']) . '-' . $tag,
                ];
                TagTranslation::where(['locale' => $lang, 'tag_id' => $tag])->update($dataTranslation);
            }
        }
    }

    public function getInformationTag($tag)
    {
        return Tag::findOrFail($tag);
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function delete($tag)
    {
        Tag::find($tag)->delete();
    }
}
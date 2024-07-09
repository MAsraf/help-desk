<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class TicketCategory extends Model
{
    use HasFactory;

    protected $table = 'ticket_categories';

    protected $fillable = [
        'title',
        'text_color',
        'bg_color',
        'slug',
        'parent_id',
        'type',
    ];

    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('type', 'subcategory')
            ->select('parent_id', 'title');
    }

    public function issues(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('type', 'issue')
            ->select('parent_id', 'title');
    }

    public function type(): HasOne
    {

    }

    public static function getSubCategories($slug)
    {
        if ($slug){
            $category_id = self::where('slug', $slug)->pluck('id')->first();
            return self::where('parent_id', $category_id)->pluck('title', 'slug')->toArray();
        }
        return subcategories_list();
    }

    public static function getIssues($slug)
    {
        if ($slug){
            $subcategory_id = self::where('slug', $slug)->pluck('id')->first();
            return self::where('parent_id', $subcategory_id)->pluck('title', 'slug')->toArray();
        }
        return issues_list();
    }

    public static function getIssuesByCategory($slug)
    {
        if ($slug){
            $category_id = self::where('slug', $slug)->pluck('id')->first();
            $subcategory_ids = self::where('parent_id', $category_id)->pluck('id')->toArray();
            
            $issues = [];

            foreach ($subcategory_ids as $subcategory_id) {
                $issues = array_merge($issues, self::where('parent_id', $subcategory_id)->pluck('title', 'slug')->toArray());
            }

            return $issues;
        }

            return self::issues_list();
    }

    public static function getChosenCategory($slug)
    {
        if ($slug){
            $parent_id = self::where('slug', $slug)->pluck('parent_id')->first();
            return self::where('id', $parent_id)->pluck('slug')->first();
        }
    }

    public static function getCategoriesByParentId($id)
    {
        if ($id){
            return self::where('id', $id)->pluck('title', 'id')->first();
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contracts\EventContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\BlogCategory;
use App\Models\SubCategory;
use App\Models\SubCategoryLevel;
use Auth;
use DB;
class ApiController extends BaseController
{
	/**
     * @var EventContract
     */
    protected $eventRepository;
	/**
     * @var DealContract
     */
    

	/**
     * PageController constructor.
     * @param EventContract $eventRepository
     * @param DealContract $dealRepository
     * @param CategoryContract $categoryRepository
     * @param NotificationContract $notificationRepository
     */
    public function __construct(EventContract $eventRepository)
    {
        $this->eventRepository = $eventRepository;
      
    }

   

    public function categorywiseSubcategory($id="")
    {

        if ($id != "100000") {
            $cat = DB::select("SELECT title AS cat_name FROM  article_categories WHERE id = ".$id);

            $cat_name = $cat[0]->cat_name;
            $subCat = DB::select("SELECT id, title  FROM `article_subcategories` WHERE category_id = ".$id." ORDER BY title ASC");
        } else {
            $cat_name = 'all';
            $subCat = DB::select("SELECT p.id, p.title AS title FROM `article_subcategories` AS p INNER JOIN article_categories AS c ON p.category_id = c.id ORDER BY c.title ASC, p.title ASC;");
        }

		$resp = [
            'cat_name' => $cat_name,
            'subcategory' => [],
        ];

        foreach($subCat as $cat) {
            $resp['subcategory'][] = [
                'subcategory_id' => $cat->id,
                'subcategory_title' => $cat->title,

            ];
        }
        return response()->json(['error' => false, 'message' => 'Category wise SubCategory  list', 'data' => $resp]);
    }


    
}

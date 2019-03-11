<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return view('backend.content.category')
            ->withCategories($this->categoryRepository->getPaginated(25,'id','asc'));
    }

    public function delete(Category $category)
    {
        $this->categoryRepository->deleteById($category->id);

        return redirect()->route('admin.category.index')->withFlashSuccess('栏目删除成功');
    }

}

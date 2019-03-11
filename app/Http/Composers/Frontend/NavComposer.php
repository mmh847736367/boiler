<?php

namespace App\Http\Composers\Frontend;

use Illuminate\View\View;
use App\Repositories\CategoryRepository;

/**
 * Class SidebarComposer.
 */
class NavComposer
{
    /**
     * @var UserRepository
     */
    protected $categoryRepository;

    /**
     * SidebarComposer constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param View $view
     *
     * @return bool|mixed
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categoryRepository->getEnableCategories());
        $view->with('navs', $this->categoryRepository->getSubCategories());
    }
}

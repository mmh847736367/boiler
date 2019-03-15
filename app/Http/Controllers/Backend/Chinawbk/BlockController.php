<?php


namespace App\Http\Controllers\Backend\Chinawbk;


use App\Models\Chinawbk\Block;
use App\Repositories\Chinawbk\BlockRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Chinawbk\UpdateBlockRequest;
use Illuminate\Support\Facades\DB;
class BlockController
{
    protected $blockRepository;

    public function __construct(BlockRepository $blockRepository)
    {
        $this->blockRepository = $blockRepository;
    }

    public function index(Request $request)
    {
        DB::connection('mysql-litecms')->enableQueryLog();

        $q = $request->query('q');
        if(!empty($q)) {
            $blocks = $this->blockRepository
                ->withTrashed()
                ->select(['id', 'name', 'slug', 'updated_at'])
                ->where('name', '%'.$q.'%', 'like')
                ->orderBy('id', 'desc')
                ->paginate(25);
        } else {
            $blocks = $this->blockRepository
                ->withTrashed()
                ->select(['id', 'name', 'slug', 'updated_at'])
                ->orderBy('id', 'desc')
                ->paginate(25);

        }

        dd(DB::connection('mysql-litecms')->getQueryLog());

        return view('backend.chinawbk.block.index')
            ->with('blocks',$blocks);
    }

    public function edit(Block $block)
    {
        return view('backend.chinawbk.block.edit', compact('block'));
    }

    public function update(UpdateBlockRequest $request, Block $block)
    {
        $this->blockRepository->updateById($block->id,$request->only('status'));

        return redirect()->route('admin.chinawbk.block.index')->withFlashSuccess('修改成功');
    }

    public function destroy(Block $block)
    {
        $block->forceDelete();

        return redirect()->route('admin.chinawbk.block.index')->withFlashSuccess('删除成功');
    }
}
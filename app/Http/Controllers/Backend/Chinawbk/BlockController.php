<?php


namespace App\Http\Controllers\Backend\Chinawbk;


use App\Models\Chinawbk\Block;
use App\Repositories\Chinawbk\BlockRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Chinawbk\UpdateBlockRequest;

class BlockController
{
    protected $blockRepository;

    public function __construct(BlockRepository $blockRepository)
    {
        $this->blockRepository = $blockRepository;
    }

    public function index(Request $request)
    {
        $q = $request->query('q');
        if(!empty($q)) {
            $blocks = $this->blockRepository
                ->where('name', '%'.$q.'%', 'like')
                ->orderBy('id', 'desc')
                ->paginate(25);
        } else {
            $blocks = $this->blockRepository
                ->orderBy('id', 'desc')
                ->paginate(25);
        }
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
        $this->blockRepository->deleteById($block->id);

        return redirect()->route('admin.chinawbk.block.index')->withFlashSuccess('删除成功');
    }
}
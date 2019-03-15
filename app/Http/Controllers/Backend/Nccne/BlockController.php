<?php


namespace App\Http\Controllers\Backend\Nccne;


use App\Models\Nccne\Block;
use App\Repositories\Nccne\BlockRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Nccne\UpdateBlockRequest;

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
        return view('backend.nccne.block.index')
            ->with('blocks',$blocks);
    }

    public function edit(Block $block)
    {
        return view('backend.nccne.block.edit', compact('block'));
    }

    public function update(UpdateBlockRequest $request, Block $block)
    {
        $this->blockRepository->updateById($block->id,$request->only('status'));

        return redirect()->route('admin.nccne.block.index')->withFlashSuccess('修改成功');
    }

    public function destroy(Block $block)
    {
        $this->blockRepository->deleteById($block->id);

        return redirect()->route('admin.nccne.block.index')->withFlashSuccess('删除成功');
    }
}
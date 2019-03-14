<?php


namespace App\Models\Traits;


trait KeywordAttribute
{
    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if($this->trashed()) {
            return '<span class="badge badge-danger">过滤</span>';
        }
        return '<span class="badge badge-success">显示</span>';

    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.keyword.destroy', $this).'"
			 data-method="delete"
			 data-trans-button-cancel="'.__('buttons.general.cancel').'"
			 data-trans-button-confirm="确定"
			 data-trans-title="是否确定过滤该关键字？"
			 class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group btn-group-sm" role="group" aria-label="">
			  '.$this->delete_button.'
			</div>';
    }
}